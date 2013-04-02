<?php
/*
 * *************************** Creation Log ******************************* File Name - getImageModel.php Project Name - Careerbook Description - Friends model classes Version - 1.0 Created by - Mohit K. Singh Created on - March 08, 2013 **************************** Update Log ******************************** Sr.NO.		Version		Updated by Updated on Description -------------------------------------------------------------------------
 */
ini_set ( "display_errors", "1" );

require_once 'singleton.php';
abstract class model { // abstract class to create a instance of singleton DBconnection class
	protected $db = "";
	function __construct() {
		$this->db = DBConnection::Connect ();
	}
}
class MyImageGet extends model { // class for manipulation image data from
	
	/*
	 * public function UpdateUser(){ $tmpName="../images/a6.jpg"; $this->db->Fields(array("profile_image"=>$data)); $this->db->From("users"); $this->db->Where(array("id"=>23)); $this->db->Update(); echo $this->db->lastQuery(); }
	 */
	// *************************************************fetch user Image **************************************************
	public function getUserImage($userId) {
		$this->db->Fields ( array (
				'profile_image' 
		) );
		$this->db->From ( 'users' );
		$this->db->Where ( array (
				"id" => $userId 
		) );
		$this->db->Select ();
		$image = $this->db->resultArray ();
		
		$uri = 'data:image/png;base64,' . base64_encode ( $image [0] ['profile_image'] );
		return ($uri);
	}
	// ***************************************************fetch all my friends image data************************************
	public function getUserFrndsImage($userId) {
		$this->db->Fields ( array (
				'u.profile_image' 
		) );
		$this->db->From ( 'users u,friends f' );
		
		$this->db->Where ( array (
				"user_id=" . $userId . " AND friend_id=u.id AND f.status='F'" 
		), true );
		$this->db->Select ();
		$result = $this->db->resultArray ();
		$uri = "";
		foreach ( $result as $keys => $values ) {
			$uri [] = 'data:image/png;base64,' . base64_encode ( $values ['profile_image'] );
		}
		
		return ($uri);
	}
	//***************************************************fetch all my group image data************************************
	public function getUserGroupImage($userId) {
		$this->db->Fields ( array (
				"group_image" 
		) );
		
		$this->db->From ( "group_details" );
		$this->db->Join ( "group_members", " group_details.id = group_members.group_id " );
		$this->db->Where ( array (
				"group_members.member_id = " . $userId . " AND group_members.status = 'A'" 
		), true );
		
		$this->db->Select ();
		$result = $this->db->resultArray ();
		$uri = "";
		foreach ( $result as $keys => $values ) {
			$uri [] = 'data:image/png;base64,' . base64_encode ( $values ['group_image'] );
		}
		
		return ($uri);
	}
}

// $obj = new MyImageGet();
// $obj->getUserFrndsImage(17);

?>