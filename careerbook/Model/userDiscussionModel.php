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
	public function getComments($userInfo,$searchVal){
	    $userID = $userInfo->getUserIdInfo();
        $this->Fields(array('b.description',
            "d.first_name",
            "d.profile_image",
            "b.created_on"
        ));
        $this->From('user_discussions_comments b');
        $this->Join ( "users d", "d.id = b.user_id" );
        $this->Where(array("user_discussions_id=".$searchVal),true);
        $this->Select();        
	    $tempData = $this->resultArray();
	
	    $tempData['discussionID'] = $searchVal;
	    
	    if(!empty($tempData)){
	        
	        $result[] = $tempData;	        
	    }
	    else{

	        $tempData['description'] = "No Comments";
	        $result[] = $tempData;
	    }
	    return $result;
	}
	public function postComments($userInfo,$searchVal,$comment){
	    $userID = $userInfo->getUserIdInfo();
	    $this->Fields(array("user_discussions_id"=>"$searchVal",	        
	        "description"=>"$comment",
	        "user_id"=>"$userID[id]"
	    ));	    
	    $this->From('user_discussions_comments');
		$this->Insert ();		
		
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