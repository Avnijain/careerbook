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

class user_info_controller {
	private $obj;
	public function __construct(){
		$this->obj = new user_personal_info();
	}
	public function setuserinfo($result){
		$this->obj->setinfo($result);
//		$this->obj->getdefinedvars();
// 		echo "<pre/>";
// 		print_r ($result);
	}
	public function getuserinfo($varname){
//		print($varname);
		return $this->obj->getinfo($varname);
	}
}

// $obj = new user_info_controller;
// $obj->getuserinfo();

?>