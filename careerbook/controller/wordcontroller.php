<?php 
/*
**************************** Creation Log *******************************
	File Name                   -  wordcontroller.php
    Project Name                -  Careerbook
    Description                 -  Controller for the resume word file
    Version                     -  1.0
    Created by                  -  Avni Jain
    Created on                  -  March 07, 2013
*/
include_once("../classes/lang.php");
include_once("../classes/dateManipulation.php");
require_once 'userInfo.php';

/****************************Getting the user information *************************************************/ 
$objUserInfo = unserialize($_SESSION['userData']);

$UserPersonalInfoDB = $objUserInfo->getUserPersonalInfo();
$UserAcademicInfoDB = $objUserInfo->getUserAcademicInfo();
$UserAddressInfoDB  = $objUserInfo->getUserAddressInfoDB();
$UserProjectInfoDB  = $objUserInfo->getUserProjectInfoDB();
$UserProfessionalInfoDB = $objUserInfo->getUserProfessionalInfoDB();
$UserAddressInfoDB  = $objUserInfo->getUserAddressInfo();
$UserPreviousJobInfo = $objUserInfo->getUserPreviousJobInfo();
$UserExtraCurricularobInfoDB = $objUserInfo->getUserExtraCurricularInfoDB();
$UserCertificateInfoDB=$objUserInfo->getUserCertificateInfoDB();
$projectCount=count($UserProjectInfoDB);                                    // to get the number of projects
$certificateCount=count($UserCertificateInfoDB);							//to get the total number of certifiactes
$extraCurricularCount=count($UserExtraCurricularobInfoDB);					//to get the count of Extra Curricular Activities
$first_name=$UserPersonalInfoDB['first_name']; 								// getting first name
$dob=($objdate->reverseDateClass($UserPersonalInfoDB['date_of_birth']));	//to get the date of birth in correct format
if((!empty($UserPreviousJobInfo['start_period']))&&(!empty($UserPreviousJobInfo['end_period']))) {
	$pastWorkDuration=($objdate->getDuration($UserPreviousJobInfo['start_period'],$UserPreviousJobInfo['end_period']));
	$year=explode(" ",$pastWorkDuration); // to get the working experience in correct format
	$onlyYear=$year[0];
	$onlyMonth=$year[1];
	$month=explode("-",$onlyMonth);
	$year=explode("-",$onlyYear);
    
    if($month[1]>0)
    {
    	$pastWorkDuration=$month[1]."$lang->MONTHS";
    }
    if($year[1]>0)
    {
     $pastWorkDuration=$year[1]."$lang->YEARS";
    	
    }
	}
	include_once "../View/word.php";
?>