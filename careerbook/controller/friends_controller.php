<?php
//session_start();
ini_set("display_errors", "1");
require_once '../Model/friends_model.php';
require_once'../classes/friendsClass.php';
class MyFriend{
    
    private $_objFriend;
    private $_objFrndModel;
    
    public function __construct()
    {
        $this->_objFriend=new FriendClass();
        $this->_objFrndModel=new FriendsModel();
    }
    
    public function start($request)
    {
        if($request=='myFriends')
           {
            $this->getMyFriends();
           }
    }
    
    private function getMyFriends()
    {
        $result=$this->_objFrndModel->getFriends();
        $this->_objFriend->setMyFriendsNetwork($result);
        $_SESSION['myFriends']=serialize($this->_objFriend);
        $_SESSION['request']='result';
    }
    
}
$obj=new MyFriend();
$obj->start($_SESSION['request']);



?>