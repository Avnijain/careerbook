<?php 
include_once '../controller/userInfo.php';
include_once '../Model/userDiscussionModel.php';

class UserDiscussionController extends UserDiscussion {
	
	public $userid;
	
	function __construct() {
		$this->_obj_user_class = new user_info_controller ();
	if(isset($_SESSION['userData']))
		{
			$this->_obj_user_class = unserialize($_SESSION['userData']);
			$userData=$this->_obj_user_class->getUserIdInfo();
			$this->userid = $userData['id'];
		} else {
			header('Location: ../index.php');
		}
	}
	
	function handleAddUserPost() {
		$this->_user_id = (int) $this->userid;
		$this->_user_discussion_description = trim($_REQUEST['description']);
		$this->_created_on = date ( 'Y-m-d H:i:s' );
		
		$this->add_post();
		header('Location: ../Home/userHomePage.php');
	}
}

//$objUserDiscussion = new UserDiscussionController();

?>