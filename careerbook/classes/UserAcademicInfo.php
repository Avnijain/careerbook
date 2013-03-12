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
class UserAcademicInfo {
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
?>