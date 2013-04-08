<?php
/*
 **************************** Creation Log *******************************
File Name                   -  message_controller.php
Project Name                -  Careerbook
Description                 -  controller class for Message
Version                     -  1.0
Created by                  -  Avni Jain
Created on                  -  March 23, 2013
***************************** Update Log ********************************
Sr.NO.		Version		Updated by           Updated on          Description
-------------------------------------------------------------------------
*************************************************************************

*/
include_once '../controller/userInfo.php';
include_once '../Model/message.php';
class MessageController extends Message
{


	
	function __construct() {
		if(isset($_SESSION['userData']))
		{
			$obj = new user_info_controller();
			$obj = unserialize($_SESSION['userData']);
			$userid = $obj->getUserIdInfo();
			$this->userid = $userid['id'];
		}
	}
	function handleSendMessage() {
		$this->_message_id='';
		$this->_message_description = mysql_real_escape_string($_POST['descripition']);
		$emailid=mysql_real_escape_string($_POST['uid']);
		print($emailid);
		if(!filter_var($emailid, FILTER_VALIDATE_EMAIL)) {
			header('location: ../Home/userHomePage.php?message&c=invaild');
			exit;
		}
		if (preg_match("'<script>'",$this->_message_description)) {
			header('location: ../Home/userHomePage.php?message&c=script');
			exit;
		}
		if (preg_match("(/(<([^>]+)>)",$this->_message_description)) {
			header('location: ../Home/userHomePage.php?message&c=script');
			exit;
		}
		
		$this->_email_id=$emailid;
		$recieverId=parent::get_id();
		if($recieverId[0]['id']==1) {
			header('location: ../Home/userHomePage.php?message&c=admin');
			exit;
		}
		$this->_user_to = $recieverId[0]['id'];
		$this->_user_from = $this->userid;
		$r=parent::Checkfriend();
		if(!count($r)) {
			header('location: ../Home/userHomePage.php?message&c=notfriend');
			exit;
		}
		$this->_messaging_time = date ( 'Y-m-d H:i:s' );
	    $this->send_message();
	}
	function handleRecieveMessage() {
		$this->_user_to = $this->userid;
	    $result=$this->get_message();
		$n=count($result);
		
		for($i=0;$i<$n;$i++)
		{
// 		    echo $result[$i]['status'];
// 		    die;
	     if($result[$i]['status']=='U')
		 {

			parent::updateStatus($result[$i]['id']);
		 }
		}
		//print_r($result);
		return($result);
		//echo $result['user_from'];
		//echo $result['descripition'];
	}
	function handleSentMessage() {
	
	    $this->_user_from = $this->userid;
	    $result=$this->sent_message();
		print_r($result);
		return($result);
	
	
	}
	function handleNewMessage() {
	 $count=$this->getNewMessage();
		//print_r($count);
		return($count);
		//session_start();
		//$_SESSION['count']=
	}
	function handleGetFriend() {
		$result=$this->getFriendId();
// 		print_r($result);
		return($result);
	}
	
	}
	$ob=new MessageController();