<?php
include_once '../controller/userInfo.php';
require_once 'DbConnectionModelAbstract.php';

class UserDiscussion extends model {
	protected $_user_discussion_id;
	protected $_user_discussion_description;
	protected $_user_id;
	protected $_created_by;
	protected $_likes;
	protected $_user_discussion_comment;
	
	function __construct(){
	    parent::__construct();
	}
	/* This function will delete user particular post */
	public function deleteDiscussionPost($userInfo,$searchVal){
        $user_id = $userInfo->getUserIdInfo();
        $user_id = $user_id['id'];
        $this->db->Fields(array("status"=>"D"));
        $this->db->From("user_discussions");
        $this->db->Where(array("id = " . $searchVal. " AND user_id = ".$user_id),true);
        $this->db->Update();
        return $this->db->lastQuery(); 
	}
	public function deleteCommentPost($userInfo,$searchVal){
        $user_id = $userInfo->getUserIdInfo();
        $user_id = $user_id['id'];
        $this->db->Fields(array("status"=>"D"));
        $this->db->From("user_discussions_comments");
        $this->db->Where(array("id = " . $searchVal. " AND user_id = ".$user_id),true);
        $this->db->Update();
        return $this->db->lastQuery(); 
	}	
	/* This function will fetch all the use comments of particular post */
	public function getComments($userInfo,$searchVal){
	    $userID = $userInfo->getUserIdInfo();
        $this->db->Fields(array('b.description',
            "b.id",
            "d.first_name",
            "d.profile_image",
            "d.id user_id",
            "b.created_on"
        ));
        $this->db->From('user_discussions_comments b');
        $this->db->Join ( "users d", "d.id = b.user_id" );
        $this->db->Where(array("user_discussions_id = ".$searchVal." AND b.status <> 'D'"),true);
        $this->db->OrderBy("b.created_on");
        $this->db->Select();        
	    $tempData = $this->db->resultArray();
	
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
	    $this->db->Fields(array("user_discussions_id"=>"$searchVal",	        
	        "description"=>"$comment",
	        "user_id"=>"$userID[id]"
	    ));	    
	    $this->db->From('user_discussions_comments');
		$this->db->Insert ();		
	}	
	function add_post() {
		$this->db->Fields ( array (
				"description" => $this->_user_discussion_description,
				"user_id" => $this->_user_id,
				"created_on" => $this->_created_on
		));		
		$this->db->From ( "user_discussions" );
		$this->db->Insert ();		
	}	
	function get_post() {
		$this->db->Fields ( array (
				"id",
				"description",
				"user_id",
				"created_on",
				"Likes"
		) );		
		$this->db->From ( "user_discussions" );
		$this->db->Where ( array (
				"user_id = ". $this->_user_id . "AND status = 'A'"
		), true );
		
		$this->db->Select ();
		return $this->db->resultArray ();
	}
}
?>