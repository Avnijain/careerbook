<?php
/*
**************************** Creation Log *******************************
File Name                   -  userpersonalinfo.php
Project Name                -  Careerbook
Description                 -  Controller Class file for users information
Version                     -  1.0
Created by                  -  Prateek Saini
Created on                  -  March 05, 2013
***************************** Update Log ********************************
Sr.NO.		Version		Updated by           Updated on          Description
-------------------------------------------------------------------------
*************************************************************************
*/
//include_once('../classes/');


/* 
 * Following class will create the user information objects and control the data flow.
 * All the ojects here created corresponds to class in user.php file 
 * */

require_once '../Model/model.php';

function __autoload($className)
{

	require('../classes/'.$className.'.php');

}

class user_info_controller
{
	private $objPersonalInfo;
	private $objProfessionalInfo;
	private $objAcademicInfo;
	private $objIdentityInfo;	

	public function __construct()
	{
		$this->objPersonalInfo = new UserPersonalInfo();
		$this->objProfessionalInfo = new UserProfessionalInfo();
		$this->objIdentityInfo = new userIdentityInfo();
	}
	public function setUserPersonalInfo($result)
	{
		$this->objPersonalInfo->setinfo($result);
//		$this->obj->getdefinedvars();
// 		echo "<pre/>";
// 		print_r ($result);
	}
	public function getUserPersonalInfo()
	{
		//		print($varname);
		return $this->objPersonalInfo->getinfo();
	}	
	public function setUserProfessionalInfo($result,$userInfo)
	{
	    $this->objProfessionalInfo->setinfo($result);
	    $ObjModel = new MyClass ();
	    $result=$ObjModel->insertIntoUserProfessional($userInfo);	    
	    //print_r($this->objIdentityInfo->getinfo());
	    //		$this->obj->getdefinedvars();
	    // 		echo "<pre/>";
	    // 		print_r ($result);
	    
	    
	}	
	public function getUserProfessionalInfo()
	{
		return $this->objProfessionalInfo->getinfo();
	}	

	public function setUserIdInfo($result){
		$this->objIdentityInfo->setinfo($result);
	}
	public function getUserIdInfo(){
		return $this->objIdentityInfo->getinfo();
	}	
}

// $obj = new user_info_controller;
// $obj->getuserinfo();

?>