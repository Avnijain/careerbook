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

class userActivityInfo {

	private $_id;                //User id in the database
	private $_comments_count;    //Count of comments
	private $_grouppost_count;   //Count of group post by users

	public function getinfo(){
		$arr = get_class_vars(get_class($this));
		$allfields = array();
		$emptyFlag = true;
		foreach($arr as $key => $value ){
		    if($key == "_comments_count"){
		        $orignlKey = substr($key, 1);
				$allfields[$orignlKey] = $this->$key;
				$emptyFlag = false;
		    }else{
    			if(!empty($this->$key)){
    			    $orignlKey = substr($key, 1);
    				$allfields[$orignlKey] = $this->$key;
    				$emptyFlag = false;
    			}
		    }
			//print($this->$key);
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
		    $orignlKey = substr($key, 1);
		     if($key == "_comments_count"){
		         $this->$key = $result[0][$orignlKey];
		     }else{
    		    if(!empty($result[0][$orignlKey])){
    			    $this->$key = $result[0][$orignlKey];
    		    }
		     }			
		}
	}
}
?>