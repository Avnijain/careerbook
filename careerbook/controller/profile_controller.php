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
	/*********************setting the user id**********************/
	function setId($id) {
		$this->userid=$id;
	}
	/*********************getting personal information**********************/
	function handlePersonalInfo() {
		$result=parent::get_info();
		return($result);
	}
	/*********************getting academic information**********************/
	function handleAcademicInfo() {
	    $result=parent::get_academic_info();
		return($result);
	}
	/*********************getting project information**********************/
	function handleProjectInfo(){
		$result=parent::get_project_info();
		return($result);
	}
	/*********************getting previous job information**********************/
	function handlePreviousJobInfo() {
		$count=parent::get_previous_job_info();
		return($count);
	}
	/*********************getting profeesional information**********************/
	function handleProfessionalInfo() {
		$result=parent::get_professional_info();
		return($result);
	}
	/*********************getting certificate information**********************/
	function handleCertificateInfo() {
		$result=parent::get_certificate_info();
		return($result);
	}
	}
	$obj=new ProfileController();
?>