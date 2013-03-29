<?php
/*
    **************************** Creation Log *******************************
    File Name                   -  FriendsClass.php
    Project Name                -  Careerbook
    Description                 -  Friends manipulation classes
    Version                     -  1.0
    Created by                  -  Mohit K. Singh 
    Created on                  -  March 20, 2013
	***************************** Update Log ********************************
	Sr.NO.		Version		Updated by           Updated on          Description
    -------------------------------------------------------------------------
    */
class FriendClass {	//class manipulation my friens
    
    private $_myFriendsNetwork;		// will store all my friends data
    
    public function __construct()
    {
        
    }
    //*****************************************************************set all my friends*******************************************
    public function setMyFriendsNetwork($persons)
    {
        $this->_myFriendsNetwork=$persons;
    }
    //****************************************************get all my friends********************************
    public function getMyFriendsNetwork()
    {
        return($this->_myFriendsNetwork);
    }
    //*****************************************************give count of my friends*************************************************
    public function countMyFriends()
    {
        return(count($this->_myFriendsNetwork));
    }
}

class FriendRequestClass {		//class manipulation all my friends request data
    
    private $_requestedFriends; 	//will store all my friends request 
    
    
    public function __construct()
    {
        
    }
    //**************************************************************** set my friends request************************************
    public function setRequestedFriends($persons)
    {
        $this->_requestedFriends=$persons;
    }
    //**************************************************************give count of my friends request****************************
    public function countReqFrnds()
    {
        return(count($this->_requestedFriends));
    }
    // *****************************************************************get all my friends request*******************************
    public function getRequestedFriends()
    {
        return($this->_requestedFriends);
    }
    
}

class AllUsersClass {		// class manipulation all search users
    
    private $_allUsers;		//will store all users data
    
    public function __construct()
    {
        
    }
    //*******************************************************************set all users data ***********************************
    public function setAllUsers($persons)
    {
        $this->_allUsers=$persons;
    }
    //************************************************************get all users data *****************************************
    public function getAllUsers()
    {
        return($this->_allUsers);
    }
    //*********************************************************** give all users count****************************************
    public function countAllUsers()
    {
    	return(count($this->_allUsers));
    } 
    
}


$friendsData=new FriendClass();			//my friends class object
$friendsReqData=new FriendRequestClass();	//my friends request class object
$AllUserData=new AllUsersClass();		//all user class object

?>