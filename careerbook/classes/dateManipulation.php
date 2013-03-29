<?php
/*
 **************************** Creation Log *******************************
File Name                   -  dateManipulation.php
Project Name                -  Careerbook
Description                 -  Class file for date manipulation
Version                     -  1.0
Created by                  -  Prateek Saini
Created on                  -  March 21, 2013
***************************** Update Log ********************************
Sr.NO.		Version		Updated by           Updated on          Description
-------------------------------------------------------------------------
*************************************************************************
*/
class dateManipulation {
	private $date;
	
	public function __construct(){
		$this->date = new DateTime();
	}
	//Reverse the date in parameter to year-month-date 
	public function reverseDate($temp){		
		$datearr = explode("/", $temp);
		$this->date->setDate($datearr[2], $datearr[0], $datearr[1]);
		return $this->date->format("Y-m-d");
	}
	//Reverse the date in parameter to year-month-date
	public function formatDate($temp, $format = "Y-m-d"){
	    $datearr = explode("-", $temp);	    	    
	    $this->date->setDate($datearr[0], $datearr[1], $datearr[2]);
	    return $this->date->format($format);
	}
	//Calculate the age from the given date in parameter to today date
	public function getAge($temp){
		$dateTemp = new DateTime($temp);
		$dateNow = new DateTime("now");
		$diff = $dateTemp->diff($dateNow);
		return $diff->format("Years-%Y Months-%m Days-%d");
		
//		echo $dateNow->format("Y-m-d");		
//		$dateTemp->format("Y-m-d");
	}
}
$objdate = new dateManipulation();
?>