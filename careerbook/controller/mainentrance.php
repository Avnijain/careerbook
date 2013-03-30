<?php
/*
 * *************************** Creation Log ******************************* 
 * File Name - mainentrance.php Project 
 * Name - Careerbook 
 * Description - Class file for start Version - 1.0 
 * Created by - Prateek Saini 
 * Created on - March 03, 2013 
 * **************************** Update Log ******************************** 
 * Sr.NO.		Version		Updated by Updated on Description
 *  ------------------------------------------------------------------------- 
 *  1 1.0 Mohit K. Singh March 03, 2013 writen function for sending mail and validation check 
 *  ************************************************************************
 */
ini_set ( "display_errors", "1" );

// namespace controller;

require_once '../Model/model.php';
require_once '../Model/validation.php';
require_once '../controller/userInfo.php';
require_once '../controller/group_controller.php';
require_once '../classes/dateManipulation.php';
require_once '../controller/message_controller.php';
require_once '../controller/user_discussion_controller.php';
class mainentrance {
	private static $instance;
	private $obj_usrinfo;
	private $objdate;
	private $_obj_group_controller;
	private $_obj_user_discussion_controller;
	private function __construct() {
		$this->obj_usrinfo = new user_info_controller ();
		$this->objdate = new dateManipulation ();
		

	}
	public static function getinstance() {
		if (is_null ( mainentrance::$instance )) {
			self::$instance = new mainentrance ();
		}
		return self::$instance;
	}
	//*********************************************accept a friends request*******************************************
	private function acceptFrnd() {
		$ObjModel = new MyClass ();
		$this->obj_usrinfo = unserialize ( $_SESSION ['userData'] );
		$ObjModel->acceptNewFrnd ( $this->obj_usrinfo, $_POST ['id'] );
	}
	//******************************************************add a new friend*******************************************
	private function addFrnd() {
		$ObjModel = new MyClass ();
		$this->obj_usrinfo = unserialize ( $_SESSION ['userData'] );
		$ObjModel->addNewFrnd ( $this->obj_usrinfo, $_POST ['id'] );
	}
	//******************************************************delete a friend*****************************************
	private function delFrnd() {
		$ObjModel = new MyClass ();
		$this->obj_usrinfo = unserialize ( $_SESSION ['userData'] );
		$ObjModel->delMyFrnd ( $this->obj_usrinfo, $_POST ['id'] );
	}
	//*************************************************change a users password*************************************
	private function chngPwd()
	{
		
		if($_POST['currPwd'] !=" " && $_POST['newPwd'] !="" && $_POST['confirmPwd'] !="")
		{
			if($_POST['newPwd'] == $_POST['confirmPwd'])
			{
				$ObjModel = new MyClass ();
				$this->obj_usrinfo = unserialize ( $_SESSION ['userData'] );
				$result = $ObjModel->getUserPwd ($this->obj_usrinfo);
				if(md5 ( $_POST ['currPwd'] ) == $result [0] ['password'])
				{
					if(strlen($_POST['newPwd']) < 8 || strlen($_POST['newPwd']) > 15)
					{
						header ( 'location: ../views/userHomePage.php?Settings&err=4');
						
					}
					elseif($_POST['newPwd']==$_POST['currPwd'])
					{
						header ( 'location: ../views/userHomePage.php?Settings&err=5');
					}
					else
					{
						$ObjModel->passwdChg ($this->obj_usrinfo,$_POST['newPwd']);
						header ( 'location: ../views/userHomePage.php?Settings&Success');
					}
				}
				else 
				{
					header ( 'location: ../views/userHomePage.php?Settings&err=3');
				}
			}
			else {
				header ( 'location: ../views/userHomePage.php?Settings&err=2' );
			}
		}
		else {
			header ( 'location: ../views/userHomePage.php?Settings&err=1' );
		}
	}
	//*****************************************delete an account********************************************************
	private function delUser()
	{
		$ObjModel = new MyClass ();
		$this->obj_usrinfo = unserialize ( $_SESSION ['userData'] );
		$ObjModel->DeleteUser($this->obj_usrinfo);
		session_destroy();
	} 
	
