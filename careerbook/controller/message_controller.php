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

public $userid;
	
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
		$this->_user_to = mysql_real_escape_string($_POST['uid']);
		$this->_user_from = $this->userid;
		$this->_messaging_time = date ( 'Y-m-d H:i:s' );
	    $this->send_message();
	}
	function handleRecieveMessage() {
	
		$this->_user_to = $this->userid;
	    $result=$this->get_message();
		return($result);
		//echo $result['user_from'];
		//echo $result['descripition'];
	}
	function handleSentMessage() {
	
	    $this->_user_from = $this->userid;
	    $result=$this->sent_message();
		//print_r($result);
		return($result);
	
	
	}
	}

?>

