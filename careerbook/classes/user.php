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

class user_personal_info {
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
class user_academic_info {
	private $board_10;                           //User 10th Examination Board name
	private $school_10;                          //User 10th school name
	private $percentage_GPA_10;                  //User Percentage/GPA in 10th standard
	private $board_12;                           //User 12th Examination Board name
	private $school_12;                          //User 12th school name
	private $percentage_12;                      //User Percentage/GPA in 12th standard
	private $graduation_degree;                  //User Degree in graduation
	private $graduation_specialization;          //User specialization in graduation
	private $graduation_college;                 //User graduation college name
	private $graduation_percentage;              //User Percentage/GPA in graduation
	private $post_graduation_degree;             //User Degree in Post graduation
	private $post_graduation_specialization;     //User specialization in Post graduation
	private $post_graduation_college;            //User Post graduation college name
	private $post_graduation_percentage;         //User Percentage/GPA in Post graduation
	
	public function getinfo($varname){
		return $this->$$varname;
	}	
}
class user_professional_info {
	private $achievement;          //User achievements
	private $skill_set;            //User skills
	private $current_position;     //User current position in job
	private $current_company;      //User current position in company
	private $start_period;         //User current job start period
	
	public function getinfo($varname){
		return $this->$$varname;
	}
}