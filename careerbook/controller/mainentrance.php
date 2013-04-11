<?php
/*
 * *************************** Creation Log ******************************* File
 * Name - mainentrance.php Project Name - Careerbook Description - Class file
 * for start Version - 1.0 Created by - Prateek Saini Created on - March 03,
 * 2013 **************************** Update Log ********************************
 * Sr.NO.		Version		Updated by Updated on Description
 * ------------------------------------------------------------------------- 1
 * 1.0 Mohit K. Singh March 03, 2013 writen function for sending mail and
 * validation check
 * ************************************************************************
 */
ini_set ( "display_errorlogins", "1" );

// namespace controller;

require_once '../Model/model.php';
require_once '../Model/validation.php';
require_once '../controller/userInfo.php';
require_once "../classes/class.phpmailer.php";
require_once "../classes/class.smtp.php";
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
	// *********************************************accept a friends
	// request*******************************************
	private function acceptFrnd() {
		$ObjModel = new MyClass ();
		$this->obj_usrinfo = unserialize ( $_SESSION ['userData'] );
		$ObjModel->acceptNewFrnd ( $this->obj_usrinfo, $_POST ['id'] );
	}
	// ******************************************************add a new
	// friend*******************************************
	private function addFrnd() {
		$ObjModel = new MyClass ();
		$this->obj_usrinfo = unserialize ( $_SESSION ['userData'] );
		$ObjModel->addNewFrnd ( $this->obj_usrinfo, $_POST ['id'] );
	}
	// ******************************************************delete a
	// friend*****************************************
	private function delFrnd() {
		$ObjModel = new MyClass ();
		$this->obj_usrinfo = unserialize ( $_SESSION ['userData'] );
		$ObjModel->delMyFrnd ( $this->obj_usrinfo, $_POST ['id'] );
	}
	// *************************************************change a users
	// password*************************************
	private function chngPwd() {
		if ($_POST ['currPwd'] != " " && $_POST ['newPwd'] != "" && $_POST ['confirmPwd'] != "") {
			if ($_POST ['newPwd'] == $_POST ['confirmPwd']) {
				$ObjModel = new MyClass ();
				$this->obj_usrinfo = unserialize ( $_SESSION ['userData'] );
				$result = $ObjModel->getUserPwd ( $this->obj_usrinfo );
				if (md5 ( $_POST ['currPwd'] ) == $result [0] ['password']) {
					if (strlen ( $_POST ['newPwd'] ) < 8 || strlen ( $_POST ['newPwd'] ) > 15) {
						header ( 'location: ../Home/userHomePage.php?Settings&err=4' );
					
					} elseif ($_POST ['newPwd'] == $_POST ['currPwd']) {
						header ( 'location: ../Home/userHomePage.php?Settings&err=5' );
					} else {
						$ObjModel->passwdChg ( $this->obj_usrinfo, $_POST ['newPwd'] );
						header ( 'location: ../Home/userHomePage.php?Settings&Success' );
					}
				} else {
					header ( 'location: ../Home/userHomePage.php?Settings&err=3' );
				}
			} else {
				header ( 'location: ../Home/userHomePage.php?Settings&err=2' );
			}
		} else {
			header ( 'location: ../Home/userHomePage.php?Settings&err=1' );
		}
	}
	// *****************************************delete an
	// account********************************************************
	private function delUser() {
		$ObjModel = new MyClass ();
		$this->obj_usrinfo = unserialize ( $_SESSION ['userData'] );
		$ObjModel->DeleteUser ( $this->obj_usrinfo );
		session_destroy ();
		header ( "location:../index.php" );
	}
	// ***************************************************sent a forget password
	// link*******************************************
	private function forgetPasswd() {
		
		if ($_SESSION ['secure'] != $_POST ['captcha-code']) {
			header ( 'location: ../View/forgetPasswd.php?err=1' );
		} else {	
			$ObjModel = new MyClass ();
			$result = $ObjModel->FindLoginUsers ();
			
			if (! count ( $result )) {
				header ( 'location: ../View/forgetPasswd.php?err=2' );
			} else {
				
				/*
				 * sent link here
				 */
				
				 $str= date('ymd')+1;
				 $time=strtotime($str);
				$hash=md5($time."ImSoRrYHaCkEr".$result[0]['id']);
				
				$link=$_SERVER["DOCUMENT_ROOT"]."/careerbook/link/changePwd?id=".$result[0]['id']."&time=".$time."&hash=".$hash;
				
				/*
				 * ***********************************mail here*******************************************************
				 */
				$mail = new PHPMailer();
				$mail->IsSMTP();
				$mail->SMTPAuth = true;
				$mail->Host = "ssl://smtp.gmail.com";
				$mail->Port = 465;
				$mail->Username = "careerbook2013@gmail.com";
				$mail->Password = "2013careerbook*";
				$mail->SMTPDebug = 1;
				$webmaster_email = "careerbook2013@gmail.com";
				
				
				$email="avni.jain@osscube.com";
				$name="Avni";
				/*$emailField=$result[0]['email_primary'];
				$name=$result[0]['first_name'];*/
				
				
				$mail->From = $webmaster_email;
				$mail->FromName = "CareerBook";
				$mail->AddAddress($email,$name);
				$mail->AddReplyTo($webmaster_email,"Webmaster");
				$mail->WordWrap = 50; // set word wrap
				$mail->IsHTML(true); // send as HTML
				$mail->Subject = 'CareerBook:Forget Password help';
				$mail->Body="<br>Dear User,The requested link for your changed password is given below:<br>".
						"link:".$link."<br>";
				$mail->AltBody = "This is the body when user views in plain text format"; //Text Bod
				
				if($mail->Send()) {
					echo $lang->MAILSENT;
				} else {
					echo  $mail->ErrorInfo;
				}
				//**********************************************************************************************				
				header ( 'location: ../View/forgetPasswd.php?code' );
			}
		}
	
	}
	// ******************************************************change user forget
	//********************************************************* password********
	private function forgetChngPwd() {
		if ($_POST ['userId'] != " " && $_POST ['newPwd'] != "" && $_POST ['confirmPwd'] != "") {
			if ($_POST ['newPwd'] == $_POST ['confirmPwd']) {
				$ObjModel = new MyClass ();
				$ObjModel->frogetUserPasswdChg ( $_POST ['userId'], $_POST ['newPwd'] );
				header ( 'location: ../index.php' );
			} else {
				header ( 'location: ../Home/error.php' );
			}
		} else {
			header ( 'location: ../Home/error.php' );
		}
	}
	
	public function start() {
		session_start ();		
		if ($_REQUEST ['action'] == "forgetChngPwd") {
			
			$this->forgetChngPwd ();
		}
		if ($_REQUEST ['action'] == "forgetPasswd") {
			
			$this->forgetPasswd ();
		}
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

			$this->userRegistration ();
		}
		if ($_REQUEST ['action'] == "login") {

			$this->userLogin ();
		}
		if($_REQUEST ['action'] == "getComments")
		{
		    //    	    $result = $this->getMyFriendsDis();		    
		    return $this->getComments();
		}
		if($_REQUEST ['action'] == "deleteDiscussionPost")
		{
		    //    	    $result = $this->getMyFriendsDis();
		    $this->deleteDiscussionPost();
		}
		if($_REQUEST ['action'] == "deleteCommentPost")
		{
		    //    	    $result = $this->getMyFriendsDis();
		    $this->deleteCommentPost();
		}		
		if($_REQUEST ['action'] == "postComment"){
		    $this->postComments();
		}
		if ($_REQUEST ['action'] == "profileinfo") {

			$this->fillUserProfile ();
		}
		if ($_REQUEST ['action'] == "deleteMessage") {
			$this->deleteUserProject ();
		}
		if ($_REQUEST ['action'] == "deleteCertificate") {
			$this->deleteUserCertificate ();
		}		
		if ($_REQUEST ['action'] == "deleteExtraCurricular") {
			$this->deleteUserExtraCurricular ();
		}
		if ($_REQUEST ['action'] == "edit_group") {
			$this->_obj_group_controller = new GroupHandler ();
			$this->_obj_group_controller->handleEditGroup ();
		}
		if ($_REQUEST ['action'] == "send_message") {
			$objMessage = new MessageController ();
			$objMessage->handleSendMessage ();
			header ( 'location: ../Home/userHomePage.php?message&c=sent' );

		}
		if ($_REQUEST ['action'] == "get_message") {
			$objMessage1 = new MessageController ();
			$_SESSION ['myinbox'] = $objMessage1->handleRecieveMessage ();
			rsort ( $_SESSION ['myinbox'] );
		}
		if ($_REQUEST ['action'] == "message_sent") {
			
			$objMessage2 = new MessageController ();

			$_SESSION ['outbox'] = $objMessage2->handleSentMessage ();

			rsort ( $_SESSION ['outbox'] );

		}
		if ($_REQUEST ['action'] == "get_friend") {
			
			$objMessage2 = new MessageController ();

			$_SESSION ['emailid'] = $objMessage2->handleGetFriend ();

		}
		if ($_REQUEST ['action'] == "Group") {
			$this->_obj_group_controller = new GroupHandler ();
			$this->_obj_group_controller->handleGetGroup ();
		}
		if ($_REQUEST ['action'] == "add_group") {
			$this->_obj_group_controller = new GroupHandler ();
			$this->_obj_group_controller->handleAddGroup ();
		}
		if ($_REQUEST ['action'] == "process_edit_group") {
			$this->_obj_group_controller = new GroupHandler ();
			$this->_obj_group_controller->handleProcessEditGroup ();
		}
		if ($_REQUEST ['action'] == "process_edit_post") {
			$this->_obj_group_controller = new GroupHandler ();
			$this->_obj_group_controller->handleProcessEditPost ();
		}
		if ($_REQUEST ['action'] == "edit_group") {
			$this->_obj_group_controller = new GroupHandler ();
			$this->_obj_group_controller->handleEditGroup();
		}
		if ($_REQUEST ['action'] == "edit_post") {
			$this->_obj_group_controller = new GroupHandler ();
			$this->_obj_group_controller->handleEditPost();
		}
		if ($_REQUEST ['action'] == "delete_group") {
			$this->_obj_group_controller = new GroupHandler ();
			$this->_obj_group_controller->handleDeleteGroup();
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
		if ($_REQUEST ['action'] == "delete_comment") {
			$this->_obj_group_controller = new GroupHandler ();
			$this->_obj_group_controller->handleDeleteComment ();
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
	/************* Get Comments of particular discussion *****************/
	private function getComments(){
	    $this->obj_usrinfo=unserialize($_SESSION['userData']);
	    $this->_obj_user_discussion_controller = new UserDiscussionController ();	    
	    $_SESSION['displayComments'] = $this->_obj_user_discussion_controller->getComments($this->obj_usrinfo,$_POST['discussionComment']);
	    $_SESSION ['userData'] = serialize ( $this->obj_usrinfo );
	}
	/************* Delete particular discussion *****************/
	private function deleteDiscussionPost(){
	    $this->obj_usrinfo=unserialize($_SESSION['userData']);
	    $this->_obj_user_discussion_controller = new UserDiscussionController ();
	    $this->_obj_user_discussion_controller->deleteDiscussionPost($this->obj_usrinfo,$_POST['discussionComment']);
	    $_SESSION ['userData'] = serialize ( $this->obj_usrinfo );	    	    
	}	
	/************* Delete particular comment on discussion *****************/
	private function deleteCommentPost(){
	    $this->obj_usrinfo=unserialize($_SESSION['userData']);
	    $this->_obj_user_discussion_controller = new UserDiscussionController ();
	    $this->_obj_user_discussion_controller->deleteCommentPost($this->obj_usrinfo,$_POST['discussionComment']);
	    $_SESSION['displayComments'] = $this->_obj_user_discussion_controller->getComments($this->obj_usrinfo,$_POST['discussionComment']);
	    $_SESSION ['userData'] = serialize ( $this->obj_usrinfo );	    
	}
	/************* Delete User Project *****************/	
	private function deleteUserProject (){
	    $this->obj_usrinfo = unserialize($_SESSION['userData']);
	    echo $this->obj_usrinfo->deleteUserProject($_POST['projectID']);
	    $_SESSION ['userData'] = serialize ( $this->obj_usrinfo );
	}
	/************* Delete User Extra Curricular *****************/	
	private function deleteUserExtraCurricular (){
	    $this->obj_usrinfo = unserialize($_SESSION['userData']);
	    echo $this->obj_usrinfo->deleteUserExtraCurricular($_POST['ExtraCurricularID']);
	    $_SESSION ['userData'] = serialize ( $this->obj_usrinfo );
	}	
	/************* Delete particular certificate *****************/
	private function deleteUserCertificate (){
	    $this->obj_usrinfo = unserialize($_SESSION['userData']);
	    $this->obj_usrinfo->deleteUserCertificate($_POST['certificateID']);
	    $_SESSION ['userData'] = serialize ( $this->obj_usrinfo );
	}
	/************* Post Comment for particular discussion *****************/
	private function postComments(){
	    $this->obj_usrinfo = unserialize ( $_SESSION ['userData'] );	    
	    $this->_obj_user_discussion_controller = new UserDiscussionController ();
	    $_SESSION['displayComments'] = $this->_obj_user_discussion_controller->postComments(
	        $this->obj_usrinfo,
	        $_POST['discussionID'],
	        $_POST['comment']
	        );
        $_SESSION ['userData'] = serialize ( $this->obj_usrinfo );	        
	}	
	// function to register a user and validate the feilds
	private function userRegistration() {
	    
	    $_SESSION['registration'] = $_POST;
	    
		if($_POST['email_primary']=="" ||
				$_POST['first_name']=="" ||
				$_POST['last_name']=="" ||
				$_POST['date_of_birth']==""  )
		{
			header ( "location:../View/NewRegistration.php?err=9" );
			die ();
		}
		if ($_POST ['captcha-code'] != $_SESSION ['secure']) {
			$_SESSION['registration'] = $_POST;
			header ( "location:../View/NewRegistration.php?err=7" );
			die ();
		}
		
		$error=$this->validationCheck ();
		if($error !=0)
		{
			$_SESSION['registration'] = $_POST;
			header ( "location:../View/NewRegistration.php?err=".$error);
			die ();
		}
		$ObjModel = new MyClass ();
		$result = $ObjModel->FindUsers ();
		if (count ( $result )) {
			$_SESSION['registration'] = $_POST;
			header ( "location:../View/NewRegistration.php?err=6" );
			die ();
		}
		
		$ObjModel->AddUser ();
		$_SESSION['registration'] = '';
		unset($_SESSION['registration']);
		$this->mailToUser();
		header ( "location:../View/ConfirmRegistration.php" );
		die ();
	}
	
	// function for User Authentication an login
	private function userLogin() {
		if (isset ( $_POST ['userid'] ) && isset ( $_POST ['password'] )) {
			
			if (! filter_var ( $_POST ['userid'], FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_SANITIZE_MAGIC_QUOTES )) {
				
				header ( "location:../index.php?err=AuthenticationFailed" );

			}
			$ObjModel = new MyClass ();
			$result = $ObjModel->FindLoginUsers ();

			if (count ( $result ) == 0) {
				header ( "location:../index.php?err=AuthenticationFailed" );
				die ();
			}
			if (md5 ( $_POST ['password'] ) == $result [0] ['password'])
			 {				
				if ($result [0] ['status'] == 'I') {
					$ObjModel->UpadteUserSattus ( $result [0] ['id'] ); // user login
					                                               // first time
				}				
				$this->obj_usrinfo->setUserPersonalInfo ( $result );
				$this->obj_usrinfo->setUserIdInfo ( $result );
				$this->obj_usrinfo->setUserActivity();
				$this->obj_usrinfo->setUserAddressInfoDb ();
				$this->obj_usrinfo->setUserAcademicInfoDb ();
				$this->obj_usrinfo->setUserProfessionalInfoDb ();				
				
				$_SESSION ['userData'] = serialize ( $this->obj_usrinfo );
				//*************************************************************************************************
				$_SESSION['secureSessionHijack'] = rand(100000,999999);
				$SID=$_COOKIE['PHPSESSID'];
				//********************************************************************************
				$fileName="../temp/".$result[0]['email_primary'].".txt";
				unlink($fileName);
				$file=fopen($fileName,"a");					//mutiple login save
				fwrite($file,md5($SID));
				fclose($file);
				//********************************************************************************
				$token=md5($_SESSION['secureSessionHijack'].$SID.$result[0]['email_primary']);		//session hijacking bock
				setcookie("userToken",$token , time()+3600*24,"/");
				//************************************************************************************************				
				header ( "location:../Home/userHomePage.php" );
			}
			else
			{
				header ( "location:../index.php?err=AuthenticationFailed" );
			}
		} 
		else 
		{			
			header ( "location:../index.php?err=AuthenticationFailed" );
		}
	}
	//******************************************************************************************************
	private function fillUserProfile() {
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
						"state_name" => "",
						"country_name" => "",
						"language" => "",
				        "nationality" => ""
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
		$userCertificationInfo = array (
				array (
						"name" => "",
						"description" => "",
						"duration" => "" 
				) 
		);
		$userExtraCurricularInfo = array (
				array (
						"activity" => ""
				) 
		);
		

		$this->obj_usrinfo = unserialize ( $_SESSION ['userData'] );

		/**
		 * ************************** User Previous Job Info
		 * ***********************
		 */
		$flagData = false;
		foreach ( array_keys ( $userPreviousJobInfo [0] ) as $key => $value ) {			
			if (isset ( $_POST ["PreviousJob_".$value] )) {
				if (! empty ( $_POST ["PreviousJob_".$value] )) {
					$userPreviousJobInfo [0] [$value] = $_POST ["PreviousJob_".$value];
					$flagData = true;
				}
			}
		}
		if ($flagData) {
			$error = $this->obj_usrinfo->setUserPreviousJobInfoForm ( $userPreviousJobInfo );
			if(isset($error)){
			    if(!empty($error)){
			        if($error != 0){
			         header ("location:../Home/userHomePage.php?profile&err=".$error);
			         die;
			        }
			    }
			}
		}
		/**
		 * ************ User Professional Information **************
		 */
		
		$flagData = false;
		foreach ( array_keys ( $userProfessionalInfo [0] ) as $key => $value ) {
			if (isset ( $_POST [$value] )) {
				if (! empty ( $_POST [$value] )) {
					$userProfessionalInfo [0] [$value] = $_POST [$value];
					$flagData = true;
				}
			}
		}
		if ($flagData) {			
			$error = $this->obj_usrinfo->setUserProfessionalInfoForm ( $userProfessionalInfo );			
			if(isset($error)){
			    if(!empty($error)){
			        if($error != 0){
			         header ("location:../Home/userHomePage.php?profile&err=".$error);
			         die;
			        }
			    }
			}
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
	
		}
		/**
		 * ************************** User Project Information
		 * ***********************
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

		if ($flagData) {
			$this->obj_usrinfo->setUserProjectInfoForm ( $userProjectInfo );
			
		}
		/**
		 * ************************** User Extra Curricular Information ***********************
		 */
		$flagData = false;
		foreach ( array_keys ( $userExtraCurricularInfo [0] ) as $key => $value ) {
			if (isset ( $_POST ["extracurricular_".$value] )) {
				if (! empty ( $_POST ["extracurricular_".$value] )) {
					foreach ( $_POST ["extracurricular_".$value] as $inkey => $invalue ) {
						if (! empty ( $invalue )) {
							$userExtraCurricularInfo [0] [$value] = $_POST ["extracurricular_".$value];
							$flagData = true;
						}
					}
				}
			}
		}

		if ($flagData) {
			$this->obj_usrinfo->setUserExtraCurricularInfoForm( $userExtraCurricularInfo );
		}		
		/**
		 * ************************** User Personal Information ***********************
		 */
		$flagData = false;
		foreach ( array_keys ( $userPersonalInfo [0] ) as $key => $value ) {
			if (isset ( $_POST [$value] )) {
				if (! empty ( $_POST [$value] )) {
					$userPersonalInfo [0] [$value] = $_POST [$value];
					$flagData = true;
				}
			}
		}
		if ($flagData) {
		    $error = $this->obj_usrinfo->setUserPersonalInfoForm ( $userPersonalInfo );			
			if(isset($error)){
			    if(!empty($error)){
			        if($error != 0){
			         header ("location:../Home/userHomePage.php?profile&err=".$error);
			         die;
			        }		            
			    }			        
			}
		}
		/**
		 * ************************** User Address Information
		 * ***********************
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
			$error = $this->obj_usrinfo->setUserAddressInfoForm ( $userAddressInfo );			
			if(isset($error)){
			    if(!empty($error)){
			        if($error != 0){
			         header ("location:../Home/userHomePage.php?profile&err=".$error);
			         die;
			        }		            
			    }			        
			}			
		}
		/**
		 * ************************** User Certification Information
		 * ***********************
		 */
		$flagData = false;
		foreach ( array_keys ( $userCertificationInfo [0] ) as $key => $value ) {
			if (isset ( $_POST ["certificate_" . $value] )) {
				if (! empty ( $_POST ["certificate_" . $value] )) {
					foreach ( $_POST ["certificate_" . $value] as $inkey => $invalue ) {
						if (! empty ( $invalue )) {
							$userCertificationInfo [0] [$value] = $_POST ["certificate_" . $value];
							$flagData = true;
						}
					}
				}
			}
		}

		if ($flagData) {
			$this->obj_usrinfo->setUserCertificateInfoForm ( $userCertificationInfo );
		}
		/**
		 * ************************** User Academic Information
		 * ***********************
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
			$error = $this->obj_usrinfo->setUserAcademicInfoForm ( $userAcademicInfo );			
			if(isset($error)){
			    if(!empty($error)){
			        if($error != 0){
			         header ("location:../Home/userHomePage.php?profile&err=".$error);
			         die;
			        }		            
			    }			        
			}
		}

		$_SESSION ['userData'] = serialize ( $this->obj_usrinfo );
		header ( "location:../Home/userHomePage.php?profile" );

	}
	//***********************************************all server side validation********************************************
	private function validationCheck() {
		//echo "validation funnnn";
		$validdob = new UserDataValidation ();
		$error=$validdob->validate ( $_POST );
		return $error;
	}
	//**********************************************send mail to register user***********************************************
	
	private function mailToUser()
	{
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPAuth = true;
		$mail->Host = "ssl://smtp.gmail.com";
		$mail->Port = 465;
		$mail->Username = "careerbook2013@gmail.com";
		$mail->Password = "2013careerbook*";
		$mail->SMTPDebug = 1;
		$webmaster_email = "careerbook2013@gmail.com";
		
		
		$email="avni.jain@osscube.com";
		$name="Avni";
		
		
		$mail->From = $webmaster_email;
		$mail->FromName = "CareerBook";
		$mail->AddAddress($email,$name);
		$mail->AddReplyTo($webmaster_email,"Webmaster");
		$mail->WordWrap = 50; // set word wrap
		$mail->IsHTML(true); // send as HTML
		$mail->Subject = 'Registration in careerbook';
		$userPassword=$_SESSION ['userDefaultPwd'];
		$mail->Body="<br>Dear User,Your password for registration with careerbook<br>".
				"User Name:".$_POST['email_primary']."<br>".
				"password:".$userPassword."<br>";
		$mail->AltBody = "This is the body when user views in plain text format"; //Text Bod	
		
		if($mail->Send()) {
			echo $lang->MAILSENT;
		} else {
			echo "Mailer Error: " . $mail->ErrorInfo;
		}
	}
	
} //***********************************************End of class*****************************

$obj = mainentrance::getinstance ();
$obj->start ();

?>
