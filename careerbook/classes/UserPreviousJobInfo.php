<?php
/*
 **************************** Creation Log *******************************
File Name                   -  UserPreviousJobInfo.php
Project Name                -  Careerbook
Description                 -  Class file for users pervious job information,
Version                     -  1.0
Created by                  -  Prateek Saini
Created on                  -  March 30, 2013
***************************** Update Log ********************************
Sr.NO.		Version		Updated by           Updated on          Description
-------------------------------------------------------------------------
*************************************************************************
*/

class UserPreviousJobInfo {
	private $position;             //User position in job
	private $company;              //User previous working company
	private $start_period;         //User job start period
	private $end_period;           //User job end period

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