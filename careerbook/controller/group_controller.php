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
include_once '../Model/Group.php';
include_once '../classes/groupClass.php';
// session_start();
class GroupHandler extends Group {
	private $_objGroupModel = array ();
	private $_objGroupClass;
	public $userid;
	function __construct() {
		// $this->_objGroupModel = new Group();
		//$this->_objGroupClass = new GroupClass ();
		if (isset ( $_SESSION ['userData'] )) {
			$obj = new user_info_controller ();
			$obj = unserialize ( $_SESSION ['userData'] );
			$userid = $obj->getUserIdInfo ();
			$this->userid = ( int ) $userid ['id'];
		}
	}
	function handleAddGroup() {
		$this->_group_title = mysql_real_escape_string ( $_POST ['title'] );
		$this->_group_description = mysql_real_escape_string ( $_POST ['description'] );
		$this->_created_by = $this->userid;
		$this->_created_on = date ( 'Y-m-d H:i:s' );
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
						$this->_group_image = addslashes ( file_get_contents ( $_FILES ['group_image'] ['tmp_name'] ) );
					}
				}
			}
		}
		
		$this->add_group ();
		
		$this->handleGetGroup();
	}
	function handleAddPost() {
		$this->_group_id = ( int ) ($_REQUEST ['groupId']);
		$this->_group_discussion_description = mysql_real_escape_string ( $_POST ['group_discussion_description'] );
		$this->_created_by = $this->userid;
		$this->_created_on = date ( 'Y-m-d H:i:s' );
		
		$flag = $this->is_group_member();
		
		if($flag) {
			$this->add_post ();
			$this->handleGetPost();
		} else {
			header ( 'Location: ../views/userHomePage.php');
		}
		
	}
	function handleEditPost() {
		$this->_group_discussion_id = ( int ) ($_REQUEST ['group_id']);
		$this->_group_discussion_description = mysql_real_escape_string ( $_POST ['group_discussion_description'] );
		
		$this->edit_post ();
	}
	function handleDelete() {
		$this->_group_discussion_id = ( int ) ($_REQUEST ['group_id']);
		
		$this->delete ();
	}
	function handleGetPost() {
		$this->_group_id = ( int ) ($_REQUEST ['groupId']);
		$this->_created_by = $this->userid;
		$flag = $this->is_group_member();
		if ($flag) {
			$result = $this->get_posts ();
			$_SESSION ['groupPost'] = serialize ( $result );
			header ( 'Location: ../views/userHomePage.php?groupPost&groupId=' . $this->_group_id );
		} else {
			header ( 'Location: ../views/userHomePage.php?Group');
		}
	}
	function handleGetComment() {
		echo $this->_group_discussion_id = ( int ) ($_REQUEST ['groupDiscussionId']);
		$result = $this->get_comments ();
		$_SESSION ['groupDiscussionComment'] = serialize ( $result );
		header ( 'Location: ../views/userHomePage.php?groupComment&groupDiscussionId=' . $this->_group_discussion_id );

	}
	function handleGetGroup() {
		$this->_created_by = $this->userid;
		
		
		$result = array ();
		$result = $this->get_group ();
		$_SESSION ['groupList'] = serialize ( $result );
		
		header ( 'Location: ../views/userHomePage.php?Group' );
	}
	function handleAddComment() {
		$this->_group_discussion_id = ( int ) ($_REQUEST ['groupDiscussionId']);
		$this->_group_discussion_comment = mysql_real_escape_string ( $_POST ['group_discussion_comment'] );
		$this->_created_by = $this->userid;
		$this->_created_on = date ( 'Y-m-d H:i:s' );
		
		$this->add_comment ();
		$this->handleGetComment();
	}
	function handleJoinGroup() {
		$this->_group_id = ( int ) ($_REQUEST ['groupId']);
		$this->_created_by = $this->userid;
		
		$this->join_group();
		$this->handleGetGroup();
	}
	function handleUnjoinGroup() {
		$this->_group_id = ( int ) ($_REQUEST ['groupId']);
		$this->_created_by = $this->userid;
	
		$this->unjoin_group();
		$this->handleGetGroup();
	}
	function handleSearchGroup() {
		$this->_search_group = $_REQUEST['groupSearch'];
		
		$result = $this->search_group();
		$_SESSION ['groupSearch'] = serialize ( $result );
		header ( 'Location: ../views/userHomePage.php?searchGroup' );
	}
}

$objGroup = new GroupHandler ();

?>