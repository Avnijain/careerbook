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
	private $achievement;          //User achievements
	private $skill_set;            //User skills
	private $current_position;     //User current position in job
	private $current_company;      //User current position in company
	private $start_period;         //User current job start period

	public function getinfo($varname){
		return $this->$$varname;
	}
}
?>