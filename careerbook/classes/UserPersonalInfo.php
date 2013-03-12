<?php
/*
 **************************** Creation Log *******************************
File Name                   -  user.php
Project Name                -  Careerbook
Description                 -  Class file for users personal information,
academic information,
professional information
Version                     -  1.0
Created by                  -  Prateek Saini
Created on                  -  March 05, 2013
***************************** Update Log ********************************
Sr.NO.		Version		Updated by           Updated on          Description
-------------------------------------------------------------------------
*************************************************************************
*/
class UserPersonalInfo {
	private $first_name;               //User First Name
	private $middle_name;              //User Middle Name
	private $last_name;                //User Last Name
	private $date_of_birth;            //User Date Of Birth
	private $email_primary;            //User Primary Email ID
	private $email_secondary;          //User Secondary Email ID
	private $phone_no;                 //User Personal Mobile or Phone Number
	private $gender;                   //User Gender

	//get the value of specified variable
	public function getinfo(){
		$arr = get_class_vars(get_class($this));
		$allfields = array();
		foreach($arr as $key => $value ){
			$allfields[$key] = $this->$key;
			//print($this->$key);
		}
		return $allfields;
	}
	//Set values from DB result set into class variables
	public function setinfo($result){
		$arr = get_class_vars(get_class($this));
		foreach($arr as $key => $value ){
			$this->$key = $result[0][$key];
			//print($this->$key);
		}
	}
	/* FOR TESTING AND GETTING CLASS VARIABLES
	 public function getdefinedvars(){
	$arr = get_class_vars(get_class($this));
	foreach($arr as $key => $value){
	print($key."<br/>");
	}
	}
	*/
}
?>