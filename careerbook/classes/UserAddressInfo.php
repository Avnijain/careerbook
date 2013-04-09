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
	private $city_name;             //City Name Where user live
	private $state_name;            //State Name Where user live
	private $country_name;          //Country Name Where user live
	private $language;              //Language spoken by user
	private $nationality;           //Current Nationality of user

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
	public function getinfo($dbDataFlag = "false"){
		$arr = get_class_vars(get_class($this));
		$allfields = array();
		$emptyFlag = true;
		if($dbDataFlag){		
		foreach($arr as $key => $value ){
			if(!empty($this->$key)){
				$allfields[$key] = $this->$key;
				$emptyFlag = false;
			}			
			//print($this->$key);
		}
		}
		if($emptyFlag){
			return array("empty data" => "empty data" );
		}
		return $allfields;
	}
	//Set values from DB result set into class variables
	public function setinfo($result){
		$arr = get_class_vars(get_class($this));
		foreach($arr as $key => $value ){
		    if(isset($result[0][$key])){		    
		        $this->$key = $result[0][$key];
//			print($this->$key);
		    }
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