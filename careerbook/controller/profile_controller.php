<?php
/*
 **************************** Creation Log *******************************
File Name                   -  profile_controller.php
Project Name                -  Careerbook
Description                 -  controller class for user profile
Version                     -  1.0
Created by                  -  Avni Jain
Created on                  -  March 29, 2013
***************************** Update Log ********************************
Sr.NO.		Version		Updated by           Updated on          Description
-------------------------------------------------------------------------
*************************************************************************

*/
include_once '../controller/userInfo.php';
include_once '../Model/profile.php';
class ProfileController extends Profile
{


	
	function __construct() {
		if(isset($_SESSION['userData']))
		{
			$obj = new user_info_controller();
			$obj = unserialize($_SESSION['userData']);
			$userid = $obj->getUserIdInfo();
			$this->userid = $userid['id'];
		}
	}
	function setId(($id) {
		$userid=$id;
	}
	function handlePersonalInfo() {
		$result=parent::get_info();
		print_r($result);
		return($result);
	}
	function handleAcademicInfo() {
	
	
	    $result=parent::get_academic_info();
		print_r($result);
		return($result);
	
	
	}
	function handlePreviousJobInfo() {
		$count=parent::get_previous_job_info();
		//print_r($count);
		return($count);
	}
	function handleProfessionalInfo() {
		$result=parent::get_professional_info();
// 		print_r($result);
		return($result);
	}
	
	}
	$ob=new ProfileController();

?>

