<?php

/*
 **************************** Creation Log *******************************
File Name                   -  group_controller.php
Project Name                -  Careerbook
Description                 -  Class file for start
Version                     -  1.0
Created by                  -  Manish Ranjan
Created on                  -  March 10, 2013
***************************** Update Log ********************************
Sr.NO.		Version		Updated by           Updated on          Description
-------------------------------------------------------------------------
-------------------------------------------------------------------------
*************************************************************************

*/

include_once '../Model/Group.php';
include_once '../controller/userInfo.php';
//session_start();

class GroupHandler extends Group {

	public $groupData;
	public $userid;
	
	function __construct() {
		if(isset($_SESSION['userData']))
		{
			$obj = new user_info_controller();
			$obj = unserialize($_SESSION['userData']);
			$userid = $obj->getUserIdInfo();
			$this->userid = $userid['id'];
		}
	}

	function handleAddGroup() {
		$this->_group_title = mysql_real_escape_string($_POST['title']);
		$this->_group_description = mysql_real_escape_string($_POST['description']);
		$this->_created_by = $this->userid;
		$this->_created_on = date ( 'Y-m-d H:i:s' );
		$maxsize = 1024000; //set to approx 1 MB
		
		//check associated error code
		if($_FILES['group_image']['error']==UPLOAD_ERR_OK) {
			//check whether file is uploaded with HTTP POST
			if(is_uploaded_file($_FILES['group_image']['tmp_name'])) {
				//checks size of uploaded image on server side
				if( $_FILES['group_image']['size'] < $maxsize) {
					//checks whether uploaded file is of image type
					$finfo = finfo_open(FILEINFO_MIME_TYPE);
					if(strpos(finfo_file($finfo, $_FILES['group_image']['tmp_name']),"image")===0) {
						// prepare the image for insertion
						$this->_group_image = addslashes (file_get_contents($_FILES['group_image']['tmp_name']));
					}
				}
			}
		}
		
		$this->add_group();
		
	}
	
	function handleAddPost() {
		$this->_group_id = ( int ) $group_id;
		$this->_group_discussion_description = mysql_real_escape_string ($_POST['group_']);
		$this->_created_by = $_SESSION['userid'];
		$this->_created_on = date ( 'Y-m-d H:i:s' );
	}

}

?>