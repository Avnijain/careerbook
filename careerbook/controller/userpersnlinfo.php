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
include_once('../classes/user.php');


/* 
 * Following class will create the user information objects and control the data flow.
 * All the ojects here created corresponds to class in user.php file 
 * */
class user_info_controller {
	private $obj_personal_info;
	private $obj_professional_info;
	private $obj_academic_info;
	private $obj_identity_info;

	public function __construct(){
		$this->obj_personal_info = new user_personal_info();
		$this->obj_professional_info = new user_professional_info();
	}
	public function setuserinfo($result){
		$this->obj_personal_info->setinfo($result);
//		$this->obj->getdefinedvars();
// 		echo "<pre/>";
// 		print_r ($result);
	}
	public function getuserinfo(){
//		print($varname);
		return $this->obj_personal_info->getinfo();
	}
}

// $obj = new user_info_controller;
// $obj->getuserinfo();

?>