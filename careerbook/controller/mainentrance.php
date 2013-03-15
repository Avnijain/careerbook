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

ini_set("display_errors", "1");

//namespace controller;

require_once '../Model/model.php';
require_once '../Model/validation.php';
 require_once '../controller/userInfo.php';

class mainentrance {
	
	private static $instance;
	private $obj_usrinfo;
	
	private function __construct() {
	    $this->obj_usrinfo = new user_info_controller();
	     
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
			print("yes I am here");
			$this->userRegistration();

		}
		if($_REQUEST['action']=="login"){
			echo "login";
			$this->userLogin();			
	}
	if($_REQUEST['action']=="profileinfo"){
		echo "Filling profile information # ";
		$this->fillUserProfile();
	}	
	}
	//function to register a user and validate the feilds
	private function userRegistration(){
		print("yes I am hereeeeee");
			$this->validationCheck();
			$ObjModel = new MyClass ();
			$result=$ObjModel->FindUsers();
			if(count($result))
			{
				header("location:../views/NewRegistration.php?err=6");
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
					echo "here";
					die;
					header("location:../index.php?err=AuthenticationFailed");
					die;
				}
				if(md5($_POST['password'])==$result[0]['password'])
				{
//					$_SESSION['userData']=$result;
                        		$this->obj_usrinfo->setUserPersonalInfo($result);
					$_SESSION['userData']=serialize($this->obj_usrinfo);
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
	

		private function fillUserProfile(){
		
			echo "filling user profile";
			echo "<pre/>";
			print_r($_POST);
			$result = array("skill" => $_POST['skill'],
			    "currentposition" => $_POST['currentposition'],
			    "currentcompany" => $_POST['currentcompany'],
			    "startperiod" => $_POST['startperiod']);
			
			print_r($result);
			$this->obj_usrinfo->setUserProfessionalInfo($result);
			die;
		
		}
			
private function validationCheck() {
	echo "validation funnnn";
	$validdob= new validation();
	$validdob->validate($_POST);


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
