<?php

class FriendClass {
    
    private $_myFriendsNetwork;
   private $_requestedFriends;
    private $_allUsers;
    
    public function __construct()
    {
        
    }
    
    public function setMyFriendsNetwork($persons)
    {
        $this->_myFriendsNetwork=$persons;
    }
    
    public function setRequestedFriends($persons)
    {
        $this->_requestedFriends=$persons;
    }
    
    public function setAllUsers($persons)
    {
        $this->_allUsers=$persons;
    }
    
    public function getMyFriendsNetwork()
    {
        return($this->_myFriendsNetwork);
    }
    
    public function getRequestedFriends()
    {
        return($this->_requestedFriends);
    }
    
    public function getAllUsers()
    {
        return($this->_allUsers);
    }
    
    public function countMyFriends()
    {
        return(count($this->_myFriendsNetwork));
    }
    
    public function countReqFrnds()
    {
        return(count($this->_requestedFriends));
    }
}
$friendsData=new FriendClass();

?>