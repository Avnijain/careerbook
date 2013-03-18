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
$ObjuserInfo = unserialize($_SESSION['userData']);




if((isset($_POST['template1']))&&($_POST['template1']=="use this template"))
{	
	echo "template1";
	header("Content-type: application/vnd.ms-word");
	header("Content-Disposition: attachment;Filename=template1.doc");
	echo "<html>";
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
	echo "<body>";
	echo "<b><center><h1>my name</h1></center></b>";  //name
	echo "<b><h3>$lang->CONTACTINFO<h3></b>";
	echo "hhshsadjsjdj";
	echo "<b><h3>$lang->PERSONALINFORMATION</h3></b>";
	echo "hhshsadjsjdj";
	echo "<b><h3>$lang->EDUCATIONINFORMATION</h3></b>";
	echo "hhshsadjsjdj";
	echo "<b><h3>$lang->STRENGHTSKILLS</h3></b>";
	echo "hhshsadjsjdj";
	echo "<b><h3>$lang->EMPLOYMENTINFORMATION</h3></b>";
	echo "hhshsadjsjdj";
	echo "</body>";
	echo "</html>";
}
else if((isset($_POST['template2']))&&($_POST['template2']=="use this template"))
{
	echo "template2";
	header("Content-type: application/vnd.ms-word");
	header("Content-Disposition: attachment;Filename=template2.doc");
	echo "<html>";
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
	echo "<body>";
	echo "<b><center><h1>my name</h1></center></b>";  //name
	echo "<b><center><h4>$lang->ADDRESS</h4></center></b>";
	echo "<b><center><h4>my name email</h4></center></b>"; 
	echo "<b><h3>$lang->SNAPSHOT</h3></b>";
	echo "hhshsadjsjdj";
	echo "<b><h3>$lang->EDUCATION</h3></b>";
	echo "<table><tr><td>$lang->QUALIFICATION</td><td>$lang->INSTITUTEBOARD</td><td>$lang->YEAR</td></tr><tr></tr><tr></tr></table>";
	echo "<b><h3>$lang->OTHERCOURSES</h3></b>";
	echo "hhshsadjsjdj";
	echo "<b><h3> $lang->TECHNICALSKILLS</h3></b>";
	echo "hhshsadjsjdj";
	echo "<b><h3>$lang->ACADEMICPROJECT</h3></b>";
	echo "hhshsadjsjdj";
	echo "</body>";
	echo "</html>";
}
else if($_POST['template3']=="use this template")
{
	echo "template3";
	header("Content-type: application/vnd.ms-word");
	header("Content-Disposition: attachment;Filename=template3.doc");
	echo "<html>";
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
	echo "<body>";
	echo "<b><h1>my name</h1></b>";  //name
	echo "<b><h4>$lang->CONTACTNUMBER</h4></b>";
	echo "<b><h4>$lang->EMAILADDRESS</h4></b>"; 
	echo "<b><h3>$lang->OBJECTIVE</h3></b>";
	echo "hhshsadjsjdj";
	echo "<b><h3>$lang->EDUCATION</h3></b>";
	echo "hhshsadjsjdj";
	echo "<b><h3>$lang->STRENGHT</h3></b>";
	echo "hhshsadjsjdj";
	echo "<b><h3>$lang->CAREERGRAPH</h3></b>";
	echo "hhshsadjsjdj";
	echo "<b><h3>$lang->CURRENTCOMPANY</h3></b>";
	echo "hhshsadjsjdj";
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