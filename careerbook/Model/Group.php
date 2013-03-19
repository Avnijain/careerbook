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
	protected $_group_discussion_title;
	protected $_group_discussion_description;
	protected $_group_discussion_id;
	protected $_group_discussion_comment;
	protected $_group_discussion_comment_id;
	protected $_group_member_group_id;
	protected $_group_member_user_id;
	protected $_created_on;
	protected $_created_by;
		
	
	
	//function to add user post 
	function add_post($group_id, $description) {
		
		$this->_db->Fields(array
							(
							"group_id"=>$this->_group_id,
							"description"=>$this->_group_discussion_description,
							"created_by"=>$this->_created_by,
							"created_on"=>$this->_created_on
							)
						);
		
		$this->_db->From("group_discussion");
		$this->_db->Insert();
		echo $this->_db->lastQuery();
		
	}
	
	//function to edit user post
	function edit_post($group_discussion_id, $description) {
		
		$this->_group_discussion_id = ( int ) $group_discussion_id;
		$this->_group_discussion_description = mysql_real_escape_string ( $description );
		$this->_created_by = $_SESSION['userid'];
		
		$this->_db->Fields(array(
							"description"=>$this->_group_discussion_description
							)
						);
		$this->_db->From("group_discussion");
		$this->_db->Where(array("id"=>$this->_group_discussion_id));
		$this->_db->Update();
		echo $this->_db->lastQuery();
	
	}
	
	//function to delete user post
	function delete($group_discussion_id) {
		
		$this->_group_discussion_id = ( int ) $group_discussion_id;
		
		$this->_db->From("group_discussion");
		$this->_db->Where(array("id"=>$this->_group_discussion_id));
		$this->_db->Delete();
		echo $this->_db->lastQuery();
		
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
	function get_posts($group_id = NULL, $group_discussion_id = NULL) {
		
		$this->_db->Fields(array(
							"title",
							"description",
							"created_by",
							"created_on",
							"updated_on"
							)
						);
		
		$this->_db->From("group_discussion");
		if (isset ( $group_id )) {
			$this->_db->Where(array("group_id"=>$this->_group_id));
		}
		
		if (isset ( $group_discussion_id )) {
			$this->_db->Where(array("id"=>$this->_group_discussion_id));
		}
		$this->_db->Select();
		return $this->_db->resultArray();
		
	}
	
	//function to list group details
	function get_group() {

		$this->_created_by = $_SESSION['userid'];
		$this->_db->Fields(array(
						"title",
						"description",
						"group_image",
					)
				);
		
		$this->_db->From("group_details");
		$this->_db->Join("group_members"," group_details.id = group_members.group_id ");
		$this->_db->Where(array("member_id"=>$this->_created_by));
	}
	
	//function to add comments
	function add_comment($group_discussion_id, $group_discussion_comment) {
		
		$this->_group_discussion_id = ( int ) $group_discussion_id;
		$this->_group_discussion_comment = mysql_real_escape_string ( $group_discussion_comment );
		$this->_created_by = $_SESSION['userid'];
		$this->_created_on = date ( 'Y-m-d H:i:s' );
		
		$this->_db->Fields(array
				(
						"discussion_id"=>$this->_group_discussion_id,
						"description"=>$this->_group_discussion_comment,
						"created_by"=>$this->_created_by,
						"created_on"=>$this->_created_on
				)
		);
		
		$this->_db->From("group_discussion_comment");
		$this->_db->Insert();
		echo $this->_db->lastQuery();
		
		echo mysql_error ();
	}

}

?>