<?php

class GroupList {
	private $_groupList;
	
	function setGroupList($groupList) {
		$this->_groupList = $groupList;
	}
	
	function getGroupList() {
		return $this->_groupList;
	}
	
	function getGroupDetail($groupList) {
		
	}
	
	function countGroupList() {
		return count($this->_groupList);
	}
}

class GroupPost {
	private $_postList;
	
	function setPostList($groupList) {
		$this->_postList = $groupList;
	}
	
	function getPostList() {
		return $this->_postList;
	}
	
	function countPostList() {
		return count($this->_postList);
	}
}

class GroupComment {
	private $_commentList;

	function setCommentList($groupList) {
		$this->_commentList = $groupList;
	}

	function getCommentList() {
		return $this->_commentList;
	}

	function countCommentList() {
		return count($this->_commentList);
	}
}

class GroupSearch {
	private $_groupSearchList;

	function setGroupSearchList($groupList) {
		$this->_groupSearchList = $groupList;
	}

	function getGroupSearchList() {
		return $this->_groupSearchList;
	}

	function countGroupSearchList() {
		return count($this->_groupSearchList);
	}
}

?>