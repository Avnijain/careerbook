<?php
/*
 **************************** Creation Log *******************************
File Name                   -  UserProjectInfo.php
Project Name                -  Careerbook
Description                 -  Class file for users project information
Version                     -  1.0
Created by                  -  Prateek Saini
Created on                  -  March 25, 2013
***************************** Update Log ********************************
Sr.NO.		Version		Updated by           Updated on          Description
-------------------------------------------------------------------------
*************************************************************************
*/
class UserCertificationInfo {
    private $id;                     //Database certification ID 
	private $name;                   //User certification Title
	private $description;            //User certification Description	
	private $duration;               //User certification Duration Period

	//get the value of specified variable
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
			if(!empty($result[0][$key])){
				$this->$key = $result[0][$key];
			}
		}
	}
}
?>