	public function start() {
		
		session_start ();
		
		if ($_REQUEST ['action'] == "delUser") {
				
			$this->delUser ();
		}
		if ($_REQUEST ['action'] == "acceptFrnd") {
			
			$this->acceptFrnd ();
		}
		if ($_REQUEST ['action'] == "chngPwd") {
			$this->chngPwd ();
		}
		if ($_REQUEST ['action'] == "addFrnd") {
			
			$this->addFrnd ();
		}
		if ($_REQUEST ['action'] == "delFrnd") {
			
			$this->delFrnd ();
		}
		if ($_REQUEST ['action'] == "Registration") {
			// print("yes I am here");
			$this->userRegistration ();
		}
		if ($_REQUEST ['action'] == "login") {
			// echo "login";
			$this->userLogin ();
		}
		if ($_REQUEST ['action'] == "profileinfo") {
			// echo "Filling profile information # ";
			$this->fillUserProfile ();
		}
		if ($_REQUEST ['action'] == "add_group") {
			$this->_obj_group_controller = new GroupHandler ();
			$this->_obj_group_controller->handleAddGroup ();
		}
		if ($_REQUEST ['action'] == "send_message") {
			$objMessage = new MessageController ();
			$objMessage->handleSendMessage ();
			header ( 'location: ../views/userHomePage.php?message&c=sent' );
			// header('message1.php?c=sent');
		}
		if ($_REQUEST ['action'] == "get_message") {
			$objMessage1 = new MessageController ();
			$_SESSION ['myinbox'] = $objMessage1->handleRecieveMessage ();
			rsort ( $_SESSION ['myinbox'] );
			print_r ( $_SESSION ['myinbox'] );
			// header('location: ../views/userHomePage.php?message');
		}
		if ($_REQUEST ['action'] == "message_sent") {
			
			$objMessage2 = new MessageController ();
			// session_start();
			$_SESSION ['outbox'] = $objMessage2->handleSentMessage ();
			// print_r($_SESSION['outbox']);
			rsort ( $_SESSION ['outbox'] );
			header ( 'location: ../views/userHomePage.php?message' );
		}
		if ($_REQUEST ['action'] == "get_friend") {
			
			$objMessage2 = new MessageController ();
			// session_start();
			$_SESSION ['emailid'] = $objMessage2->handleGetFriend ();
			// print_r($_SESSION['outbox']);
		}
		if ($_REQUEST ['action'] == "Group") {
			$this->_obj_group_controller = new GroupHandler ();
			$this->_obj_group_controller->handleGetGroup ();
		}
		if ($_REQUEST ['action'] == "getPost") {
			$this->_obj_group_controller = new GroupHandler ();
			$this->_obj_group_controller->handleGetPost ();
		}
		if ($_REQUEST ['action'] == "addPost") {
			$this->_obj_group_controller = new GroupHandler ();
			$this->_obj_group_controller->handleAddPost ();
		}
		if ($_REQUEST ['action'] == "addComment") {
			$this->_obj_group_controller = new GroupHandler ();
			$this->_obj_group_controller->handleAddComment ();
		}
		if ($_REQUEST ['action'] == "getComment") {
			$this->_obj_group_controller = new GroupHandler ();
			$this->_obj_group_controller->handleGetComment ();
		}
		if ($_REQUEST ['action'] == "joinGroup") {
			$this->_obj_group_controller = new GroupHandler ();
			$this->_obj_group_controller->handleJoinGroup ();
		}
		if ($_REQUEST ['action'] == "unjoinGroup") {
			$this->_obj_group_controller = new GroupHandler ();
			$this->_obj_group_controller->handleUnjoinGroup ();
		}
		if ($_REQUEST ['action'] == "searchGroup") {
			$this->_obj_group_controller = new GroupHandler ();
			$this->_obj_group_controller->handleSearchGroup ();
		}
		if ($_REQUEST ['action'] == "addUserPost") {
			$this->_obj_user_discussion_controller = new UserDiscussionController ();
			$this->_obj_user_discussion_controller->handleAddUserPost ();
		}
	}
	
	// function to register a user and validate the feilds
	private function userRegistration() {
		// print("yes I am hereeeeee");
		$this->validationCheck ();
		$_POST ['date_of_birth'] = $this->objdate->reverseDate ( $_POST ['date_of_birth'] );
		$ObjModel = new MyClass ();
		$result = $ObjModel->FindUsers ();
		if (count ( $result )) {
			header ( "location:../views/NewRegistration.php?err=6" );
			die ();
		}
		
		$ObjModel->AddUser ();
		// sendMail();
		header ( "location:../views/ConfirmRegistration.php" );
		die ();
	}
	
