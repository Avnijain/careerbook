<?php
//session_start();
ini_set("display_errors", "1");
require_once '../Model/friends_model.php';
require_once '../Model/model.php';
require_once'../classes/friendsClass.php';
class MyFriend{
    
    private $_objFriend;
    private $_objFrndModel;
    private $_objModel;
    
    public function __construct()
    {
        $this->_objModel=new MyClass();
        $this->_objFriend=new FriendClass();
        $this->_objMyFrndReq=new FriendRequestClass();
        $this->_objAllUsers=new AllUsersClass();
        $this->_objFrndModel=new FriendsModel();
    }
    
    public function start($request)
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
    }
    
    private function acceptFrnd()
    {

        $this->_objModel->acceptNewFrnd($_POST['id']);
    }
    private function getFrndReq()
    {
        $result=$this->_objFrndModel->getFrndsReqData();
        $this->_objMyFrndReq->setRequestedFriends($result);
        $_SESSION['FrndReq']=serialize($this->_objMyFrndReq);
        
    }
    
    private function getMyFriends()
    {
        $result=$this->_objFrndModel->getFriends();
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