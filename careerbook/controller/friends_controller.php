<?php
/*
    **************************** Creation Log *******************************
    File Name                   -  Friends_controller.php
    Project Name                -  Careerbook
    Description                 -  Friends  controller classes
    Version                     -  1.0
    Created by                  -  Mohit K. Singh 
    Created on                  -  March 20, 2013
	***************************** Update Log ********************************
	Sr.NO.		Version		Updated by           Updated on          Description
    -------------------------------------------------------------------------
    */


//session_start();
ini_set("display_errors", "1");

// require class,controller and model files
require_once '../Model/friends_model.php';	
require_once '../Model/model.php';
require_once'../classes/friendsClass.php';
require_once '../controller/userInfo.php';

class MyFriend{			//class to control all my friends needs
    
    private $_objFriend;	//friendsClass object
    private $_objFrndModel;	//friendModel Object
    private $_objModel;		//model object
    private $_obj_usrinfo;	//user_info_controller object
    
    
    public function __construct()
    {
	//************************createing all object in constructor**************************************
        $this->_objModel=new MyClass();
        $this->_objFriend=new FriendClass();
        $this->_objMyFrndReq=new FriendRequestClass();
        $this->_objAllUsers=new AllUsersClass();
        $this->_objFrndModel=new FriendsModel();
        $this->_obj_usrinfo=new user_info_controller();
    }
    
    //************************************************takes all request from users*****************************************************
    public function start($request,$searchVal="")
    {	
    	if($request=='getFrndsDis')
    	{
    		$result = $this->getMyFriendsDis();
    		return $result;
    	}
        if($request=='myFriends')
           {
            $this->getMyFriends();
           }
        elseif($request=='FrndReq')
        {
            $this->getFrndReq();
        }
        elseif($request=='acceptFrnd')
        {

            $this->acceptFrnd();
        }
        elseif($request=='allUsers')
        {
        
        	$this->allUsers($searchVal);
        }
        
    }
    
    //
    private function getMyFriendsDis(){
    	$this->_obj_usrinfo=unserialize($_SESSION['userData']);
    	$result=$this->_objFrndModel->getFrndsDis($this->_obj_usrinfo);
     	return ($result);
    }
    
    //**************************************************************find all users**********************************************************
    private function allUsers($searchVal)
    {
    	$this->_obj_usrinfo=unserialize($_SESSION['userData']);
    	$result=$this->_objFrndModel->getAllUsersData($this->_obj_usrinfo,$searchVal);
    	$this->_objAllUsers->setAllUsers($result);
    	$_SESSION['allUsers']=serialize($this->_objAllUsers);
    }
    //*********************************************************find all my friends request***************************************************
    private function getFrndReq()
    {
    	$this->_obj_usrinfo=unserialize($_SESSION['userData']);
        $result=$this->_objFrndModel->getFrndsReqData($this->_obj_usrinfo);
        $this->_objMyFrndReq->setRequestedFriends($result);
        $_SESSION['FrndReq']=serialize($this->_objMyFrndReq);
        
    }
    // **************************************************************get all my freiends******************************************
    private function getMyFriends()
    {
    	$this->_obj_usrinfo=unserialize($_SESSION['userData']);
        $result=$this->_objFrndModel->getFriends($this->_obj_usrinfo);
        $this->_objFriend->setMyFriendsNetwork($result);
        $_SESSION['myFriends']=serialize($this->_objFriend);
        
    }
    
}

$objFrndControl=new MyFriend();		//createing  friends class objest

if(isset($_POST['action']))
{
    $objFrndControl->start($_POST['action']);   //perform the task
}


?>