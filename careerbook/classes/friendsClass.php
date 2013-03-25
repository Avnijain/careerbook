<?php

class FriendClass {
    
    private $_myFriendsNetwork;
    public function __construct()
    {
        
    }
    public function setMyFriendsNetwork($persons)
    {
        $this->_myFriendsNetwork=$persons;
    } 
    public function getMyFriendsNetwork()
    {
        return($this->_myFriendsNetwork);
    }
    public function countMyFriends()
    {
        return(count($this->_myFriendsNetwork));
    }
}

class FriendRequestClass {
    private $_requestedFriends;
    
    public function __construct()
    {
        
    }
    public function setRequestedFriends($persons)
    {
        $this->_requestedFriends=$persons;
    }
    
    public function countReqFrnds()
    {
        return(count($this->_requestedFriends));
    }
    
    public function getRequestedFriends()
    {
        return($this->_requestedFriends);
    }
    
}

class AllUsersClass {
    
    private $_allUsers;
    
    public function __construct()
    {
        
    }
    public function setAllUsers($persons)
    {
        $this->_allUsers=$persons;
    }
    public function getAllUsers()
    {
        return($this->_allUsers);
    }   
    public function countAllUsers()
    {
    	return(count($this->_allUsers));
    } 
    
}


$friendsData=new FriendClass();
$friendsReqData=new FriendRequestClass();
$AllUserData=new AllUsersClass();

?>