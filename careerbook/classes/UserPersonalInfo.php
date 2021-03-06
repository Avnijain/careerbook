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
	private $profile_image;		   //user profile Image	

	//get the value of specified variable
	public function getinfo(){
		$arr = get_class_vars(get_class($this));
		$allfields = array();
		$emptyFlag = true;
		foreach($arr as $key => $value ){
			if(!empty($this->$key)){
				$allfields[$key] = $this->$key;
				$emptyFlag = false;
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
	public function addImage($result){
		$maxsize = 1024000; //set to approx 1 MB
		$file = $result[0];		
		//check associated error code
		if($file['user_image']['error']==UPLOAD_ERR_OK) {
			//check whether file is uploaded with HTTP POST
			if(is_uploaded_file($file['user_image']['tmp_name'])) {
				//checks size of uploaded image on server side
				if( $file['user_image']['size'] < $maxsize) {
                    $fp = fopen($file['user_image']['tmp_name'], 'r');
                    $this->profile_image = fread($fp, $file['user_image']['size']);
                    fclose($fp);
				}
			}
		}
	}
}
?>