	// function for User Authentication an login
	private function userLogin() {
		if (isset ( $_POST ['userid'] ) && isset ( $_POST ['password'] )) {
			
			if (! filter_var ( $_POST ['userid'], FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_SANITIZE_MAGIC_QUOTES )) {
				
				header ( "location:../index.php?err=AuthenticationFailed" );
				die ();
			}
			$ObjModel = new MyClass ();
			$result = $ObjModel->FindLoginUsers ();
			
			if (! count ( $result )) {
				// echo "here No result from DB";
				// die;
				header ( "location:../index.php?err=AuthenticationFailed" );
				die ();
			}
			if (md5 ( $_POST ['password'] ) == $result [0] ['password']) {
				// $_SESSION['userData']=$result;
				$this->obj_usrinfo->setUserPersonalInfo ( $result );
				$this->obj_usrinfo->setUserIdInfo ( $result );
				$this->obj_usrinfo->setUserAddressInfoDb ( $result );
				$this->obj_usrinfo->setUserAcademicInfoDb ( $result );
				$this->obj_usrinfo->setUserProfessionalInfoDb ( $result );
				
				$_SESSION ['userData'] = serialize ( $this->obj_usrinfo );
				
				// print($obj_usrinfo->getuserinfo('first_name'));
				header ( "location:../views/userHomePage.php" );
				// die;
			}
		} else {
			
			header ( "location:../index.php?err=AuthenticationFailed" );
			die ();
		}
	}
	private function fillUserProfile() {
		// echo "<pre/>";
		// print_r($_POST);
		// die;
		
		// echo "filling user profile";
		$userProfessionalInfo = array (
				array (
						"skill_set" => "",
						"current_position" => "",
						"current_company" => "",
						"start_period" => "" 
				) 
		);
		$userPreviousJobInfo = array (
				array (
						"position" => "",
						"company" => "",
						"start_period" => "",
						"end_period" => "" 
				) 
		);
		
		$userAddressInfo = array (
				array (
						"address" => "",
						"city_name" => "",
						"state_name" => "" 
				) 
		);
		
		$userAcademicInfo = array (
				array (
						"board_10" => "",
						"school_10" => "",
						"percentage_GPA_10" => "",
						"board_12" => "",
						"school_12" => "",
						"percentage_12" => "",
						"graduation_degree" => "",
						"graduation_specialization" => "",
						"graduation_college" => "",
						"graduation_percentage" => "",
						"post_graduation_degree" => "",
						"post_graduation_specialization" => "",
						"post_graduation_college" => "",
						"post_graduation_percentage" => "" 
				) 
		);
		
		$userPersonalInfo = array (
				array (
						"first_name" => "",
						"middle_name" => "",
						"last_name" => "",
						"date_of_birth" => "",
						"email_primary" => "",
						"email_secondary" => "",
						"phone_no" => "",
						"gender" => "" 
				) 
		);
		
		$userImageInfo = array (
				array (
						"user_image" => "" 
				) 
		);
		
		$userProjectInfo = array (
				array (
						"title" => "",
						"project_description" => "",
						"technology_used" => "",
						"duration" => "" 
				) 
		);
		
		// echo "<pre/>";
		$this->obj_usrinfo = unserialize ( $_SESSION ['userData'] );
		// print_r($_POST);
		// foreach($_POST as $key => $value){
		// print_r(array_keys($userProfessionalInfo[0]));
		
		/**
		 * ************************** User Professional Information ***********************
		 */
		$flagData = false;
		if (isset ( $_POST ['start_periodPREVJOB'] ) || isset ( $_POST ['end_periodPREVJOB'] )) {
			if (! empty ( $_POST ['start_periodPREVJOB'] ) || ! empty ( $_POST ['end_periodPREVJOB'] )) {
				$userPreviousJobInfo [0] ['start_period'] = $this->objdate->reverseDate ( $_POST ['start_periodPREVJOB'] );
				$userPreviousJobInfo [0] ['end_period'] = $this->objdate->reverseDate ( $_POST ['end_periodPREVJOB'] );
			}
		}
		foreach ( array_keys ( $userPreviousJobInfo [0] ) as $key => $value ) {
			if ("$value" != "start_period" && "$value" != "end_period") {
				if (isset ( $_POST [$value] )) {
					if (! empty ( $_POST [$value] )) {
						$userPreviousJobInfo [0] [$value] = $_POST [$value];
						$flagData = true;
					}
				}
			}
		}
		// echo "<pre/>";
		// print_r($userPreviousJobInfo);
		// die;
		if ($flagData) {
			$this->obj_usrinfo->setUserPreviousJobInfoForm ( $userPreviousJobInfo );
			// echo "inserting professional";
		}
		/**
		 * ************************** User Previous Job Info ***********************
		 */
		$flagData = false;
		if (isset ( $_POST ['start_period'] )) {
			if (! empty ( $_POST ['start_period'] )) {
				$_POST ['start_period'] = $this->objdate->reverseDate ( $_POST ['start_period'] );
			}
		}
		foreach ( array_keys ( $userProfessionalInfo [0] ) as $key => $value ) {
			if (isset ( $_POST [$value] )) {
				if (! empty ( $_POST [$value] )) {
					$userProfessionalInfo [0] [$value] = $_POST [$value];
					$flagData = true;
				}
			}
		}
		if ($flagData) {
			$this->obj_usrinfo->setUserProfessionalInfoForm ( $userProfessionalInfo );
			// echo "inserting professional";
		}
		/**
		 * ************************** User Profile Image ***********************
		 */
		$flagData = false;
		foreach ( array_keys ( $userImageInfo [0] ) as $key => $value ) {
			if ($_FILES [$value] ["error"] != "4") {
				if (isset ( $_FILES [$value] )) {
					if (! empty ( $_FILES [$value] )) {
						$userImageInfo [0] [$value] = $_FILES [$value];
						$flagData = true;
					}
				}
			}
		}
		if ($flagData) {
			$this->obj_usrinfo->setUserImageInfoForm ( $userImageInfo );
			// echo "inserting professional";
		}
		/**
		 * ************************** User Project Information ***********************
		 */
		$flagData = false;
		foreach ( array_keys ( $userProjectInfo [0] ) as $key => $value ) {
			if (isset ( $_POST [$value] )) {
				if (! empty ( $_POST [$value] )) {
					foreach ( $_POST [$value] as $inkey => $invalue ) {
						if (! empty ( $invalue )) {
							$userProjectInfo [0] [$value] = $_POST [$value];
							$flagData = true;
						}
					}
				}
			}
		}
		// echo "<pre/>";
		// print_r($userProjectInfo);
		// die;
		if ($flagData) {
			$this->obj_usrinfo->setUserProjectInfoForm ( $userProjectInfo );
			// echo "inserting professional";
		}
		/**
		 * ************************** User Personal Information ***********************
		 */
		$flagData = false;
		if (isset ( $_POST ['date_of_birth'] )) {
			if (! empty ( $_POST ['date_of_birth'] )) {
				$_POST ['date_of_birth'] = $this->objdate->reverseDate ( $_POST ['date_of_birth'] );
			}
		}
		foreach ( array_keys ( $userPersonalInfo [0] ) as $key => $value ) {
			if (isset ( $_POST [$value] )) {
				if (! empty ( $_POST [$value] )) {
					$userPersonalInfo [0] [$value] = $_POST [$value];
					$flagData = true;
				}
			}
		}
		if ($flagData) {
			$this->obj_usrinfo->setUserPersonalInfoForm ( $userPersonalInfo );
			// die;
			// echo "inserting professional";
		}
		/**
		 * ************************** User Address Information ***********************
		 */
		$flagData = false;
		foreach ( array_keys ( $userAddressInfo [0] ) as $key => $value ) {
			if (isset ( $_POST [$value] )) {
				if (! empty ( $_POST [$value] )) {
					$userAddressInfo [0] [$value] = $_POST [$value];
					$flagData = true;
				}
			}
		}
		if ($flagData) {
			// echo "Inserting professional data";
			$this->obj_usrinfo->setUserAddressInfoForm ( $userAddressInfo );
		}
		/**
		 * ************************** User Academic Information ***********************
		 */
		$flagData = false;
		foreach ( array_keys ( $userAcademicInfo [0] ) as $key => $value ) {
			if (isset ( $_POST [$value] )) {
				if (! empty ( $_POST [$value] )) {
					$userAcademicInfo [0] [$value] = $_POST [$value];
					$flagData = true;
				}
			}
		}
		if ($flagData) {
			$this->obj_usrinfo->setUserAcademicInfoForm ( $userAcademicInfo );
			// echo "inserting Academic";
		}
		// echo "<pre/>";
		// print_r($this->obj_usrinfo->getUserProfessionalInfo());
		// print_r($userAcademicInfo);
		// die;
		// print_r($userAddressInfo);
		// print_r($userProfessionalInfo);
		// if(isset($_POST[$key])){
		// if(!empty($_POST[$key])){
		
		// }
		// // }
		// $result = array(array("skill_set" => $_POST['skill_set'],
		// "current_position" => $_POST['current_position'],
		// "current_company" => $_POST['current_company'],
		// "start_period" => $_POST['start_period']));
		
		// //print_r($result);
		$_SESSION ['userData'] = serialize ( $this->obj_usrinfo );
		header ( "location:../views/userHomePage.php" );
		// die;
	}
	private function validationCheck() {
		echo "validation funnnn";
		$validdob = new validation ();
		$validdob->validate ( $_POST );
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

$obj = mainentrance::getinstance ();
$obj->start ();

?>
