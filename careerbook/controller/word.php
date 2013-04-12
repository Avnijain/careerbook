<?php
/*
**************************** Creation Log *******************************
	File Name                   -  word.php
    Project Name                -  Careerbook
    Description                 -  generating the resume word file
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
if((isset($_POST['template1']))&&($_POST['template1']=="Use this template")) // When first template is selected by user
{	
	echo "template1";
	header("Content-type: application/vnd.ms-word");    					// to open a word file
	header("Content-Disposition: attachment;Filename=$first_name.doc"); 	//word file of user's first name
	
	/*********************Displaying all the user information in selected first template format************************************/
	echo "<html>";
	echo "<body>";
	echo "<b><center><h1>";
	echo $UserPersonalInfoDB['first_name']." " ;
	echo $UserPersonalInfoDB['last_name'];
	echo "</h1></center></b>";  
	
	if(!empty($UserAddressInfoDB)) {
	    echo "<b><h3><u>$lang->CONTACTINFO</u><h3></b>";
		echo "<table>";
	    if(!empty($UserAddressInfoDB['address'])) { 
			echo "<tr><td>$lang->ADDRESS</td>";
			echo "<td>";
			echo $UserAddressInfoDB['address'];
			echo "</td></tr>";
		}
		if(!empty($UserAddressInfoDB['phone_no'])) { 
			echo "<tr><td>$lang->CONTACTNUMBER</td>";
			echo "<td>";
			echo $UserAddressInfoDB['phone_no'];
			echo "</td></tr>";
		}
		if(!empty($UserAddressInfoDB['email_primary'])) {
			echo "<tr><td>$lang->EMAILADDRESS</td>";
			echo "<td>";
			echo $UserAddressInfoDB['email_primary'];
			echo "</td></tr>";
		}
		echo "</table>";
	}	
	if(!empty($UserPersonalInfoDB)) {
		echo "<b><h3><u>$lang->PERSONALINFORMATION</u></h3></b>";
		echo "<table>";
		if(!empty($UserPersonalInfoDB['date_of_birth'])) {
			echo "<tr><td>$lang->DOB</td>";
			echo "<td>";
			echo $dob;
			echo "</td></tr>";
		}
		if(!empty($UserPersonalInfoDB['gender'])) {
			echo "<tr><td>$lang->GENDER</td>";
			echo "<td>";
			echo $UserPersonalInfoDB['gender'];
			echo "</td></tr>";
		}
		if(!empty($UserAddressInfoDB['nationality'])) {
			echo "<tr><td>$lang->NATIONALITY</td>";
			echo "<td>";
			echo $UserAddressInfoDB['nationality'];
			echo "</td></tr>";
		}
		if(!empty($UserAddressInfoDB['language'])) {
			echo "<tr><td>$lang->LANGUAGEPROFICENCY</td>";
			echo "<td>";
			echo $UserAddressInfoDB['language'];
			echo "</td></tr>";
		}
		if(!empty($UserExtraCurricularobInfoDB[0]['activity'])) {
			echo "<tr><td>$lang->EXTRACURRICULAR</td>";
			if($extraCurricularCount>=1) {
				for($i=0;$i<$extraCurricularCount;$i++) {
					echo "<td>";
					echo $UserExtraCurricularobInfoDB[$i]['activity'];
					echo "</td>";
				}
			}
			echo "</tr>";
		}	
		echo "</table>";
	}
	
	if(!empty($UserAcademicInfoDB)) {
		echo "<b><h3><u>$lang->EDUCATIONINFORMATION</u></h3></b>";
		echo "<table>";
		echo "<tr><td>$lang->STD</td><td>$lang->BOARD</td><td>$lang->SCHOOLCOLLEGE</td><td>$lang->CPI</td></tr>";
		if(!empty($UserAcademicInfoDB['board_10'])) {
			echo "<tr><td>$lang->TENTH</td><td>";
			echo $UserAcademicInfoDB['board_10'];
			echo "</td><td>";
			echo $UserAcademicInfoDB['school_10'];
			echo "</td><td>";
			if(!empty($UserAcademicInfoDB['percentage_GPA_10'])) {
			$UserAcademicInfoDB['percentage_GPA_10'] = ltrim($UserAcademicInfoDB['percentage_GPA_10'], '0');
			echo $UserAcademicInfoDB['percentage_GPA_10']; }
			echo "</td></tr>";
		}
		if(!empty($UserAcademicInfoDB['board_12'])) {  
			
			echo "<tr><td>$lang->TWELETH</td><td>";
			echo $UserAcademicInfoDB['board_12'];
			echo "</td><td>";
			echo $UserAcademicInfoDB['school_12'];
			echo "</td><td>";
			if(!empty($UserAcademicInfoDB['percentage_12'])) {
			$UserAcademicInfoDB['percentage_12'] = ltrim($UserAcademicInfoDB['percentage_12'], '0');
			echo $UserAcademicInfoDB['percentage_12']; }
			echo "</td></tr>";
		}
		if(!empty($UserAcademicInfoDB['graduation_degree'])) {  
			echo "<tr><td>$lang->GRADUATION</td><td>";
			echo $UserAcademicInfoDB['graduation_specialization'];
			echo "</td><td>";
			echo $UserAcademicInfoDB['graduation_college'];
			echo "</td><td>";
			if(!empty($UserAcademicInfoDB['graduation_percentage'])) {
			$UserAcademicInfoDB['graduation_percentage'] = ltrim($UserAcademicInfoDB['graduation_percentage'], '0');
			echo $UserAcademicInfoDB['graduation_percentage']; }
			echo "</td></tr>";
		}
		if(!empty($UserAcademicInfoDB['post_graduation_degree'])) {  
			echo "<tr><td>$lang->GRADUATION</td><td>";
			echo $UserAcademicInfoDB['post_graduation_degree'];
			echo "</td><td>";
			echo $UserAcademicInfoDB['post_graduation_college'];
			echo "</td><td>";
			if(!empty($UserAcademicInfoDB['post_graduation_percentage'])) {
			$UserAcademicInfoDB['post_graduation_percentage'] = ltrim($UserAcademicInfoDB['post_graduation_percentage'], '0');
			echo $UserAcademicInfoDB['post_graduation_percentage']; }
			echo "</td></tr>";
		}
		echo "</table>";
	}
	if(!empty($UserProfessionalInfoDB['skill_set'])) { 
		echo "<b><h3><u>$lang->STRENGHTSKILLS</u></h3></b>";
		echo $UserProfessionalInfoDB['skill_set'];
	}
	if($projectCount>1) {
		echo "<b><h3><u>$lang->PROJECT</u></h3></b>";
		echo "<table><tr><td>$lang->TITLE</td><td>$lang->DESCRIPTION</td><td>$lang->TECHNOLOGYUSED</td><td>$lang->DURATION</td></td>";
		for($i=0;$i<$projectCount;$i++) {
			echo "<tr><td>";
			echo $UserProjectInfoDB[$i]['title'];
			echo "</td><td>";
			echo $UserProjectInfoDB[$i]['project_description'];
			echo "</td><td>";
			echo $UserProjectInfoDB[$i]['technology_used'];
			echo "</td><td>";
			echo $UserProjectInfoDB[$i]['duration'];
			echo "</td></tr>";
		}
		echo "</table>";
	}
	
	if(!empty($UserProfessionalInfoDB['current_company'])) { 
		echo "<b><h3><u>$lang->EMPLOYMENTINFORMATION</u></h3></b>";
		echo "<table><tr><td>$lang->COMPANYNAME</td><td>";
		echo  $UserProfessionalInfoDB['current_company'];
		echo "</td></tr>";
		echo "<tr><td>$lang->DESIGNATION</td><td>";
		echo  $UserProfessionalInfoDB['current_position'];
		echo "</td></tr>";
		echo "<tr><td>$lang->WORKINGFROM</td><td>";
		echo ($objdate->reverseDateClass($UserProfessionalInfoDB['start_period']));
		echo "</td></tr>";
		echo "</table>";
	}
	echo "</body>";
	echo "</html>";
}

