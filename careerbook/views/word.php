<?php
include_once("../classes/lang.php");
?>

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

/*header("Content-type: application/vnd.ms-word");

header("Content-Disposition: attachment;Filename=document_name.doc");*/
require_once '../controller/userInfo.php';
$objUserInfo = unserialize($_SESSION['userData']);
 print_r ($objUserInfo->getUserPersonalInfo());
$ob=$objUserInfo->getUserPersonalInfo();
$ob1=$objUserInfo->getUserAcademicInfo();
$UserAddressInfoDB = $objUserInfo->getUserAddressInfoDB();
$UserProjectInfoDB = $objUserInfo->getUserProjectInfoDB();
$UserProfessionalInfoDB = $objUserInfo->getUserProfessionalInfoDB();

//print_r ($UserProjectInfoDB);
$n=count($UserProjectInfoDB);
$fname=$ob['first_name'];
$lname=$ob['last_name'];
$dob=$ob['date_of_birth'];
$email=$ob['email_primary'];
$ph=$ob['phone_no'];
$gender=$ob['gender'];
$board10=$ob1[board_10]; 
$school10=$ob1[school_10]; 
$marks10=$ob1[percentage_GPA_10];
$board12=$ob1[board_12]; 
$scholl12=$ob1[school_12];
$marks12=$ob1[percentage_12]; 
$grad=$ob1[graduation_degree]; 
$grads=$ob1[graduation_specialization]; 
$gradclg=$ob1[graduation_college]; 
$marksg=$ob1[graduation_percentage]; 
//$fname=$ob['first_name'];

