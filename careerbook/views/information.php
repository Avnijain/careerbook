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
     
    *************************************************************************
*/
include_once("../classes/lang.php");
$field="it";
?>
<style>
body
{

background-color: #D0D0D0;
}
#main
{
background-image:url('../images/paper1.jpg');
color:white;
margin:35px 35px 35px 35px;
background-size:contain;
border-color:#668099;
}
p
{
background-color:#668099;
}
</style>

<body>
<div id="main">
	<h2><?php echo $lang->MYINFORMATION?></h2>
	<div id="mainframe">
	<h2><?php echo $lang->NAME?></h2><br/>
	<tr><td><img src="../images/a1.jpeg" height=35% width=15%/>
		<div id="Education">
			<p><?php echo $lang->EDUCATION?></p>
			<table cellspacing="10" cellpadding="5";>
			<tr><td><?php echo $lang->STD?></td><td><?php echo $lang->BOARD?></td><td><?php echo $lang->CPI?></td></tr>
			<tr><td><?php echo $lang->EDUCATION?></td><td><?php echo $lang->EDUCATION?></td><td><?php echo $lang->EDUCATION?></td></tr>
			<tr><td><?php echo $lang->EDUCATION?></td><td><?php echo $lang->EDUCATION?></td><td><?php echo $lang->EDUCATION?></td></tr>
			<table>
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