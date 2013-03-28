<?php 
include_once '../controller/userInfo.php';
include_once '../Model/userDiscussionModel.php';

class UserDiscussionController extends UserDiscussion {
	
	public $userid;
	
	function __construct() {
		if (isset ( $_SESSION ['userData'] )) {
			$obj = new user_info_controller ();
			$obj = unserialize ( $_SESSION ['userData'] );
			$userid = $obj->getUserIdInfo ();
			$this->userid = ( int ) $userid ['id'];
		}
	}
	
	function handleAddUserPost() {
		$this->_user_id = (int) $this->userid;
		$this->_user_discussion_description = $_REQUEST['description'];
		$this->_created_on = date ( 'Y-m-d H:i:s' );
		
		$this->add_post();
		header('Location: ../views/userHomePage.php');
	}
}

//$objUserDiscussion = new UserDiscussionController();

?>