if((isset($_POST['template1']))&&($_POST['template1']=="use this template"))
{	
	echo "template1";
	header("Content-type: application/vnd.ms-word");
	header("Content-Disposition: attachment;Filename=$fname.doc");
	echo "<html>";
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
	echo "<body>";
	echo "<b><center><h1>$fname $lname</h1></center></b>";  //name
	echo "<b><h3>$lang->CONTACTINFO<h3></b>";
	echo "<table><tr><td>$lang->ADDRESS</td>";
	echo "<td></td></tr>";
	echo "<tr><td>$lang->CONTACTNUMBER</td>";
	echo "<td>$ph</td></tr>";
	echo "<tr><td>$lang->EMAILADDRESS</td>";
	echo "<td>$email</td></tr></table>";
	echo "<b><h3>$lang->PERSONALINFORMATION</h3></b>";
	echo "<table><tr><td>$lang->DOB</td>";
	echo "<td>$dob</td></tr>";
	echo "<tr><td>$lang->GENDER</td>";
	echo "<td>$gender</td></tr>";
	echo "<tr><td>$lang->LANGUAGEPROFICENCY</td>";
	echo "<td>$email</td></tr></table>";
	echo "<b><h3>$lang->EDUCATIONINFORMATION</h3></b>";
	echo "<table>";
	echo "<tr><td>$lang->STD</td><td>$lang->BOARD</td><td>$lang->CPI</td></tr>";
	echo "<tr><td>$lang->TENTH</td><td>$board10</td><td>$marks10</td></tr>";
	echo "<tr><td>$lang->TWELETH</td><td>$board12</td><td>$marks12</td></tr>";
	echo "<tr><td>$lang->GRADUATION</td><td>$grad</td><td>$marksg</td></tr></table>";
	echo "<b><h3>$lang->STRENGHTSKILLS</h3></b>";
	echo $UserProfessionalInfoDB['skill_set'];
	echo "<b><h3>$lang->PROJECT</h3></b>";
	echo "<table><tr><td>$lang->TITLE</td><td>$lang->DESCRIPTION</td><td>$lang->TECHNOLOGYUSED</td><td>$lang->DURATION</td></td>";
	for($i=0;$i<$n;$i++)
	{
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
	echo "<b><h3>$lang->EMPLOYMENTINFORMATION</h3></b>";
	echo "<table><tr><td>$lang->COMPANYNAME</td><td>";
	echo  $UserProfessionalInfoDB['current_company'];
	echo "</td></tr>";
	echo "<tr><td>$lang->DESIGNATION</td><td>";
	echo  $UserProfessionalInfoDB['current_position'];
	echo "</td></tr>";
	echo "<tr><td>$lang->DURATION</td><td>";
	echo  $UserProfessionalInfoDB['start_period'];
	echo "</td></tr>";
	echo "</table>";
	echo "</body>";
	echo "</html>";
}
else if((isset($_POST['template2']))&&($_POST['template2']=="use this template"))
{
	print_r ($objUserInfo->getUserPersonalInfo());
	echo "template2";
	header("Content-type: application/vnd.ms-word");
	header("Content-Disposition: attachment;Filename=$fname.doc");
	echo "<html>";
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
	echo "<body>";
	echo "<b><center><h1>$fname $lname</h1></center></b>";  //name
	echo "<b><center><h4>$lang->ADDRESS</h4></center></b>";
	echo "<b><center><h4>$email</h4></center></b>";
	echo "<b><center><h4>$ph</h4></center></b>";
	echo "<b><h3>$lang->SNAPSHOT</h3></b>";
	echo "hhshsadjsjdj";
	echo "<b><h3>$lang->EDUCATION</h3></b>";
	echo "<table><tr><td>$lang->QUALIFICATION</td><td>$lang->INSTITUTEBOARD</td><td>$lang->YEAR</td></tr><tr></tr><tr></tr>";
	echo "<tr><td>$lang->TENTH</td><td>$board10</td><td>$marks10</td></tr>";
	echo "<tr><td>$lang->TWELETH</td><td>$board12</td><td>$marks12</td></tr>";
	echo "<tr><td>$lang->GRADUATION</td><td>$grad</td><td>$marksg</td></tr></table>";
	echo "<b><h3>$lang->OTHERCOURSES</h3></b>";
	echo "hhshsadjsjdj";
	echo "<b><h3> $lang->TECHNICALSKILLS</h3></b>";
	echo $UserProfessionalInfoDB['skill_set'];
	echo "<b><h3>$lang->ACADEMICPROJECT</h3></b>";
	echo "<table><tr><td>$lang->TITLE</td><td>$lang->DESCRIPTION</td><td>$lang->TECHNOLOGYUSED</td><td>$lang->DURATION</td></td>";
	for($j=0;$j<$n;$i++)
	{
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
else if($_POST['template3']=="use this template")
{
	echo "template3";
	header("Content-type: application/vnd.ms-word");
	header("Content-Disposition: attachment;Filename=$fname.doc");
	echo "<html>";
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
	echo "<body>";
	echo "<b><h1>$fname $lname</h1></b>";  //name
	echo "<b><h4>$ph</h4></b>";
	echo "<b><h4>$email</h4></b>"; 
	echo "<b><h3>$lang->OBJECTIVE</h3></b>";
	echo "$lang->OBJECTIVE1";
	echo "<b><h3>$lang->EDUCATION</h3></b>";
	echo "<table>";
	echo "<tr><td>$lang->STD</td><td>$lang->BOARD</td><td>$lang->CPI</td></tr>";
	echo "<tr><td>$lang->TENTH</td><td>$board10</td><td>$marks10</td></tr>";
	echo "<tr><td>$lang->TWELETH</td><td>$board12</td><td>$marks12</td></tr>";
	echo "<tr><td>$lang->GRADUATION</td><td>$grad</td><td>$marksg</td></tr></table>";
	echo "<b><h3>$lang->STRENGHT</h3></b>";
	echo "hhshsadjsjdj";
	echo "<b><h3>$lang->CAREERGRAPH</h3></b>";
	echo "hhshsadjsjdj";
	echo "<b><h3>$lang->CURRENTCOMPANY</h3></b>";
	echo "<table><tr><td>$lang->COMPANYNAME</td><td>";
	echo  $UserProfessionalInfoDB['current_company'];
	echo "</td></tr>";
	echo "<tr><td>$lang->DESIGNATION</td><td>";
	echo  $UserProfessionalInfoDB['current_position'];
	echo "</td></tr>";
	echo "<tr><td>$lang->DURATION</td><td>";
	echo  $UserProfessionalInfoDB['start_period'];
	echo "</td></tr>";
	echo "</table>";
	echo "<b><h3>$lang->WORKEXPERIENCE</h3></b>";
	echo "hhshsadjsjdj";
	echo "</body>";
	echo "</html>";
	
}
else
{
	echo"no button selected";
}

?>