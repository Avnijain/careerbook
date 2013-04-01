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

require_once '../controller/userInfo.php';
require_once '../controller/profile_controller.php';

if(isset($_SESSION['userData']))
{
	$ob1 = new user_info_controller();
	$ob1 = unserialize($_SESSION['userData']);
	$userid = $ob1->getUserIdInfo();
	$idd = $userid['id'];
}
if(isset($_REQUEST['user_id'])) //if viewing friend's profile 
{
$id=$_GET['user_id'];
}
else {							//viewing own profile
	$id=$idd;
}

$obj->setId($id);				 //setting the id of the user in profile class through profile controller function

/***********Getting All user information from profile model class through profile controller functions******************/
$acdemicInfo=$obj->handleAcademicInfo();
$personalInfo=$obj->handlePersonalInfo();
$projectInfo=$obj->handleProjectInfo();
$jobInfo=$obj->handlePreviousJobInfo();
$professionalInfo=$obj->handleProfessionalInfo();
?>
<link rel="stylesheet" type="text/css" href="../css/information.css" />

<body>
<div id="main">
	<h2></h2>
	<div id="mainframe">
	<?php if(isset($personalInfo)) {?>
	<h1><?php echo $personalInfo['0']['first_name']." ";echo $personalInfo['0']['middle_name']." ";echo $personalInfo['0']['last_name'];?></h1>
	<br/>
	<?php if(isset($personalInfo['0']['profile_image'])) { 
			$uri = 'data:image/png;base64,'.base64_encode($personalInfo['0']['profile_image']);
		?>
			<img src="<?php echo $uri;?>" height=20% width=15%/>
		<?php } ?>
	<div id="left">
	
	<h4><?php echo $lang->PRIMARYEMAIL.": "; echo $personalInfo['0']['email_primary'];?></h4>
	<h4><?php echo $lang->GENDER.": "; echo $personalInfo['0']['gender'];?></h4>
	<h4><?php echo $lang->PHONENUMBER.": ";echo $personalInfo['0']['phone_no']; }?></h4>
	<?php if(!empty($professionalInfo['0']['current_company'])) { ?>
	<h4><?php echo $lang->CURRENTLYWORKINGIN ." "; echo $professionalInfo['0']['current_company'];?> <?php echo $lang->AS." ";echo $professionalInfo['0']['current_position'];?></h4>
		<?php }?></div>
		<br/><br/><br/><br/>
		<?php if(!empty($acdemicInfo)) { ?>
		<div id="Education">
			<heading><?php echo $lang->EDUCATION?></heading>
			<table cellspacing="10" cellpadding="5";>
			<tr><td><?php echo $lang->STD?></td><?php if((!empty($acdemicInfo['0']['board_10']))||(!empty($acdemicInfo['0']['board_12']))) {?><td><?php echo $lang->BOARD ?><?php }?></td><td><?php echo $lang->SCHOOLCOLLEGE?></td></tr>
			<tr><td><?php if((!empty($acdemicInfo['0']['board_10']))||(!empty($acdemicInfo['0']['school_10'])))echo $lang->TENTH ?></td><td><?php if(!empty($acdemicInfo['0']['board_10']))echo $acdemicInfo['0']['board_10']?></td><td><?php echo $acdemicInfo['0']['school_10']?></td></tr>
			<tr><td><?php if((!empty($acdemicInfo['0']['board_12']))||(!empty($acdemicInfo['0']['school_12'])))echo $lang->TWELETH ?></td><?php if(!empty($acdemicInfo['0']['board_12'])) {?><td><?php  echo $acdemicInfo['0']['board_12']?></td><?php }?><td><?php echo $acdemicInfo['0']['school_12']?></td></tr>
			<tr><td><?php echo $acdemicInfo['0']['graduation_degree']?></td><td><?php echo $acdemicInfo['0']['graduation_specialization']?></td><td><?php echo $acdemicInfo['0']['graduation_college']?></td></tr>
			<tr><td><?php echo $acdemicInfo['0']['post_graduation_degree']?></td><td><?php echo $acdemicInfo['0']['post_graduation_specialization']?></td><td><?php echo $acdemicInfo['0']['post_graduation_college']?></td></tr>
			</table>
		</div>
		<?php }?>
		<?php if(!empty($professionalInfo)) { ?>
			<div id="Skills"><heading><?php echo $lang->SKILLS?></heading></div><br/>
			<?php $skillSet=$professionalInfo['0']['skill_set'];
			$skillArray=explode(',',$skillSet);
			$skillCount=count($skillArray);
			?>
			<p id ="skill">
		    <table cellspacing="10" cellpadding="5";>
		    <?php for($i=0;$i<$skillCount;$i++) {
				echo "<td>";
				echo $skillArray[$i];
				echo "</td>"; 
				}
			echo "</tr></table>";
			?>
		<?php }?>
		</p>
		<?php if(!empty($jobInfo)) { ?>
		<div id="Industrial Experience"><heading><?php echo $lang->INDUSTRIALEXPERIENCE?></heading></div>
			<table cellspacing="10" cellpadding="5";>
			<tr><td><?php echo $lang->COMPANYNAME?></td><td><?php echo $jobInfo['0']['company'] ?></td></tr>
			<tr><td><?php echo $lang->DESIGNATION?></td><td><?php echo $jobInfo['0']['position'] ?></td></tr>
			</table>
			<?php }?>
		<!-- <div id="Achievements"><p><?php echo $lang->ACHIEVEMENTS?></p>
			<table cellspacing="10" cellpadding="5";>
			<tr><td><?php echo $lang->ACADEMIC?></td></tr>
			<tr><td><?php echo $lang->COCIRCULAR?></td></tr>
			</table>
		</div>  -->
	</div>
</div>
</body>