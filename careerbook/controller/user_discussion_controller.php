<?php 
/*
 **************************** Creation Log *******************************
File Name                   -  user_discussion.php
Project Name                -  Careerbook
Description                 -  Class file for users personal information,
academic information,
professional information
Version                     -  1.0
Created by                  -  Prateek Saini,Manish ranjan
Created on                  -  March 05, 2013
***************************** Update Log ********************************
Sr.NO.		Version		Updated by           Updated on          Description
-------------------------------------------------------------------------
*************************************************************************
*/
include_once '../controller/userInfo.php';
include_once '../Model/userDiscussionModel.php';

class UserDiscussionController extends UserDiscussion {
	public $userid;
	function __construct() {
	    parent::__construct();
		$this->_obj_user_class = new user_info_controller ();
	if(isset($_SESSION['userData']))
		{
			$this->_obj_user_class = unserialize($_SESSION['userData']);
			$userData=$this->_obj_user_class->getUserIdInfo();
			$this->userid = $userData['id'];
		} else {
			header('Location: ../index.php');
		}
	}
	function handleAddUserPost() {
		$this->_user_id = (int) $this->userid;
		$this->_user_discussion_description = trim($_REQUEST['description']);
		$this->_created_on = date ( 'Y-m-d H:i:s' );
		
		$this->add_post();
		header('Location: ../Home/userHomePage.php');
	}
}
?>