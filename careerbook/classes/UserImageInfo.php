<?php
/*
 **************************** Creation Log *******************************
File Name                   -  UserImageInfo.php
Project Name                -  Careerbook
Description                 -  Class file for users image information
Version                     -  1.0
Created by                  -  Prateek Saini
Created on                  -  March 24, 2013
***************************** Update Log ********************************
Sr.NO.		Version		Updated by           Updated on          Description
-------------------------------------------------------------------------
*************************************************************************
*/
class UserImageInfo {
	private $profile_image;               //User Image

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
			if(!empty($result[0][$key])){
				$this->$key = $result[0][$key];
			}			
			//print($this->$key);
		}
	}
	public function addImage($result){
		$maxsize = 1024000; //set to approx 1 MB
		$file = $result[0];
// 		print_r($file);
// 		die;
		
		//check associated error code
		if($file['user_image']['error']==UPLOAD_ERR_OK) {
			//check whether file is uploaded with HTTP POST
			if(is_uploaded_file($file['user_image']['tmp_name'])) {
				//checks size of uploaded image on server side
				if( $file['user_image']['size'] < $maxsize) {
					//checks whether uploaded file is of image type
					$finfo = finfo_open(FILEINFO_MIME_TYPE);
					if(strpos(finfo_file($finfo, $file['user_image']['tmp_name']),"image")===0) {
						// prepare the image for insertion
						$this->profile_image = addslashes (file_get_contents($file['user_image']['tmp_name']));
					}
				}
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