<?php
/*
 **************************** Creation Log *******************************
File Name                   -  UserAddressInfo.php
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
class UserAddressInfo {
	private $address;               //User Address information
	private $city_name;              //User living in city
	private $state_name;              //User living in state

	//get the value of specified variable
	public function getInfoExcptState(){
		$arr = get_class_vars(get_class($this));
		$allfields = array();
		foreach($arr as $key => $value ){
			if($key != "state_name"){
				$allfields[$key] = $this->$key;
			//print($this->$key);
			}
		}
		return $allfields;		
	}
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