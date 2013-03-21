<?php
class dateManipulation {
	private $date;
	
	public function reverseDate($temp){		
		$date = new DateTime();
		$datearr = explode("/", $temp);
		$date->setDate($datearr[2], $datearr[0], $datearr[1]);
		return $date->format("Y-m-d");
	}	
}
$objdate = new dateManipulation();
?>