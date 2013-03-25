<?php
// namespace Model;

/*
 **************************** Creation Log *******************************
File Name                   -  message.php
Project Name                -  Careerbook
Description                 -  class for Message
Version                     -  1.0
Created by                  -  Avni Jain
Created on                  -  March 23, 2013
***************************** Update Log ********************************
Sr.NO.		Version		Updated by           Updated on          Description
-------------------------------------------------------------------------
*************************************************************************

*/

ini_set("display_errors", "1");
require_once 'singleton.php';

//Model for message class 
class Message extends DBConnection {
	
	//protected $db = "";
	protected $_message_id;
	protected $_message_description;
	protected $_user_from;
	protected $_user_to;
	protected $_messaging_time;
	protected $_user_name;
	protected $_email_id;
	public $userid;
	

	
	//function to send a message
	function send_message() {
		
		$this->Fields(array
				(
						"id"=>$this->_message_id,
						"description"=>$this->_message_description,
						"user_from"=>$this->_user_from,
						"user_to"=>$this->_user_to,
						"messaging_time"=>$this->_messaging_time
				)
		);
		
		$this->From("messaging");
		$this->Insert();
		//echo $this->lastQuery();
		//echo (mysql_error());

	}
	
	//function to get user's message
	function get_message() {
		
		$this->Fields(array(
							"description",
							"user_from",
							"messaging_time"
							)
						);
		
		$this->From("messaging");
		$this->Where(array("user_to"=>$this->_user_to));

		$this->Select();
		//echo $this->lastQuery();
		return $this->resultArray();
		
	}
	//function to get sent message
	function sent_message() {
		
		$this->Fields(array(
							"description",
							"user_to",
							"messaging_time"
							)
						);
		
		$this->From("messaging");
		$this->Where(array("user_from"=>$this->_user_from));

		$this->Select();
		//echo $this->lastQuery();
		return $this->resultArray();
		
	}
	function get_id() {
	
		$this->Fields(array(
				"id"
		)
		);
	
		$this->From("users");
		$this->Where(array("email_primary"=>$this->_email_id));
	
		$this->Select();
		echo $this->lastQuery();
		return $this->resultArray();
	
	}
	function get_name() {
	
		$this->Fields(array(
							"first_name",
							"last_name"
		)
		);
	
		$this->From("users");
		$this->Where(array("id"=>$this->userid));
	
		$this->Select();
		echo $this->lastQuery();
		return $this->resultArray();
	
	}
	
	
}

?>