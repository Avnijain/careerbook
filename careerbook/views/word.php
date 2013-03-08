

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

if((isset($_POST['template1']))&&($_POST['template1']=="use this template"))
{	
	echo "template1";
	header("Content-type: application/vnd.ms-word");
	header("Content-Disposition: attachment;Filename=template1.doc");
	echo "<html>";
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">";
	echo "<body>";
	echo "<b><center><h1>my name</h1></center></b>";  //name
	echo "<b><h3>Contact Information<h3></b>";
	echo "hhshsadjsjdj";
	echo "<b><h3>Personal Information</h3></b>";
	echo "hhshsadjsjdj";
	echo "<b><h3>Educational Information</h3></b>";
	echo "hhshsadjsjdj";
	echo "<b><h3>strength/skills</h3></b>";
	echo "hhshsadjsjdj";
	echo "<b><h3>employment information</h3></b>";
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
	echo "<b><center><h4>address</h4></center></b>";
	echo "<b><center><h4>my name email</h4></center></b>"; 
	echo "<b><h3>Snapshots</h3></b>";
	echo "hhshsadjsjdj";
	echo "<b><h3>Education</h3></b>";
	echo "<table><tr><td>Qualification</td><td>Institute/Board</td><td>Year</td></tr><tr></tr><tr></tr></table>";
	echo "<b><h3>Other Cousres</h3></b>";
	echo "hhshsadjsjdj";
	echo "<b><h3> Technical skills</h3></b>";
	echo "hhshsadjsjdj";
	echo "<b><h3>Academic project</h3></b>";
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
	echo "<b><h4>contact Number</h4></b>";
	echo "<b><h4>email address</h4></b>"; 
	echo "<b><h3>Objective</h3></b>";
	echo "hhshsadjsjdj";
	echo "<b><h3>Education</h3></b>";
	echo "hhshsadjsjdj";
	echo "<b><h3>Strength</h3></b>";
	echo "hhshsadjsjdj";
	echo "<b><h3>Career Graph</h3></b>";
	echo "hhshsadjsjdj";
	echo "<b><h3>Current Company</h3></b>";
	echo "hhshsadjsjdj";
	echo "<b><h3>Work Experience</h3></b>";
	echo "hhshsadjsjdj";
	echo "</body>";
	echo "</html>";
	
}
else
{
	echo"no button selected";
}

?>