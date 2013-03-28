<?php

include_once '../controller/userInfo.php';

class UserDiscussion extends DBConnection {
	protected $_user_discussion_id;
	protected $_user_discussion_description;
	protected $_user_id;
	protected $_created_by;
	protected $_likes;
	protected $_user_discussion_comment;
	
	function __construct(){

	}
	
	function add_post() {
		$this->Fields ( array (
				"description" => $this->_user_discussion_description,
				"user_id" => $this->_user_id,
				"created_on" => $this->_created_on
		) );
		
		$this->From ( "user_discussions" );
		$this->Insert ();
		
	}
	
	function get_post() {
		$this->Fields ( array (
				"id",
				"description",
				"user_id",
				"created_on",
				"Likes"
		) );
		
		$this->From ( "user_discussions" );
		$this->Where ( array (
				"user_id = ". $this->_user_id . "AND status = 'A'"
		), true );
		
		$this->Select ();
		return $this->resultArray ();
	}
}



?>