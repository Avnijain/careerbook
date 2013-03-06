<?php
/*
	**************************** Creation Log *******************************
	File Name                   -  mainentrance.php
    Project Name                -  Careerbook
    Description                 -  Class file for start
    Version                     -  1.0
    Created by                  -  Prateek Saini
    Created on                  -  March 03, 2013
	***************************** Update Log ********************************
	Sr.NO.		Version		Updated by           Updated on          Description
    -------------------------------------------------------------------------
      1           1.0      Mohit K. Singh        March 03, 2013      writen function for sending mail and validation check 
    *************************************************************************

*/
//namespace controller;

require_once '../Model/model.php';
 require_once '../controller/userpersnlinfo.php';

class mainentrance {
	
	private static $instance;
	
	private function __construct() {
	
	}
	
	public static function getinstance() {
		if (is_null(mainentrance::$instance)) {
				self::$instance = new mainentrance();
		}
		return self::$instance;
	}	
	public function start(){
		//print("yes I am here");
		
		session_start ();
		if($_REQUEST['action']=="Registration"){
			$this->userRegistration();

		}
		if($_REQUEST['action']=="login"){
		$this->userLogin();
	}
	}
	//function to register a user and validate the feilds
	private function userRegistration(){
			validationCheck();
			$ObjModel = new MyClass ();
			$result=$ObjModel->FindUsers();
			if(count($result))
			{
				header("location:../views/registration.php?err=6");
				die;
			}
			
			$ObjModel->AddUser();
			//sendMail();
			header("location:../views/ConfirmRegistration.php");
			die;
	}
	
	//function for User Authentication an login
	private function userLogin(){

			if(isset($_POST['userid']) && isset($_POST['password']))
			{
				if(!filter_var($_POST['userid'], FILTER_SANITIZE_FULL_SPECIAL_CHARS,FILTER_SANITIZE_MAGIC_QUOTES))
				{
					header("location:../index.php?err=AuthenticationFailed");
					die;
				}
				$ObjModel = new MyClass ();
				$result=$ObjModel->FindLoginUsers();

				if(!count($result))
				{
					header("location:../index.php?err=AuthenticationFailed");
					die;
				}
				if(md5($_POST['password'])==$result[0]['password'])
				{
//					$_SESSION['userData']=$result;
					$obj_usrinfo = new user_info_controller();
                        		$obj_usrinfo->setuserinfo($result);
					$_SESSION['userData']=serialize($obj_usrinfo);
//	print($obj_usrinfo->getuserinfo('first_name'));
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
	
	
	
private function validationCheck() {
                
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
private function sendMail() {
	
	$to = $_POST ['email'];
	$subject = "Registration in careerbook";
	$message = "Dear " . $_POST ['firstname'] . $_POST ['middlename'] . $_POST ['lastname'] . ",<br>
		Verification of your email address is pending.
		Your Email Careerbook
		User Name : " . $_POST ['email'] . "
		Password  : 1234
		Kindly login with this user name and password to complete verification of your email.
		http://www.careerbook.com/
	
		Best wishes,
		Team CareerBook ";
	$from = "careerbook.com";
	$headers = "From:" . $from;
	mail ( $to, $subject, $message, $headers );
	echo "Mail Sent.";

}
	
}



$obj = mainentrance::getinstance();
$obj->start();

?>
