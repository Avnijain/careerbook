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
require_once '../controller/group_controller.php';
require_once '../classes/dateManipulation.php';

class mainentrance {

	private static $instance;
	private $obj_usrinfo;
	private $objdate;

	private function __construct() {
		$this->obj_usrinfo = new user_info_controller();
		$this->objdate = new dateManipulation();
	}

	public static function getinstance() {
		if (is_null(mainentrance::$instance)) {
			self::$instance = new mainentrance();
		}
		return self::$instance;
	}
	
	public function start() {
		
		session_start ();
		
		if($_REQUEST['action']=="Registration"){
			//print("yes I am here");
			$this->userRegistration();

		}
		if($_REQUEST['action']=="login"){
			//echo "login";
			$this->userLogin();
		}
		if($_REQUEST['action']=="profileinfo"){
			//echo "Filling profile information # ";
			$this->fillUserProfile();
		}
		if($_REQUEST['action']=="add_group"){
			$objGroup = new GroupHandler();
			$objGroup->handleAddGroup();
		}
	}
	
	//function to register a user and validate the feilds
	private function userRegistration(){
		//print("yes I am hereeeeee");
		$this->validationCheck();
		$_POST['date_of_birth'] = $this->objdate->reverseDate($_POST['date_of_birth']);
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
				//echo "here No result from DB";
				die;
				header("location:../index.php?err=AuthenticationFailed");
				die;
			}
			if(md5($_POST['password'])==$result[0]['password'])
			{
				//					$_SESSION['userData']=$result;
				$this->obj_usrinfo->setUserPersonalInfo($result);
				$this->obj_usrinfo->setUserIdInfo($result);
				$this->obj_usrinfo->setUserAddressInfoDb($result);
				$this->obj_usrinfo->setUserAcademicInfoDb($result);
				$this->obj_usrinfo->setUserProfessionalInfoDb($result);
				
				$_SESSION['userData']=serialize($this->obj_usrinfo);
				//	print($obj_usrinfo->getuserinfo('first_name'));
				header("location:../views/userHomePage.php");
				//die;
			}
		}
		else
		{

			header("location:../index.php?err=AuthenticationFailed");
			die;
		}
	}


	private function fillUserProfile(){

		//echo "filling user profile";
		$userProfessionalInfo = array(array("skill_set" => "" ,"current_position" => "","current_company" => "", "start_period" => ""));
		$userAddressInfo = array(array("address"=>"","city_name"=>"","state_name"=>""));
		$userAcademicInfo = array(array("board_10"=>"","school_10"=>"","percentage_GPA_10"=>"","board_12"=>"","school_12"=>"",
				"percentage_12"=>"","graduation_degree"=>"","graduation_specialization"=>"", "graduation_college"=>"",
				"graduation_percentage"=>"", "post_graduation_degree"=>"", "post_graduation_specialization"=>"",
				"post_graduation_college"=>"", "post_graduation_percentage"=>""
		));
			
		//echo "<pre/>";
		$this->obj_usrinfo = unserialize($_SESSION['userData']);
		//print_r($_POST);
		//			foreach($_POST as $key => $value){
		//			print_r(array_keys($userProfessionalInfo[0]));
		    $flagData = false;
			foreach(array_keys($userProfessionalInfo[0]) as $key => $value){
				if(isset($_POST[$value])){
					if(!empty($_POST[$value])){
						$userProfessionalInfo[0][$value] = $_POST[$value];
						$flagData = true;
					}
				}
			}
			if($flagData){
			    $this->obj_usrinfo->setUserProfessionalInfoForm($userProfessionalInfo);
//			    echo "inserting professional";
			}
			
			$flagData = false;
			foreach(array_keys($userAddressInfo[0]) as $key => $value){
				if(isset($_POST[$value])){
					if(!empty($_POST[$value])){
						$userAddressInfo[0][$value] = $_POST[$value];
						$flagData = true;
					}
				}
			}
			if($flagData){
			    echo "Inserting professional data";
			    $this->obj_usrinfo->setUserAddressInfoForm($userAddressInfo);			    
			}
			
			$flagData = false;
			foreach(array_keys($userAcademicInfo[0]) as $key => $value){
				if(isset($_POST[$value])){
					if(!empty($_POST[$value])){
						$userAcademicInfo[0][$value] = $_POST[$value];
						$flagData = true;
					}
				}
			}
			if($flagData){
			    $this->obj_usrinfo->setUserAcademicInfoForm($userAcademicInfo);
//			    echo "inserting Academic";
			}
//			echo "<pre/>";
//			print_r($this->obj_usrinfo->getUserProfessionalInfo());
			//			print_r($userAcademicInfo);
			//			die;
			//			print_r($userAddressInfo);
			//			print_r($userProfessionalInfo);
			// 				if(isset($_POST[$key])){
			// 					if(!empty($_POST[$key])){

				// 					}
				// //				}
				// 			$result = array(array("skill_set" => $_POST['skill_set'],
				// 			    "current_position" => $_POST['current_position'],
				// 			    "current_company" => $_POST['current_company'],
				// 			    "start_period" => $_POST['start_period']));
					
				// 			//print_r($result);
				$_SESSION['userData']=serialize($this->obj_usrinfo);
				header("location:../views/userHomePage.php");
				//die;

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
