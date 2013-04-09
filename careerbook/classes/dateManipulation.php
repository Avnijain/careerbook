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
		$date=$datearr[2]."/".$datearr[1]."/".$datearr[0];
		return $date;
	}
	public function reverseDateClass($temp){		
		$datearr = explode("-", $temp);
		$date=$datearr[2]."-".$datearr[1]."-".$datearr[0];
		return $date;
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
	public function getDuration($date1,$date2) {
		/*$start = strtotime($date1);
		$end = strtotime($date2);

		$days_between = ceil(abs($end - $start) / 86400);
		return $days_between;
		*/
		$d1=new DateTime($date1);
		$d2=new DateTime($date2);
		$diff=$d1->diff($d2);
		return $diff->format("Years-%Y Months-%m Days-%d");
		return($diff);
	
	}
}
$objdate = new dateManipulation();
?>