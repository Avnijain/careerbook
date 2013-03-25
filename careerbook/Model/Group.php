<?php
// namespace Model;

/*
 **************************** Creation Log *******************************
File Name                   -  group.php
Project Name                -  Careerbook
Description                 -  Class file for start
Version                     -  1.0
Created by                  -  Manish Ranjan
Created on                  -  March 10, 2013
***************************** Update Log ********************************
Sr.NO.		Version		Updated by           Updated on          Description
-------------------------------------------------------------------------
*************************************************************************

*/

ini_set("display_errors", "1");
require_once 'singleton.php';

//Model for group class 
class Group extends DBConnection {
	
	//protected $db = "";
	protected $_group_image;
	protected $_group_title;
	protected $_group_description;
	protected $_group_id;
	//protected $_group_discussion_title;
	protected $_group_discussion_description;
	protected $_group_discussion_id;
	protected $_group_discussion_comment;
	protected $_group_discussion_comment_id;
	protected $_group_member_group_id;
	protected $_group_member_user_id;
	protected $_created_on;
	protected $_created_by;
	
	//function to add user post 
	function add_post() {
		
		$this->Fields(array
							(
							"group_id"=>$this->_group_id,
							"description"=>$this->_group_discussion_description,
							"created_by"=>$this->_created_by,
							"created_on"=>$this->_created_on
							)
						);
		
		$this->From("group_discussions");
		$this->Insert();
		echo $this->lastQuery();
		
	}
	
	//function to edit user post
	function edit_post($group_discussion_id, $description) {
			
		$this->Fields(array(
							"description"=>$this->_group_discussion_description
							)
						);
		$this->From("group_discussions");
		$this->Where(array("id"=>$this->_group_discussion_id));
		$this->Update();
		echo $this->lastQuery();
	
	}
	
	//function to delete user post
	function delete() {
		
		$this->From("group_discussions");
		$this->Where(array("id"=>$this->_group_discussion_id));
		$this->Delete();
		echo $this->lastQuery();
		
	}
	
	//function to add new group
	function add_group() {
		
		$this->Fields(array
				(
						"title"=>$this->_group_title,
						"description"=>$this->_group_description,
						"group_image"=>$this->_group_image,
						"created_by"=>$this->_created_by,
						"created_on"=>$this->_created_on
				)
		);
		
		$this->From("group_details");
		$this->Insert();
		echo $this->lastQuery();
		echo (mysql_error());

	}
	
	//function to list group post
	function get_posts() {
		
		$this->Fields(array(
							"id",
							"description",
							"created_by",
							"created_on",
							"updated_on"
							)
						);
		
		$this->From("group_discussions");
		$this->Where(array("group_id"=>$this->_group_id));

		$this->Select();
		echo $this->lastQuery();
		//print_r ($this->resultArray()); die;
		return $this->resultArray();
		
	}
	
	//function to list group details
	function get_group() {

		$this->Fields(array(
						"group_details.id",
						"title",
						"description",
						"created_on"
						//"group_image",
					)
				);
		
		$this->From("group_details");
		$this->Join("group_members"," group_details.id = group_members.group_id ");
		$this->Where(array("group_members.member_id"=>$this->_created_by));
		
		$this->Select();
// 		echo $this->lastQuery();
// 		print_r ($this->resultArray()); die;
		return $this->resultArray();
	}
	
	//function to add comments
	function add_comment() {
				
		$this->Fields(array
				(
						"discussion_id"=>$this->_group_discussion_id,
						"description"=>$this->_group_discussion_comment,
						"created_by"=>$this->_created_by,
						"created_on"=>$this->_created_on
				)
		);
		
		$this->From("group_discussion_comments");
		$this->Insert();
		echo $this->lastQuery();
		
		echo mysql_error ();
	}
	
	function get_comments() {
	
		$this->Fields(array(
				"discussion_id",
				"description",
				"created_by",
				"created_on",
				"updated_on"
		)
		);
	
		$this->From("group_discussion_comments");
		$this->Where(array("discussion_id"=>$this->_group_discussion_id));
	
		$this->Select();
		echo $this->lastQuery();
		//print_r ($this->resultArray()); die;
		return $this->resultArray();
	
	}

}

?>