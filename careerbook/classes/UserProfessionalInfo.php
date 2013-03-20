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

class UserProfessionalInfo {
//	private $achievement;          //User achievements
	private $skill_set;            //User skills
	private $current_position;     //User current position in job
	private $current_company;      //User current position in company
	private $start_period;         //User current job start period

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
			if(!empty($result[0][$key])){
				$this->$key = $result[0][$key];
			}			
			//print($this->$key);
		}
		
	}
}
?>