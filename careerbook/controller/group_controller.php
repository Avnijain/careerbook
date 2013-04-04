<?php

/*
 * *************************** Creation Log ******************************* 
 * File Name 	- 	group_controller.php 
 * Project Name - 	Careerbook 
 * Description 	-	Class file for start Version - 1.0 
 * Created by	- 	Manish Ranjan 
 * Created on 	- 	March 10, 2013 
 * **************************** Update Log ******************************** 
 * Sr.NO.		Version		Updated by Updated on Description 
 * ------------------------------------------------------------------------- 
 * ------------------------------------------------------------------------- 
 * ************************************************************************
 */
include_once '../Model/Group.php';	//Model Class	---	Performs all business related logic
include_once '../controller/userInfo.php';	//User Class	---	Used to get user information
include_once '../classes/groupClass.php';	//Group Class	---	Used to get and set group information

class GroupHandler extends Group {
	
	private $_obj_group_model;	//Object reference - Group Model Class
	private $_obj_user_class;	//Object reference - User Info Controller Class
	private $_obj_group_class;	//Object reference - Group Class to set and get group information
	private $userid;			//Class variable used to store logged user id
	
	function __construct() {
		$this->_obj_group_model = new Group();	//Object Creation - Group Model Class
		$this->_obj_user_class = new user_info_controller ();	//Object Creation - User Info Controller Class
		$this->_obj_group_class = new GroupClass();	//Object Creation - Group Class to set and get group information

		if(isset($_SESSION['userData'])) {
			$this->_obj_user_class = unserialize($_SESSION['userData']);
			$userData=$this->_obj_user_class->getUserIdInfo();
			$this->userid = $userData['id'];
		} else {
			header('Location: ../index.php');
		}
	}
	
	//*********************function to handle add group request**************************************//
	function handleAddGroup() {
		$this->_obj_group_model->_group_title = trim ( $_POST ['title'] );
		$this->_obj_group_model->_group_title = htmlentities(( $_POST ['title']), ENT_COMPAT, 'UTF-8');
		$this->_obj_group_model->_group_title = mysql_real_escape_string ( $_POST ['title'] );
		
		$this->_obj_group_model->_group_description = trim ( $_POST ['description'] );
		$this->_obj_group_model->_group_description = htmlentities ( $_POST ['description'], ENT_COMPAT, 'UTF-8');
		$this->_obj_group_model->_group_description = mysql_real_escape_string ( $_POST ['description'] );
		$this->_obj_group_model->_created_by = $this->userid;
		$this->_obj_group_model->_created_on = date ( 'Y-m-d H:i:s' );
		
		$validdob = new UserDataValidation ();
		$error=$validdob->validate ( $_POST );
		
		if ($error == 0) {
			echo "SUCCESS"; die;
		} else {
			echo "error"; die;
		}
		
		$this->_obj_group_model->add_group ();
		$this->handleGetGroup();
	}
	
	
	//*********************************function to handle edit group Request**********************************//
	function handleEditGroup() {
		$this->_obj_group_model->_group_id = $_REQUEST['groupId'];
		
		$this->_obj_group_model->_group_title = trim ( $_POST ['title'] );
		$this->_obj_group_model->_group_title = htmlentities(( $_POST ['title']), ENT_COMPAT, 'UTF-8');
		$this->_obj_group_model->_group_title = mysql_real_escape_string ( $_POST ['title'] );
	
		$this->_obj_group_model->_group_description = trim ( $_POST ['description'] );
		$this->_obj_group_model->_group_description = htmlentities ( $_POST ['description'], ENT_COMPAT, 'UTF-8');
		$this->_obj_group_model->_group_description = mysql_real_escape_string ( $_POST ['description'] );

		$maxsize = 1024000; // set to approx 1 MB
	
		// check associated error code
		if ($_FILES ['group_image'] ['error'] == UPLOAD_ERR_OK) {
			// check whether file is uploaded with HTTP POST
			if (is_uploaded_file ( $_FILES ['group_image'] ['tmp_name'] )) {
				// checks size of uploaded image on server side
				if ($_FILES ['group_image'] ['size'] < $maxsize) {
					// checks whether uploaded file is of image type
					$fp = fopen(( $_FILES ['group_image'] ['tmp_name'] ), 'r');
					$imageData = fread($fp, filesize(( $_FILES ['group_image'] ['tmp_name'] )));
					$this->_obj_group_model->_group_image = addslashes($imageData);
					fclose($fp);
				}
			}
		}
	
		$this->_obj_group_model->edit_group();
	
		$this->handleGetGroup();
	}
	
