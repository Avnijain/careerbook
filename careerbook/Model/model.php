<?php

/**
 * @author  Mohit K. Singh
 * @access Public
 */
ini_set("display_errors", "1");
require_once 'singleton.php';
require_once 'DbConnectionModelAbstract.php';


class MyClass extends model {

    public function FindUsers() {

        $this->db->Where(array("(first_name = '".$_POST['firstname']."' AND status='A' AND
				middle_name = '".$_POST['middlename']."' AND
				last_name = '".$_POST['lastname']."' AND
				date_of_birth = '".$_POST['dob']."') OR (email_primary = '".$_POST['email']."' AND (status='A' OR status='I'))"),true);
        $this->db->From("users");

        $this->db->Select();
        return $this->db->resultArray();

    }
    //**********************************************change forget user password******************************************
    public function frogetUserPasswdChg($userId,$newPasswd)
    {
       	$this->db->Fields(array("password"=>md5($newPasswd)));
    	$this->db->From("users");
    	$this->db->Where(array("id=".$userId),true);
    	$this->db->Update();
    }
    public function UpadteUserSattus($userId)
    {
    	$this->db->Fields(array("status"=>"A"));
    	$this->db->From("users");
    	$this->db->Where(array("id=".$userId),true);
    	$this->db->Update();
    }
    
    //****************************************************change user password***************************************************
    public function passwdChg($userInfo,$newPasswd)
    {
    	$user_id = $userInfo->getUserIdInfo();
    	$user_id=$user_id['id'];
    	$this->db->Fields(array("password"=>md5($newPasswd)));
    	$this->db->From("users");
    	$this->db->Where(array("id=".$user_id),true);
    	$this->db->Update();
    }
    //********************************************************get user password******************************************************
    public function getUserPwd($userInfo){
    	$user_id = $userInfo->getUserIdInfo();
    	$user_id=$user_id['id'];
    	$this->db->Fields(array("password"=>""));
    	$this->db->From("users");
    	$this->db->Where(array("id=".$user_id),true);
    	$this->db->Select();
    	return $this->db->resultArray();   	
    }



public function addNewFrnd($userInfo,$frndId)
{
    $user_id = $userInfo->getUserIdInfo();
    $user_id=$user_id['id'];
    //$user_id=17;
    $this->db->Fields(array("user_id"=>$user_id,"friend_id"=>$frndId,"status"=>"W"));
    $this->db->From("friends");
    $this->db->Insert();
    $this->db->unsetValues();
    $this->db->Fields(array("user_id"=>$frndId,"friend_id"=>$user_id,"status"=>"R"));
    $this->db->From("friends");
    $this->db->Insert();
    	
    	
}

public function delMyFrnd($userInfo,$frndId)
{
    $user_id = $userInfo->getUserIdInfo();
    $user_id=$user_id['id'];
    $this->db->Fields(array("status"=>"D"));
    $this->db->From("friends");
    $this->db->Where(array("friend_id=".$frndId." AND user_id=".$user_id." AND (status='R' OR status='F')"),true);
    $this->db->Update();
    $this->db->unsetValues();
    $this->db->Fields(array("status"=>"D"));
    $this->db->From("friends");
    $this->db->Where(array("friend_id=".$user_id." AND user_id=".$frndId. " AND (status='W' OR status='F')"),true);
    $this->db->Update();
}
public function acceptNewFrnd($userInfo,$frndId)
{
    $user_id = $userInfo->getUserIdInfo();
    $user_id=$user_id['id'];
    //$user_id=17;
    $this->db->Fields(array("status"=>"F"));
    $this->db->From("friends");
    $this->db->Where(array("friend_id=".$frndId." AND user_id=".$user_id." AND status='R'"),true);
    $this->db->Update();
    $this->db->unsetValues();
    $this->db->Fields(array("status"=>"F"));
    $this->db->From("friends");
    $this->db->Where(array("friend_id=".$user_id." AND user_id=".$frndId. " AND status='W'"),true);
    $this->db->Update();
}

public function FindLoginUsers() {


    $this->db->From("users");
    $this->db->Where(array("email_primary='".$_POST['userid']."' AND (status='A' OR status='I')" ),true);
    $this->db->Select();
    return $this->db->resultArray();

}

public function AddUser(){

    if($_POST['gender']=='male'){
        $tmpName="../images/a6.jpg";
    }
    else{
        $tmpName="../images/a7.jpg";
    }
    $fp = fopen($tmpName, 'r');
    $imageData = fread($fp, filesize($tmpName));
    $imageData = addslashes($imageData);
    fclose($fp);
	
    $_SESSION['userDefaultPwd'] = rand(100000,999999);
    
    $this->db->Fields(array("first_name"=>$_POST['first_name'],
				"middle_name"=>$_POST['middle_name'],
				"last_name"=>$_POST['last_name'],
				"date_of_birth"=>$_POST['date_of_birth'],
				"email_primary"=>$_POST['email_primary'],
				" phone_no"=>$_POST['phone_no'],
				" gender"=>$_POST['gender'],
				"profile_image"=>$imageData,
    			"status"=>"I",
				"password"=>md5("12345"),  
				"created_on"=>date('Y-m-d h:i:s', time())));		//md5($_SESSION['userDefaultPwd']);
    $this->db->From("users");
    $this->db->Insert();
    //		echo $this->db->lastQuery();
}
public function UpdateUser(){

    $this->db->Fields(array("first_name"=>$_POST['firstname']));
    $this->db->From("users");
    $this->db->Where(array("id"=>42));
    $this->db->Update();
    //		echo $this->db->lastQuery();
}
public function DeleteUser($userInfo){
	
    	$user_id = $userInfo->getUserIdInfo();
    	$user_id=$user_id['id'];
    	$this->db->Fields(array("status"=>"D"));
    	$this->db->From("users");
    	$this->db->Where(array("id=".$user_id),true);
    	$this->db->Update();
}
public function startTransaction(){
    $this->db->startTransaction();
}
public function Commit(){
    $this->db->Commit();
}
public function Rollback(){
    $this->db->Rollback();
}

}

//$ObjModel = new MyClass();
//$obj->FindUsers();
//$obj->AddUser();
//$obj->UpdateUser();
//$obj->DeleteUser();
?>