else if((isset($_POST['template2']))&&($_POST['template2']=="Use this template"))	// When second template is selected by user
{
	header("Content-type: application/vnd.ms-word");
	header("Content-Disposition: attachment;Filename=$first_name.doc");
	
	/*********************Displaying all the user information in selected second template format************************************/
	echo "<html>";
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
	echo "<body>";
	echo "<b><center><h1>";
	echo $UserPersonalInfoDB['first_name']." " ;
	echo $UserPersonalInfoDB['last_name'];
	echo "</h1></center></b>";  
	if(!empty($UserAddressInfoDB['address'])) { 
		echo "<b><center><h4>";
		echo $UserAddressInfoDB['address'];
		echo "</h4></center></b>";
	}	
	if(!empty($UserAddressInfoDB['phone_no'])) { 
		echo "<b><center><h4>";
		echo $UserAddressInfoDB['phone_no'];
		echo "</h4></center></b>";
		}
	if(!empty($UserAddressInfoDB['email_primary'])) {
		echo "<b><center><h4>";
		echo $UserAddressInfoDB['email_primary'];
		echo "</h4></center></b>";
	}
	echo "<hr noshade size=4 width=50%>";
	echo "<b><h3>$lang->SNAPSHOT</h3></b>";
	echo "<hr noshade>";
	if(!empty($UserProfessionalInfoDB['current_company'])) { 
		echo "$lang->CURRENTLYWORKINGIN "." ";
		echo $UserProfessionalInfoDB['current_company'];
		echo "$lang->AS "."  ";
		echo $UserProfessionalInfoDB['current_position'];
		echo "<br/>";
	}
	if(($certificateCount>=1)&&!empty($UserCertificateInfoDB[0]['name'])) {
		for($i=0;$i<$certificateCount;$i++) {
			echo $UserCertificateInfoDB[$i]['name']." ";
			echo "$lang->CERTIFIED"." ";
			if(!empty( $UserCertificateInfoDB[$i]['duration'])) {
				echo "$lang->DATED"." ";
				echo ($objdate->reverseDate($UserCertificateInfoDB[$i]['duration']));
			echo "<br/>";
			}
		}
	}
	if((!empty($UserPreviousJobInfo['company']))&&(!empty($UserPreviousJobInfo['start_period']))
	   &&(!empty($UserPreviousJobInfo['end_period']))&&(!empty($UserPreviousJobInfo['position']))) {
	    echo "$lang->EXPERIENCE"." ";
		echo $pastWorkDuration." ";
		echo "$lang->WORKEDIN"." ";
		echo $UserPreviousJobInfo['company'];
		echo "<br/>";
	}
	if(!empty($UserAcademicInfoDB)) {
	echo "<b><h3>$lang->EDUCATION</h3></b>";
	echo "<hr noshade size=3>";
	echo "<table><tr><td>$lang->QUALIFICATION</td><td>$lang->INSTITUTEBOARD</td><td>$lang->SCHOOLCOLLEGE</td><td>$lang->CPI</td></tr>";
		if(!empty($UserAcademicInfoDB['board_10'])) {
			echo "<tr><td>$lang->TENTH</td><td>";
			echo $UserAcademicInfoDB['board_10'];
			echo "</td><td>";
			echo $UserAcademicInfoDB['school_10'];
			echo "</td><td>";
			if(!empty($UserAcademicInfoDB['percentage_GPA_10'])) {
			$UserAcademicInfoDB['percentage_GPA_10'] = ltrim($UserAcademicInfoDB['percentage_GPA_10'], '0');
			echo $UserAcademicInfoDB['percentage_GPA_10']; }
			echo "</td></tr>";
		}
		if(!empty($UserAcademicInfoDB['board_12'])) {  
			
			echo "<tr><td>$lang->TWELETH</td><td>";
			echo $UserAcademicInfoDB['board_12'];
			echo "</td><td>";
			echo $UserAcademicInfoDB['school_12'];
			echo "</td><td>";
			if(!empty($UserAcademicInfoDB['percentage_12'])) {
			$UserAcademicInfoDB['percentage_12'] = ltrim($UserAcademicInfoDB['percentage_12'], '0');
			echo $UserAcademicInfoDB['percentage_12']; }
			echo "</td></tr>";
		}
		if(!empty($UserAcademicInfoDB['graduation_degree'])) {  
			echo "<tr><td>$lang->GRADUATION</td><td>";
			echo $UserAcademicInfoDB['graduation_specialization'];
			echo "</td><td>";
			echo $UserAcademicInfoDB['graduation_college'];
			echo "</td><td>";
			if(!empty($UserAcademicInfoDB['graduation_percentage'])) {
			$UserAcademicInfoDB['graduation_percentage'] = ltrim($UserAcademicInfoDB['graduation_percentage'], '0');
			echo $UserAcademicInfoDB['graduation_percentage']; }
			echo "</td></tr>";
		}
		if(!empty($UserAcademicInfoDB['post_graduation_degree'])) {  
			echo "<tr><td>$lang->GRADUATION</td><td>";
			echo $UserAcademicInfoDB['post_graduation_degree'];
			echo "</td><td>";
			echo $UserAcademicInfoDB['post_graduation_college'];
			echo "</td><td>";
			if(!empty($UserAcademicInfoDB['post_graduation_percentage'])) {
			$UserAcademicInfoDB['post_graduation_percentage'] = ltrim($UserAcademicInfoDB['post_graduation_percentage'], '0');
			echo $UserAcademicInfoDB['post_graduation_percentage']; }
			echo "</td></tr>";
		}
		echo "</table>";
	}	
	
	if(!empty($UserProfessionalInfoDB['skill_set'])) {
		echo "<b><h3> $lang->TECHNICALSKILLS</h3></b>";
		echo "<hr noshade size=3>";
		echo $UserProfessionalInfoDB['skill_set'];
	}
	if(($projectCount>=1)&&!empty($UserProjectInfoDB[0]['title'])){
		echo "<b><h3>$lang->ACADEMICPROJECT</h3></b>";
		echo "<hr noshade size=3>";
		echo "<table><tr><td>$lang->TITLE</td><td>$lang->DESCRIPTION</td><td>$lang->TECHNOLOGYUSED</td><td>$lang->DURATION</td></td>";
		for($j=0;$j<$projectCount;$j++) {
			echo "<tr><td>";
			echo $UserProjectInfoDB[$j]['title'];
			echo "</td><td>";
			echo $UserProjectInfoDB[$j]['project_description'];
			echo "</td><td>";
			echo $UserProjectInfoDB[$j]['technology_used'];
			echo "</td><td>";
			echo $UserProjectInfoDB[$j]['duration'];
			echo "</td></tr>";
		}
		echo "</body>";
		echo "</html>";
	}
}	
else if($_POST['template3']=="Use this template")	// When third template is selected by user
{
	
    header("Content-type: application/vnd.ms-word");
	header("Content-Disposition: attachment;Filename=$first_name.doc");
	/*********************Displaying all the user information in third template format************************************/
	echo "<html>";
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
	echo "<body>";
	echo "<b><h1>";
	echo $UserPersonalInfoDB['first_name']." " ;
	echo $UserPersonalInfoDB['last_name'];
	echo "</h1></b>";  
	if(!empty($UserAddressInfoDB['address'])) { 
		echo "<b><h4>";
		echo $UserAddressInfoDB['address'];
		echo "</h4></b>";
	}	
	if(!empty($UserAddressInfoDB['phone_no'])) { 
		echo "<b><h4>";
		echo $UserAddressInfoDB['phone_no'];
		echo "</h4></b>";
		}
	if(!empty($UserAddressInfoDB['email_primary'])) {
		echo "<b><h4>";
		echo $UserAddressInfoDB['email_primary'];
		echo "</h4></b>";
	}
	echo "<hr noshade size=4 >";
	echo "<b><h3>$lang->OBJECTIVE</h3></b>";
	echo "$lang->OBJECTIVE1";

	if(!empty($UserAcademicInfoDB)) {
		echo "<b><h3>$lang->EDUCATION</h3></b>";
		echo "<table>";
		echo "<tr><td>$lang->STD</td><td>$lang->BOARD</td><td>$lang->SCHOOLCOLLEGE</td><td>$lang->CPI</td></tr>";
		if(!empty($UserAcademicInfoDB['board_10'])) {
			echo "<tr><td>$lang->TENTH</td><td>";
			echo $UserAcademicInfoDB['board_10'];
			echo "</td><td>";
			echo $UserAcademicInfoDB['school_10'];
			echo "</td><td>";
			if(!empty($UserAcademicInfoDB['percentage_GPA_10'])) {
			$UserAcademicInfoDB['percentage_GPA_10'] = ltrim($UserAcademicInfoDB['percentage_GPA_10'], '0');
			echo $UserAcademicInfoDB['percentage_GPA_10']; }
			echo "</td></tr>";
		}
		if(!empty($UserAcademicInfoDB['board_12'])) {  
		
			echo "<tr><td>$lang->TWELETH</td><td>";
			echo $UserAcademicInfoDB['board_12'];
			echo "</td><td>";
			echo $UserAcademicInfoDB['school_12'];
			echo "</td><td>";
			if(!empty($UserAcademicInfoDB['percentage_12'])) {
			$UserAcademicInfoDB['percentage_12'] = ltrim($UserAcademicInfoDB['percentage_12'], '0');
			echo $UserAcademicInfoDB['percentage_12'];}
			echo "</td></tr>";
		}
		if(!empty($UserAcademicInfoDB['graduation_degree'])) {  
			echo "<tr><td>$lang->GRADUATION</td><td>";
			echo $UserAcademicInfoDB['graduation_specialization'];
			echo "</td><td>";
			echo $UserAcademicInfoDB['graduation_college'];
			echo "</td><td>";
			if(!empty($UserAcademicInfoDB['graduation_percentage'])) {
			$UserAcademicInfoDB['graduation_percentage'] = ltrim($UserAcademicInfoDB['graduation_percentage'], '0');
			echo $UserAcademicInfoDB['graduation_percentage'];} 
			echo "</td></tr>";
		}
		if(!empty($UserAcademicInfoDB['post_graduation_degree'])) {  
			echo "<tr><td>$lang->GRADUATION</td><td>";
			echo $UserAcademicInfoDB['post_graduation_degree'];
			echo "</td><td>";
			echo $UserAcademicInfoDB['post_graduation_college'];
			echo "</td><td>";
			if(!empty($UserAcademicInfoDB['post_graduation_percentage'])) {
			$UserAcademicInfoDB['post_graduation_percentage'] = ltrim($UserAcademicInfoDB['post_graduation_percentage'], '0');
			echo $UserAcademicInfoDB['post_graduation_percentage']; }
			echo "</td></tr>";
		}
		echo "</table>";
	}
	if(($certificateCount>=1)&&!empty($UserCertificateInfoDB[0]['name'])) {
		echo "<b><h3>$lang->CERTIFICATION</h3></b>";
		echo "<table>";
		echo "<tr><td>$lang->NAME</td><td>$lang->CERTIFICATEDESCRIPTION</td><td>$lang->DATED</td></tr>";
		for($i=0;$i<$certificateCount;$i++) {
			echo "<tr><td>";
			echo $UserCertificateInfoDB[$i]['name'];
			echo "</td><td>";
			echo $UserCertificateInfoDB[$i]['description']; 
			echo "</td>";
			if(!empty( $UserCertificateInfoDB[$i]['duration'])) {
			echo "<td>";
			echo ($objdate->reverseDate($UserCertificateInfoDB[$i]['duration']));
			echo "</td>";
			}
			echo "</tr>";
		}
		echo "</table>";
	}
	
	if(!empty($UserProfessionalInfoDB['current_company'])) { 
	echo "<b><h3>$lang->CURRENTCOMPANY</h3></b>";
	echo "<table><tr><td>$lang->COMPANYNAME</td><td>";
	echo  $UserProfessionalInfoDB['current_company'];
	echo "</td></tr>";
	echo "<tr><td>$lang->DESIGNATION</td><td>";
	echo  $UserProfessionalInfoDB['current_position'];
	echo "</td></tr>";
	echo "<tr><td>$lang->WORKINGFROM</td><td>";
	echo  ($objdate->reverseDateClass($UserProfessionalInfoDB['start_period']));
	echo "</td></tr>";
	echo "</table>";
	}
	echo "<b><h3>$lang->WORKEXPERIENCE</h3></b>";
	if(!empty($UserPreviousJobInfo['company'])) {
		echo "$lang->WORKEDIN<b>"."  ";
		echo $UserPreviousJobInfo['company']. " ";
		echo "</b>";
	}	
	if(!empty($UserPreviousJobInfo['position'])) {
		echo "$lang->AS<b>"." ";
		echo $UserPreviousJobInfo['position'];
		echo "</b>";
	}
	if((!empty($UserPreviousJobInfo['start_period']))&&(!empty($UserPreviousJobInfo['end_period']))) {
		echo "$lang->FROM"." ";
		echo $objdate->reverseDateClass($UserPreviousJobInfo['start_period'])." ";
		echo "$lang->TO"." ";
		echo $objdate->reverseDateClass($UserPreviousJobInfo['end_period']);
	}	
	echo "</body>";
	echo "</html>";
	
}
else
{
	echo "$lang->WORDERROR";
}

?>