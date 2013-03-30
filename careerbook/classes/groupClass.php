<?php

class GroupClass {
	private $_groupList;
	private $_groupDetail;
	private $_postList;
	private $_commentList;
	private $_groupSearchList;
	private $_postDetail;
	
	function setGroupList($groupList) {
		$this->_groupList = $groupList;
	}
	
	function getGroupList() {
		return $this->_groupList;
	}
	
	function countGroupList() {
		return count($this->_groupList);
	}
	
	function setGroupDetail($groupDetails) {
		$this->_groupDetail = $groupDetails;
	}
	
	function getGroupDetail() {
		return $this->_groupDetail;
	}
	
	
	function countGroupDetail() {
		return count($this->_groupDetail);
	}
	
	function setPostDetail($postDetails) {
		$this->_postDetail = $postDetails;
	}
	
	function getPostDetail() {
		return $this->_postDetail;
	}
	
	
	function countPostDetail() {
		return count($this->_postDetail);
	}
	
	function setPostList($groupList) {
		$this->_postList = $groupList;
	}
	
	function getPostList() {
		return $this->_postList;
	}
	
	function countPostList() {
		return count($this->_postList);
	}
	
	function setCommentList($groupList) {
		$this->_commentList = $groupList;
	}
	
	function getCommentList() {
		return $this->_commentList;
	}
	
	function countCommentList() {
		return count($this->_commentList);
	}
	
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