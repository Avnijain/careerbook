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
	private	$ObjModel;
	private $ObjAddressInfo;

	public function __construct()
	{
		$this->objPersonalInfo = new UserPersonalInfo();
		$this->objProfessionalInfo = new UserProfessionalInfo();
		$this->objIdentityInfo = new userIdentityInfo();
		$this->ObjModel = new MyClass ();
		$this->ObjAddressInfo = new UserAddressInfo();
		$this->objAcademicInfo = new UserAcademicInfo();
	}
/*******************************************************************************************/
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
/*******************************************************************************************/
	public function setUserAddressInfo($result,$userInfo){
		$this->ObjAddressInfo->setinfo($result);		
		$result = $this->ObjModel->fetchUserAddressInfo($userInfo);
		
		if(count($result) > 0 ){
			$this->ObjModel->updateUserAddress($userInfo);
		}
		else{
			$this->ObjModel->insertIntoUserAddress($userInfo);
		}
	}
	public function getUserAddressInfo()
	{
		return $this->ObjAddressInfo->getInfo();
	}
/*******************************************************************************************/
	public function setUserAcademicInfo($result,$userInfo){
	    $this->objAcademicInfo->setinfo($result);
	    $result = $this->ObjModel->fetchUserAcademicInfo($userInfo);
	
	    if(count($result) > 0 ){
	        $this->ObjModel->updateUserAcademic($userInfo);
	    }
	    else{
	        $this->ObjModel->insertIntoUserAcademic($userInfo) or die(mysql_error());
	    }
	}
	public function getUserAcademicInfo()
	{
	    return $this->objAcademicInfo->getInfo();
	}	
/*******************************************************************************************/	
	public function setUserProfessionalInfo($result,$userInfo)
	{
	    $this->objProfessionalInfo->setinfo($result);
	    $result = $this->ObjModel->fetchUserProfessionalInfo($userInfo);
	    	    
	    if(count($result) > 0 ){
	    	$this->ObjModel->updateUserProfessional($userInfo);
	    }
	    else{
	    	$this->ObjModel->insertIntoUserProfessional($userInfo);
	    }
	    //$result=$ObjModel->insertIntoUserProfessional($userInfo);	    
	    //print_r($this->objIdentityInfo->getinfo());
	    //		$this->obj->getdefinedvars();
	    // 		echo "<pre/>";
	    // 		print_r ($result);
	}	
	public function getUserProfessionalInfo()
	{
		return $this->objProfessionalInfo->getinfo();
	}	
/*******************************************************************************************/
	public function setUserIdInfo($result){
		$this->objIdentityInfo->setinfo($result);
	}
	public function getUserIdInfo(){
		return $this->objIdentityInfo->getinfo();
	}	
/*******************************************************************************************/	
}

// $obj = new user_info_controller;
// $obj->getuserinfo();

?>