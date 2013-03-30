<?php

/*
 * *************************** Creation Log ******************************* 
 * File Name - group_controller.php 
 * Project Name - Careerbook 
 * Description - Class file for start Version - 1.0 
 * Created by - Manish Ranjan 
 * Created on - March 10, 2013 
 * **************************** Update Log ******************************** 
 * Sr.NO.		Version		Updated by Updated on Description 
 * ------------------------------------------------------------------------- 
 * ------------------------------------------------------------------------- 
 * ************************************************************************
 */
include_once '../Model/Group.php';
include_once '../controller/userInfo.php';
include_once '../classes/groupClass.php';

class GroupHandler extends Group {
	
	//private static $instance;
	private $_obj_group_model;
	private $_obj_user_class;
	private $_obj_group_list;
	private $_obj_group_post;
	private $_obj_group_comment;
	private $_obj_group_search;
	private $userid;
	
	function __construct() {
		session_start();
		$this->_obj_group_model = new Group();
		$this->_obj_user_class = new user_info_controller ();
		$this->_obj_group_list = new GroupList();
		$this->_obj_group_post = new GroupPost();
		$this->_obj_group_comment = new GroupComment();
		$this->_obj_group_search = new GroupSearch();
		if(isset($_SESSION['userData']))
		{
			$this->_obj_user_class = unserialize($_SESSION['userData']);
			$userData=$this->_obj_user_class->getUserIdInfo();
			$this->userid = $userData['id'];
// 			print_r($this->_obj_user_class);
// 			die;
		} else {
// 			echo " i am here ";
// 			die;
			header('Location: ../index.php');
		}
	}
	
	function handleAddGroup() {
		$this->_obj_group_model->_group_title = mysql_real_escape_string ( $_POST ['title'] );
		$this->_obj_group_model->_group_description = mysql_real_escape_string ( $_POST ['description'] );
		$this->_obj_group_model->_created_by = $this->userid;
		$this->_obj_group_model->_created_on = date ( 'Y-m-d H:i:s' );
		$maxsize = 1024000; // set to approx 1 MB
		                    
		// check associated error code
		if ($_FILES ['group_image'] ['error'] == UPLOAD_ERR_OK) {
			// check whether file is uploaded with HTTP POST
			if (is_uploaded_file ( $_FILES ['group_image'] ['tmp_name'] )) {
				// checks size of uploaded image on server side
				if ($_FILES ['group_image'] ['size'] < $maxsize) {
					// checks whether uploaded file is of image type
					$finfo = finfo_open ( FILEINFO_MIME_TYPE );
					if (strpos ( finfo_file ( $finfo, $_FILES ['group_image'] ['tmp_name'] ), "image" ) === 0) {
						// prepare the image for insertion
						$this->_obj_group_model->_group_image = addslashes ( file_get_contents ( $_FILES ['group_image'] ['tmp_name'] ) );
					}
				}
			}
		}
		
		$this->_obj_group_model->add_group ();
		
		$this->handleGetGroup();
	}
	
	function handleAddPost() {
		$this->_obj_group_model->_group_id = ( int ) ($_REQUEST ['groupId']);
		$this->_obj_group_model->_group_discussion_description = mysql_real_escape_string ( $_POST ['group_discussion_description'] );
		$this->_obj_group_model->_created_by = $this->userid;
		$this->_obj_group_model->_created_on = date ( 'Y-m-d H:i:s' );
		
		$flag = $this->_obj_group_model->is_group_member();
		
		if($flag) {
			$this->_obj_group_model->add_post ();
			$this->handleGetPost();
		} else {
			header ( 'Location: ../views/userHomePage.php');
		}
		
	}
	function handleEditPost() {
		$this->_obj_group_model->_group_discussion_id = ( int ) ($_REQUEST ['group_id']);
		$this->_obj_group_model->_group_discussion_description = mysql_real_escape_string ( $_POST ['group_discussion_description'] );
		
		$this->_obj_group_model->edit_post ();
	}
	function handleDelete() {
		$this->_obj_group_model->_group_discussion_id = ( int ) ($_REQUEST ['group_id']);
		
		$this->_obj_group_model->delete ();
	}
	
	function handleGetPost() {
		$this->_obj_group_model->_group_id = ( int ) ($_REQUEST ['groupId']);
		$this->_obj_group_model->_created_by = $this->userid;
		$flag = $this->_obj_group_model->is_group_member();
		if ($flag) {
			$result = $this->_obj_group_model->get_posts ();
			$this->_obj_group_post->setPostList($result);
			$_SESSION ['groupPost'] = serialize ( $this->_obj_group_post );
			header ( 'Location: ../views/userHomePage.php?groupPost&groupId=' . $this->_group_id );
		} else {
			header ( 'Location: ../views/userHomePage.php?Group');
		}
	}
	
	function handleGetComment() {
		$this->_obj_group_model->_group_discussion_id = ( int ) ($_REQUEST ['groupDiscussionId']);
		$result = $this->_obj_group_model->get_comments ();
		$this->_obj_group_comment->setCommentList($result);
		$_SESSION ['groupDiscussionComment'] = serialize ( $this->_obj_group_comment );
		header ( 'Location: ../views/userHomePage.php?groupComment&groupDiscussionId=' . $this->_group_discussion_id );

	}
	
	function handleGetGroup() {
		$this->_obj_group_model->_created_by = $this->userid;
		$result = array ();
		$result = $this->_obj_group_model->get_group ();
		$this->_obj_group_list->setGroupList($result);
		$_SESSION ['groupList'] = serialize ( $this->_obj_group_list );
		
		header ( 'Location: ../views/userHomePage.php?Group' );
	}
	
	function handleAddComment() {
		$this->_obj_group_model->_group_discussion_id = ( int ) ($_REQUEST ['groupDiscussionId']);
		$this->_obj_group_model->_group_discussion_comment = mysql_real_escape_string ( $_POST ['group_discussion_comment'] );
		$this->_obj_group_model->_created_by = $this->userid;
		$this->_obj_group_model->_created_on = date ( 'Y-m-d H:i:s' );
		
		$this->_obj_group_model->add_comment ();
		$this->handleGetComment();
	}
	
	function handleJoinGroup() {
		$this->_obj_group_model->_group_id = ( int ) ($_REQUEST ['groupId']);
		$this->_obj_group_model->_created_by = $this->userid;
		
		$this->_obj_group_model->join_group();
		$this->handleGetGroup();
	}
	
	function handleUnjoinGroup() {
		$this->_obj_group_model->_group_id = ( int ) ($_REQUEST ['groupId']);
		$this->_obj_group_model->_created_by = $this->userid;
	
		$this->_obj_group_model->unjoin_group();
		$this->handleGetGroup();
	}
	function handleSearchGroup() {
		$this->_obj_group_model->_search_group = $_REQUEST['groupSearch'];
		
		$result = $this->_obj_group_model->search_group();
		$this->_obj_group_search->setGroupSearchList($result);
		$_SESSION ['groupSearch'] = serialize ( $this->_obj_group_search );
		header ( 'Location: ../views/userHomePage.php?searchGroup' );
	}
}

?>