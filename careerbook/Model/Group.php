<?php
// namespace Model;

/*
 * *************************** Creation Log ******************************* 
 * File Name - group.php 
 * Project Name - Careerbook 
 * Description - Class file for start Version - 1.0 
 * Created by - Manish Ranjan 
 * Created on - March 10, 2013 
 * **************************** Update Log ******************************** 
 * Sr.NO.		Version		Updated by Updated on Description 
 * ------------------------------------------------------------------------- 
 * ************************************************************************
 */
ini_set ( "display_errors", "1" );
require_once 'singleton.php';

// Model for group class
class Group {
	
	protected $db = "";
	protected $_group_image;
	protected $_group_title;
	protected $_group_description;
	protected $_group_id;
	protected $_group_discussion_description;
	protected $_group_discussion_id;
	protected $_group_discussion_comment;
	protected $_group_discussion_comment_id;
	protected $_group_member_group_id;
	protected $_group_member_user_id;
	protected $_created_on;
	protected $_created_by;
	protected $_search_group;
	
	function __construct() {
			$this->db = DBConnection::Connect();
	}
	
	// function to add user post
	function add_post() {
		$this->db->Fields ( array (
				"group_id" => $this->_group_id,
				"description" => $this->_group_discussion_description,
				"created_by" => $this->_created_by,
				"created_on" => $this->_created_on 
		) );
		
		$this->db->From ( "group_discussions" );
		$this->db->Insert ();
	}
	
	// function to edit user post
	function edit_post() {
		$this->db->Fields ( array (
				"description" => $this->_group_discussion_description 
		) );
		$this->db->From ( "group_discussions" );
		$this->db->Where ( array (
				"id" => $this->_group_discussion_id 
		) );
		$this->db->Update ();
		
	}
	
	// function to delete user post
	function delete_group() {
		$this->db->Fields ( array (
				"status" => 'D' 
		) );
		$this->db->From ( "group_details" );
		$this->db->Where ( array (
				"id" => $this->_group_id 
		) );
		$this->db->Update ();
	}
	
	function delete_comment() {
		$this->db->Fields ( array (
				"status" => 'D'
		) );
		$this->db->From ( "	group_discussion_comments" );
		$this->db->Where ( array (
				"id" => $this->_group_discussion_comment_id
		) );
		$this->db->Update ();
		
	}
	
	// function to add new group
	function add_group() {
		$this->db->Fields ( array (
				"title" => $this->_group_title,
				"description" => $this->_group_description,
				"group_image" => $this->_group_image,
				"created_by" => $this->_created_by,
				"created_on" => $this->_created_on 
		) );
		
		$this->db->From ( "group_details" );
		$this->db->Insert ();
		//echo $this->db->lastQuery();die;
		$gid = $this->db->lastInsertId ();
		
		$this->db->Fields ( array (
				"group_id" => $gid,
				"member_id" => $this->_created_by 
		) );
		$this->db->From ( "group_members" );
		$this->db->Insert ();
		
	}
	
	// function to edit group
	function edit_group() {
		$this->db->Fields ( array (
				"title" => $this->_group_title,
				"description" => $this->_group_description,
				"group_image" => $this->_group_image
		) );
	
		$this->db->From ( "group_details" );
		$this->db->Where ( array (
				"id" => $this->_group_id
		) );
		$this->db->Update ();
		//echo $this->db->lastQuery();die;
		
	
	}
	
	// function to list group post
	function get_posts() {
		$this->db->Fields ( array (
				"group_discussions.id",
				"group_discussions.description",
				"group_discussions.created_by",
				"group_discussions.created_on",
				"group_discussions.updated_on",
				"users.first_name",
				"users.middle_name",
				"users.last_name",
				"users.profile_image" 
		) );
		
		$this->db->From ( "group_discussions" );
		$this->db->Join("users","group_discussions.created_by = users.id");
		$this->db->Where ( array (
				"group_id" => $this->_group_id 
		) );
		
		$this->db->Select ();
		//echo $this->db->lastQuery();die;
		return $this->db->resultArray ();
	}
	
	//function to get details of particular post
	function get_post() {
		$this->db->Fields ( array (
				"group_discussions.id",
				"group_discussions.description",
				"group_discussions.created_by",
				"group_discussions.created_on",
				"group_discussions.updated_on",
				"users.first_name",
				"users.middle_name",
				"users.last_name",
				"users.profile_image" 
		) );
	
		$this->db->From ( "group_discussions" );
		$this->db->Join("users","group_discussions.created_by = users.id");
		$this->db->Where ( array (
				"group_discussions.id" => $this->_group_discussion_id
		) );
	
		$this->db->Select ();
	
		return $this->db->resultArray ();
	}
	
	// function to list group details
	function get_group() {
		$this->db->Fields ( array (
				"group_details.id",
				"title",
				"description",
				"created_by",
				"created_on", 
			    "group_image"
				) );
		
		$this->db->From ( "group_details" );
		$this->db->Join ( "group_members", " group_details.id = group_members.group_id " );
		$this->db->Where ( array (
				"group_members.member_id = " .$this->_created_by . " AND group_details.status = 'A' AND group_members.status = 'A'"
		),true );
		
		$this->db->Select ();
		
		//echo $this->db->lastQuery();die;

		return $this->db->resultArray ();
	}
	
