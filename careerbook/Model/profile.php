<?php
/*
 **************************** Creation Log *******************************
File Name                   -  profile.php
Project Name                -  Careerbook
Description                 -  class for Profile
Version                     -  1.0
Created by                  -  Avni Jain
Created on                  -  March 29, 2013
***************************** Update Log ********************************
Sr.NO.		Version		Updated by           Updated on          Description
-------------------------------------------------------------------------
*************************************************************************

*/

ini_set("display_errors", "1");
require_once 'singleton.php';

//Model for profile class 
class Profile extends DBConnection {
	
	protected $userid;
	//function to get array of Academic Information
	function get_academic_info() {
		
		
		
		$this->From("user_academic_info");
		$this->Where(array("user_id"=>$this->userid));
		$this->Select();
		return $this->resultArray();
		echo $this->lastQuery();
	}
	
	//function to get array of user's previuos job information
	function get_previous_job_info() {
		
		$this->Fields(array(
							"position",
							"company",
							"start_period",
							"end_period"
							)
						);
		
		$this->From("user_previous_job_info");
		$this->Where(array("user_id"=>$this->userid));

		$this->Select();
		return $this->resultArray();
		
	}
	//function to get array of project information of the user
	function get_project_info() {
	
		$this->Fields(array(
				"project_description",
				"title",
				"technology_used",
				"duration"
		)
		);
		$this->From("user_project_info");
		$this->Where1(array("user_id"=>$this->userid));
		$this->Select();
		return $this->resultArray();
	
	}
	//function to get array of proffesional information of user
	function get_professional_info() {
		
		$this->Fields(array(
							"skill_set",
							"current_position",
							"current_company",
							"start_period"
							)
						);
		
		$this->From("user_professional_info");
		$this->Where(array("user_id"=>$this->userid));

		$this->Select();
		return $this->resultArray();
	}
	//function that will return the array of user personal information
	function get_info() {
	
		$this->Fields(array(
				"first_name",
				"middle_name",
				"last_name",
				"date_of_birth",
				"email_primary",
				"phone_no",
				"gender","profile_image"
		)
		);
	
		$this->From("users");	
		$this->Where1(array("id"=>$this->userid));
		$this->Select();
		return $this->resultArray();
	
	}
	//function to get certificate information of user
	function get_certificate_info() {
		$this->Fields(array(
				"name",
				"description",
				"duration"
		)
		);
		$this->From("user_certification_info");
		$this->Where1(array("user_id"=>$this->userid));
		$this->Select();
		return $this->resultArray();
	}
}
?>