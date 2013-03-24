<?php 

class GroupClass {
	private $_groupList;
	private $_postList;
	
	function __construct() {
		
	}

	public function setGroupList($group) {
		$this->_groupList = $persons;
	}
	
	public function setPostList($group) {
		$this->_postList = $persons;
	}
	
	public function getGroupList() {
		return ($this->_groupList);
	}
	
	public function getPostList() {
		return ($this->_postList);
	}
}

$groupData = new GroupClass();

?>