<?php
//session_start();
ini_set("display_errors", "1");
require_once '../Model/friends_model.php';
require_once '../Model/model.php';
require_once'../classes/friendsClass.php';
require_once '../controller/userInfo.php';
class MyFriend{
    
    private $_objFriend;
    private $_objFrndModel;
    private $_objModel;
    private $_obj_usrinfo;
    
    
    public function __construct()
    {
        $this->_objModel=new MyClass();
        $this->_objFriend=new FriendClass();
        $this->_objMyFrndReq=new FriendRequestClass();
        $this->_objAllUsers=new AllUsersClass();
        $this->_objFrndModel=new FriendsModel();
        $this->_obj_usrinfo=new user_info_controller();
    }
    
    public function start($request,$searchVal="")
    {

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
    
    private function allUsers($searchVal)
    {
    	$this->_obj_usrinfo=unserialize($_SESSION['userData']);
    	$result=$this->_objFrndModel->getAllUsersData($this->_obj_usrinfo,$searchVal);
    	$this->_objAllUsers->setAllUsers($result);
    	$_SESSION['allUsers']=serialize($this->_objAllUsers);
    }
    /*private function acceptFrnd()
    {
    	$this->_obj_usrinfo=unserialize($_SESSION['userData']);
        $this->_objModel->acceptNewFrnd($this->_obj_usrinfo,$_POST['id']);
    }*/
    private function getFrndReq()
    {
    	$this->_obj_usrinfo=unserialize($_SESSION['userData']);
        $result=$this->_objFrndModel->getFrndsReqData($this->_obj_usrinfo);
        $this->_objMyFrndReq->setRequestedFriends($result);
        $_SESSION['FrndReq']=serialize($this->_objMyFrndReq);
        
    }
    
    private function getMyFriends()
    {
    	$this->_obj_usrinfo=unserialize($_SESSION['userData']);
        $result=$this->_objFrndModel->getFriends($this->_obj_usrinfo);
        $this->_objFriend->setMyFriendsNetwork($result);
        $_SESSION['myFriends']=serialize($this->_objFriend);
        
    }
    
}
$objFrndControl=new MyFriend();

if(isset($_POST['action']))
{
    $objFrndControl->start($_POST['action']);
}


?>