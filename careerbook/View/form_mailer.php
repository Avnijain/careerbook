<?php
/*
 **************************** Creation Log *******************************
File Name                   -  form_mailer.php
Project Name                -  Careerbook
Description                 -  file for sending e-mail for contacform to admin 
Version                     -  1.0
Created by                  -  Avni Jain
Created on                  -  March 31, 2013
*/

$emailSubject = 'Careerbook:user message';						//mail subject
$mailto = 'avni.jain@osscube.com';								//email-id of reciever

$nameField = $_POST['name'];
$emailField = $_POST['email'];
$questionField = $_POST['message'];

/* email body containing above information*/

$body = <<<EOD
<br><hr><br>
Name: $nameField <br>
Email: $emailField <br>
Message: $questionField <br>
EOD;

$headers = "From: $emailField\r\n"; 					
$headers .= "Content-type: text/html\r\n"; 
$success = mail($mailto, $emailSubject, $body, $headers); // function to send mail
if($success)									// if true is returned in sucess that is mail is sent
header ( 'location:contactform.php?c=sent' );
else
echo " oopps!!!! look like some problem has occured we'l get back soon"; // if false is returned in sucess that mail is not sent
?>