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
	function __construct() { }
	function setId($id) {
		$this->userid=$id;
		
	}
	function handlePersonalInfo() {
		$result=parent::get_info();
		//print_r($result);
		return($result);
	}
	function handleAcademicInfo() {
	
	
	    $result=parent::get_academic_info();
		//print_r($result);
		return($result);
	
	
	}
	function handleProjectInfo(){
		$result=parent::get_project_info();
		//print_r($result);
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
	function handleCertificateInfo() {
		$result=parent::get_certificate_info();
		//print_r($result); 
		return($result);
	}
	}
	$obj=new ProfileController();

?>

