
<?php
/*
 **************************** Creation Log *******************************
File Name                   -  contactform.php
Project Name                -  Careerbook
Description                 -  file for sending suggestion/feedback 
Version                     -  1.0
Created by                  -  Avni Jain
Created on                  -  March 31, 2013
*/
include_once("../classes/lang.php");
require_once '../controller/userInfo.php';
require_once '../controller/profile_controller.php';
require_once '../controller/userInfo.php';
if(isset($_SESSION['userData']))   					//to get current user login information
{
	$ob1 = new user_info_controller();
	$ob1 = unserialize($_SESSION['userData']);
	$userid = $ob1->getUserIdInfo();
	$id = $userid['id'];
}
$obj->setId($id);	
$UserPersonalInfoDB = $objUserInfo->getUserPersonalInfo();
$personalInfo=$obj->handlePersonalInfo();
if(isset($_REQUEST['c']))         					//to get the response from form_mailer 
	echo $lang->MAILMESSAGE;
?>

<link rel="stylesheet" href="../css/contactform.css" />

	<div id="wrap">
		<h1><?php $lang->CONTACTUS?></h1>
		<div id='form_wrap'>
			<form id = "contact_form" name="form1" method="post" action="form_mailer.php">
				<p><?php echo $personalInfo['0']['first_name']; echo $lang->SENDSUGGESTION;?></p>
				<label for="email"><?php $lang->YOURMESSAGE?></label>
				<textarea  name="message" value="Your Message" id="message" maxlength="150" ></textarea>
				<p></p>	
				<label for="name" ><?php $lang->NAME?></label>
				<input type="text" name="name" disabled="true" value="<?php echo $personalInfo['0']['first_name']?>" id="name" />
				<label for="email" ><?php $lang->EMAIL?></label>
				<input type="text" name="email" disabled="true" value="<?php echo $personalInfo['0']['email_primary'];?>" id="email" />
				<input type="submit" name ="submit" value="<?php echo $lang->CLICKTOSEND?>" />
			</form>
		</div>
	</div>