	function get_group_detail() {
		$this->db->Fields ( array (
				"id",
				"title",
				"description",
				"created_on",
				"group_image",
		) );
	
		$this->db->From ( "group_details" );
	
		$this->db->Where ( array (
				"id = ". $this->_group_id
		),true );
	
		$this->db->Select ();
	
		//echo $this->lastQuery();die;
	
		return $this->db->resultArray ();
	}
	
	// function to add comments
	function add_comment() {
		$this->db->Fields ( array (
				"discussion_id" => $this->_group_discussion_id,
				"description" => $this->_group_discussion_comment,
				"created_by" => $this->_created_by,
				"created_on" => $this->_created_on 
		) );
		
		$this->db->From ( "group_discussion_comments" );
		$this->db->Insert ();
		
	}
	
	function get_comments() {
		$this->db->Fields ( array (
				"group_discussion_comments.id",
				"group_discussion_comments.discussion_id",
				"description",
				"group_discussion_comments.created_by",
				"group_discussion_comments.created_on",
				"group_discussion_comments.updated_on",
				"users.first_name",
				"users.middle_name",
				"users.last_name",
				"profile_image" 
		) );
		
		$this->db->From ( "group_discussion_comments" );
		$this->db->Join("users","group_discussion_comments.created_by = users.id");
		$this->db->Where ( array (
				"group_discussion_comments.discussion_id =" . $this->_group_discussion_id . " AND group_discussion_comments.status = 'A' " 
		), True );
		
		$this->db->Select ();
		//echo $this->db->lastQuery();die;
		return $this->db->resultArray ();
	}
	
	function join_group() {
		
		$this->db->Fields ( array (
				"group_id" => $this->_group_id,
				"member_id" => $this->_created_by
		) );
		$this->db->From ( "group_members" );
		$this->db->Where ( array (
				"member_id = " .$this->_created_by  . " AND group_id = " . $this->_group_id
		),true );
		$this->db->Select();
		
		$result= $this->db->resultArray ();
		
		if (count($result) == 0) {
			$this->db->Fields ( array (
					"group_id" => $this->_group_id,
					"member_id" => $this->_created_by
			) );
			$this->db->From ( "group_members" );
			$this->db->Insert();
		} else {
			$this->db->Fields ( array (
					"status" => 'A'
			) );
			$this->db->From ( "group_members" );
			$this->db->Update ();
		}
	}
	
	function unjoin_group() {
		$this->db->Fields ( array (
				"status" => 'D' 
		) );
		$this->db->From ( "group_members" );
		$this->db->Where ( array (
				"member_id = " .$this->_created_by  . " AND group_id = " . $this->_group_id
		),true );
		$this->db->Update ();
	}
	
	function search_group() {
		$this->db->Fields ( array (
				"gd.id",
				"gd.title",
				"gd.description",
				"gd.group_image",
				"gm.member_id",
				"gm.status"
		) );
		
		$this->db->From ('group_details gd');
		$this->db->Join('group_members gm', 'gd.id = gm.group_id');
		$this->db->Where(array(
						"( gd.status = 'A' AND gm.member_id = ".$this->_created_by.") AND (gm.status = 'A' OR gm.status = 'D') AND
						(gd.title LIKE '%" .$this->_search_group. "%' OR gd.description LIKE '%" . $this->_search_group ."%' )
					"),true);
		$this->db->Select ();
		echo $this->db->lastQuery();
		$result1 = $this->db->resultArray ();
		
		$this->db->unsetValues();
		
		$this->db->Fields ( array (
				"gd.id"
		) );
		
		$this->db->From ('group_details gd');
		$this->db->Join('group_members gm', 'gd.id = gm.group_id');
		$this->db->Where(array(
						"( gd.status = 'A' AND gm.member_id = ".$this->_created_by.") AND (gm.status = 'A' OR gm.status = 'D') AND
						(gd.title LIKE '%" .$this->_search_group. "%' OR gd.description LIKE '%" . $this->_search_group ."%' )
				"),true);
		$this->db->Select ();
		$result2 = $this->db->resultArray ();
		
		$myStr="";
		foreach($result2 as $keys=>$values){
			foreach ($values as $key=>$value)
			{
				$myStr.=$value.",";
			}
		}
			
		$myStr=substr($myStr,0,-1);
		
		$this->db->unsetValues();
		
		$this->db->Fields ( array (
				"gd.id",
				"gd.title",
				"gd.description",
				"gd.group_image",
		) );
		
		$this->db->From ('group_details gd');
		$this->db->Where(array(
				" 	gd.status = 'A' AND
					(gd.title LIKE '%" .$this->_search_group. "%' OR gd.description LIKE '%" . $this->_search_group ."%' ) AND
					gd.id NOT IN (".$myStr.")
				"),true);
		$this->db->Select ();
		$result3 = $this->db->resultArray ();
		
		$result=array_merge($result1,$result3);
		return($result);
	}
	
	function is_group_member() {
		$this->db->Fields ( array (
				"group_id" => $this->_group_id,
				"member_id" => $this->_created_by
		) );
		$this->db->From ( "group_members" );
		$this->db->Where ( array (
				"member_id = " .$this->_created_by  . " AND group_id = " . $this->_group_id . " AND status = 'A'"
		),true );
		$this->db->Select();
		
		$result = $this->db->resultArray ();
		
		if (count($result) == 0) {
			return false;
		} else {
			return true;
		}
	}
}

?>