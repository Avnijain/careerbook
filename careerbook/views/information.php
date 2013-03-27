<?php
/* **************************** Creation Log *******************************
    File Name                   -  information.php
    Project Name                -  Careerbook
    Description                 -  full inforamtion page of the user
    Version                     -  1.0
    Created by                  -  Avni Jain 
    Created on                  -  March 14, 2013
	***************************** Update Log ********************************
	Sr.NO.		Version		Updated by           Updated on          Description
    -------------------------------------------------------------------------
     1			1.0			Avni Jain			March 19,2013		extracting and displaying user information
    *************************************************************************
*/
include_once("../classes/lang.php");
$field="it";
require_once '../controller/userInfo.php';
$objUserInfo = unserialize($_SESSION['userData']);
$ob=$objUserInfo->getUserPersonalInfo();
$ob1=$objUserInfo->getUserAcademicInfo();
?>
<link rel="stylesheet" type="text/css" href="../css/information.css" />
<body>
<div id="main">
	<h2><?php echo $lang->MYINFORMATION?></h2>
	<div id="mainframe">
	<h2><?php echo $ob['first_name'];echo "   ";echo $ob['last_name'];?></h2><br/>
	<tr><td><img src="../images/a1.jpeg" height=35% width=15%/>
		<div id="Education">
			<p><?php echo $lang->EDUCATION?></p>
			<table cellspacing="10" cellpadding="5";>
			<tr><td><?php echo $lang->STD?></td><td><?php echo $lang->BOARD?></td><td><?php echo $lang->CPI?></td></tr>
			<tr><td><?php echo $lang->TENTH?></td><td><?php echo $ob1['board_10']?></td><td><?php echo $ob1['percentage_GPA_10']?></td></tr>
			<tr><td><?php echo $lang->TWELETH?></td><td><?php echo $ob1['board_10']?></td><td><?php echo $ob1['percentage_12']?></td></tr>
			<tr><td><?php echo $ob1['graduation_degree']?></td><td><?php echo $ob1['graduation_college']?></td><td><?php echo $ob1['graduation_percentage']?></td></tr>
			</table>
		</div>
		<div id="Skills"><p><?php echo $lang->SKILLS?></p></div>
		<?php if ($field=="it")?>
			<table cellspacing="10" cellpadding="5";>
			<tr><td><?php echo $lang->LANGUAGE?></td><td></td></tr>
			<tr><td><?php echo $lang->OPERATINGSYSTEM?></td><td></td></tr>
			<tr><td><?php echo $lang->DATABASE?></td><td></td></tr>
			<tr><td><?php echo $lang->IDE?></td><td></td></tr>
			</table>
			
		<div id="Industrial Experience"><p><?php echo $lang->INDUSTRIALEXPERIENCE?></p></div>
			<table cellspacing="10" cellpadding="5";>
			<tr><td><?php echo $lang->COMPANYNAME?></td><td></td></tr>
			<tr><td><?php echo $lang->DURATION?></td><td></td></tr>
			<tr><td><?php echo $lang->DESIGNATION?></td><td></td></tr>
			</table>
		<div id="Projects"><p><?php echo $lang->PROJECTS?></p></div>
		<div id="Achievements"><p><?php echo $lang->ACHIEVEMENTS?></p>
			<table cellspacing="10" cellpadding="5";>
			<tr><td><?php echo $lang->ACADEMIC?></td></tr>
			<tr><td><?php echo $lang->COCIRCULAR?></td></tr>
			</table>
		</div>
	</div>
</div>
</body>