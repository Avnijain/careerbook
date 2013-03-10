 


<?php

/**
 * @author  Mohit K. Singh
 * @access Public
 */
include_once("../lang/lang.en.php");
 require_once '../Model/model.php';
 require_once '../controller/userpersnlinfo.php';
 
 session_start();
 $obj = new MyClass();
 $obj_usrinfo = new user_info_controller();


 function validationCheck()
 {
                
         if( !count($_POST['phonenumber']) && !ctype_digit( $_POST['phonenumber']) )
		{
			header("location:../views/registration.php?err=1");
			die;
		}

                if(!filter_var($_POST['firstname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS,FILTER_SANITIZE_MAGIC_QUOTES))
		{
			header("location:../views/registration.php?err=2");
			die;
		}
                if(!count($_POST['middlename']) && !filter_var($_POST['middlename'], FILTER_SANITIZE_FULL_SPECIAL_CHARS,FILTER_SANITIZE_MAGIC_QUOTES))
		{
			header("location:../views/registration.php?err=3");
			die;
		}
                if(!count($_POST['lastname']) && !filter_var($_POST['lastname'], FILTER_SANITIZE_FULL_SPECIAL_CHARS,FILTER_SANITIZE_MAGIC_QUOTES))
		{
			header("location:../views/registration.php?err=4");
			die;
		}
                if(!filter_var($_POST['email'], FILTER_SANITIZE_EMAIL))
		{
			header("location:../views/registration.php?err=5");
			die;
		}
    
 }
 
 
 
 function sendMail()
 {
    
    $to = $_POST['email'];
    $subject = MAILSUBJECT;
    /*$message = "Dear ".$_POST['firstname']. $_POST['middlename'] .$_POST['lastname'].",<br>
    MESSAGEBODY
    User Name : ".$_POST['email']."
    Password  : 1234
    Kindly login with this user name and password to complete verification of your email.
    http://www.careerbook.com/

    Best wishes,
    Team CareerBook ";*/
    
    $message=$_POST['firstname'].$_POST['firstname'].$_POST['firstname'].MESSAGEBODY.USERNAME.$_POST['email'].PASSWORD.EMAILMESSAGE;
    	echo $message;
    $from = SITENAME;
    $headers = FROM.$from;
    mail($to,$subject,$message,$headers);
    echo MAILSENT;

 }
 
 

 if($_REQUEST['action']=="Registration"){
                validationCheck();
                $result=$obj->FindUsers();
                if(count($result))
                {
                    header("location:../views/registration.php?err=6");
		    die;
                }
                $obj->AddUser();
                //sendMail();
                header("location:../views/ConfirmRegistration.php");
		die;
 }
 if($_REQUEST['action']=="login"){
                if(isset($_POST['userid']) && isset($_POST['password']))
                {
                     if(!filter_var($_POST['userid'], FILTER_SANITIZE_FULL_SPECIAL_CHARS,FILTER_SANITIZE_MAGIC_QUOTES))
                    {
					header("location:../index.php?err=AuthenticationFailed");
					die;
                    }
                    $result=$obj->FindLoginUsers();
                    if(!count($result))
                    {
                    header("location:../index.php?err=AuthenticationFailed");
		    		die;
                    }
                    if(md5($_POST['password'])==$result[0]['password'])
                    {
//                     	echo "<pre>";
//                     	print_r($result);
//                     	echo "</pre>";                        
//                      $_SESSION['userData']=$result;
                        $obj_usrinfo->setuserinfo($result);
                        $_SESSION['userData']=$obj_usrinfo;
                        //print($obj_usrinfo->getuserinfo('first_name'));
                        header("location:../views/userHomePage.php");
                        die;
                    }
                }
                else
                {
                    header("location:../index.php?err=AuthenticationFailed");
		    die;
                }              
 }
 
 
 

?>