	//*******************************function to handle add post request**********************************************//
	function handleAddPost() {
		$this->_obj_group_model->_group_id = ($_REQUEST ['groupId']);
		$this->_obj_group_model->_group_discussion_description = trim ( $_POST ['group_discussion_description'] );
		$this->_obj_group_model->_group_discussion_description = htmlentities( $_POST ['group_discussion_description'], ENT_COMPAT, 'UTF-8' );
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
	
	//********************************function to handle edit post request******************************************//
	function handleEditPost() {
		$this->_obj_group_model->_group_discussion_id =  ($_REQUEST ['postId']);
		$this->_obj_group_model->_group_discussion_description = trim ( $_POST ['group_discussion_description'] );
		$this->_obj_group_model->_group_discussion_description = htmlentities ( $_POST ['group_discussion_description'], ENT_COMPAT, 'UTF-8' );
		$this->_obj_group_model->_group_discussion_description = mysql_real_escape_string ( $_POST ['group_discussion_description'] );
		
		$this->_obj_group_model->edit_post ();
		
		$this->handleGetPost();
	}
	
	//*********************************function to orocess edit group request**********************************//
	function handleProcessEditGroup() {
		$this->_obj_group_model->_group_id = ($_REQUEST ['groupId']);
		
		$result = $this->_obj_group_model->get_group_detail();
		$this->_obj_group_class->setGroupDetail($result);
		$_SESSION['groupDetail'] = serialize($this->_obj_group_class);
		
		header('Location: ../views/userHomePage.php?editGroup');
		
	}
	
	//*****************************function to orocess edit post request**********************************//
	function handleProcessEditPost() {
		$this->_obj_group_model->_group_discussion_id =  ($_REQUEST ['postId']);
		
		$result = $this->_obj_group_model->get_post();
		$this->_obj_group_class->setPostDetail($result);
		$_SESSION['postDetail'] = serialize($this->_obj_group_class);
	
		header('Location: ../views/userHomePage.php?editPost');
	
	}
	
	//***************************function to handle delete group request*********************************// 
	function handleDeleteGroup() {
		$this->_obj_group_model->_group_id =  ($_REQUEST ['groupId']);
		
		$this->_obj_group_model->delete_group ();
		$this->handleGetGroup();
	}
	
	//***************************function to get post request*************************************//
	function handleGetPost() {
		$this->_obj_group_model->_group_id =  ($_REQUEST ['groupId']);
		$this->_obj_group_model->_created_by = $this->userid;
		
		$flag = $this->_obj_group_model->is_group_member();
		
		if ($flag) {
			$result = $this->_obj_group_model->get_posts ();
			$this->_obj_group_class->setPostList($result);
			$_SESSION ['groupPost'] = serialize ( $this->_obj_group_class);
			
			$result1 = $this->_obj_group_model->get_group_detail();
			$this->_obj_group_class->setGroupDetail($result1);
			$_SESSION['groupDetail'] = serialize($this->_obj_group_class);
			
			
			header ( 'Location: ../views/userHomePage.php?groupPost&groupId=' . $this->_obj_group_model->_group_id );
		} else {
			header ( 'Location: ../views/userHomePage.php?Group');
		}
	}
	
	//***************************************function to get comment request*******************************************//
	function handleGetComment() {
		$this->_obj_group_model->_group_discussion_id =  ($_REQUEST ['groupDiscussionId']);
		
		$result = $this->_obj_group_model->get_comments ();
		$this->_obj_group_class->setCommentList($result);
		$_SESSION ['groupDiscussionComment'] = serialize ( $this->_obj_group_class );
		
		$result1 = $this->_obj_group_model->get_post();
		$this->_obj_group_class->setPostDetail($result1);
		$_SESSION['postDetail'] = serialize($this->_obj_group_class);
		
		header ( 'Location: ../views/userHomePage.php?groupComment&groupDiscussionId=' . $this->_obj_group_model->_group_discussion_id );

	}
	
	//***************************************function to get group list request*********************************************//
	function handleGetGroup() {
		$this->_obj_group_model->_created_by = $this->userid;

		$result = $this->_obj_group_model->get_group ();
		$this->_obj_group_class->setGroupList($result);
		$_SESSION ['groupList'] = serialize ( $this->_obj_group_class );
		
		header ( 'Location: ../views/userHomePage.php?Group' );
	}
	
	//***************************************function to add comment request***************************************//
	function handleAddComment() {
		$this->_obj_group_model->_group_discussion_id = ( int ) ($_REQUEST ['groupDiscussionId']);
		$this->_obj_group_model->_group_discussion_comment = trim ( $_POST ['group_discussion_comment'] );
		$this->_obj_group_model->_group_discussion_comment = htmlentities ( $_POST ['group_discussion_comment'], ENT_COMPAT, 'UTF-8' );
		$this->_obj_group_model->_group_discussion_comment = mysql_real_escape_string ( $_POST ['group_discussion_comment'] );
		$this->_obj_group_model->_created_by = $this->userid;
		$this->_obj_group_model->_created_on = date ( 'Y-m-d H:i:s' );
		
		$this->_obj_group_model->add_comment ();
		$this->handleGetComment();
	}
	
	//*******************************************function to delete comment request*********************************//
	function handleDeleteComment() {
		$this->_obj_group_model->_group_discussion_comment_id =  ($_REQUEST ['commentId']);
	
		$this->_obj_group_model->delete_comment ();
		$this->handleGetGroup();
	}
	
	//*******************************************function to handle group join request******************************//
	function handleJoinGroup() {
		$this->_obj_group_model->_group_id =  ($_REQUEST ['groupId']);
		$this->_obj_group_model->_created_by = $this->userid;
		
		$this->_obj_group_model->join_group();
		$this->handleGetGroup();
	}
	
	//********************************************function to handle group unjoin request*************************//
	function handleUnjoinGroup() {
		$this->_obj_group_model->_group_id =  ($_REQUEST ['groupId']);
		$this->_obj_group_model->_created_by = $this->userid;
	
		$this->_obj_group_model->unjoin_group();
		$this->handleGetGroup();
	}
	
	//*******************************************function to search group request*******************************//
	function handleSearchGroup() {
		$this->_obj_group_model->_created_by = $this->userid;
		$this->_obj_group_model->_search_group = trim($_REQUEST['groupSearch']);
		$this->_obj_group_model->_search_group = mysql_real_escape_string($_REQUEST['groupSearch']);
		
		$result = $this->_obj_group_model->search_group();
		$this->_obj_group_class->setGroupSearchList($result);
		$_SESSION ['groupSearch'] = serialize ( $this->_obj_group_class );
		header ( 'Location: ../views/userHomePage.php?searchGroup' );
	}
}