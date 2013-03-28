<?php
/*
**************************** Creation Log *******************************
File Name                   -  userpersonalinfo.php
Project Name                -  Careerbook
Description                 -  Controller Class file for users information
Version                     -  1.0
Created by                  -  Prateek Saini
Created on                  -  March 05, 2013
***************************** Update Log ********************************
Sr.NO.		Version		Updated by           Updated on          Description
-------------------------------------------------------------------------
*************************************************************************
*/
//include_once('../classes/');


/* 
 * Following class will create the user information objects and control the data flow.
 * All the ojects here created corresponds to class in user.php file 
 * */

require_once '../Model/model.php';

function __autoload($className)
{
	require('../classes/'.$className.'.php');
}

class user_info_controller
{
	private $objPersonalInfo;
	private $objProfessionalInfo;
	private $objAcademicInfo;
	private $objIdentityInfo;	
	private	 $ObjModel;
	private $objAddressInfo;
	private $objImageInfo;
	private $objProjectInfo;
	private $projectCountDB;
	private $projectCountForm;

	public function __construct()
	{
		$this->objPersonalInfo = new UserPersonalInfo();
		$this->objProfessionalInfo = new UserProfessionalInfo();
		$this->objIdentityInfo = new userIdentityInfo();
		$this->ObjModel = new MyClass ();
		$this->objAddressInfo = new UserAddressInfo();
		$this->objAcademicInfo = new UserAcademicInfo();
		$this->objImageInfo = new UserImageInfo();
		$this->objProjectInfo[] = new UserProjectInfo();
	}
/*******************************************************************************************/
	public function setUserPersonalInfoForm($result){
		$this->objPersonalInfo->setinfo($result);
		$resultDB = $this->ObjModel->fetchUserPersonalInfo($this);
// 		echo "<pre/>";
// 		print_r($resultDB);
// 		die;
		
		if(count($resultDB) > 0 ){
			$this->ObjModel->updateUserPersonal($this);
		}
	}
	public function setUserPersonalInfo($result)
	{
		$this->objPersonalInfo->setinfo($result);
//		$this->obj->getdefinedvars();
// 		echo "<pre/>";
// 		print_r ($result);
	}
	public function setUserPersonalInfoDb(){
		$result = $this->ObjModel->fetchUserPersonalInfo($this);
		if(count($result) > 0 ){
			$this->objPersonalInfo->setinfo($result);
			return true;
		}
		return false;
	}	
	public function getUserPersonalInfo()
	{
		//		print($varname);
		return $this->objPersonalInfo->getinfo();
	}
	public function getUserPersonalInfoDB()
	{
		$flag = $this->setUserPersonalInfoDb();
		return $this->objPersonalInfo->getInfo();
	}
/*******************************************************************************************/	
	public function setUserImageInfoForm($result){
		$this->objImageInfo->addImage($result);
		$resultDB = $this->ObjModel->fetchUserAddressInfo($this);
		
		if(count($resultDB) > 0 ){
			$this->ObjModel->updateIntoUserImage($this);
		}
		else{
			$this->ObjModel->insertIntoUserImage($this);
		}		
	}
	public function getImageInfo(){
		return $this->objImageInfo->getInfo();
	}
/*******************************************************************************************/
	public function setUserAddressInfoForm($result){
		$this->objAddressInfo->setinfo($result);		
		$resultDB = $this->ObjModel->fetchUserAddressInfo($this);		

		if(count($resultDB) > 0 ){
			$this->ObjModel->updateUserAddress($this);
		}
		else{
			$this->ObjModel->insertIntoUserAddress($this);
		}
	}
	public function setUserAddressInfoDb(){
		$result = $this->ObjModel->fetchFullUserAddressInfo($this);
		if(count($result) > 0 ){
			$this->objAddressInfo->setinfo($result);
			return true;
		}
		return false;
	}
	public function getUserAddressInfo()
	{
		return $this->objAddressInfo->getInfo();
	}
	public function getUserAddressInfoDB()
	{
	    $flag = $this->setUserAddressInfoDb();
	    return $this->objAddressInfo->getInfo($flag);
	}
/*******************************************************************************************/
	public function setUserAcademicInfoForm($result){
	    $this->objAcademicInfo->setinfo($result);
	    $resultDB = $this->ObjModel->fetchUserAcademicInfo($this);
	    
	    if(count($resultDB) > 0 ){
	        $this->ObjModel->updateUserAcademic($this);
	    }
	    else{
	        $this->ObjModel->insertIntoUserAcademic($this) or die(mysql_error());
	    }	    
	}
// 	private function serializedata($userInfo){
// 		session_start();
// 		$_SESSION['userData'] = serialize($userInfo);
// 	}
	public function setUserAcademicInfoDb(){
		$result = $this->ObjModel->fetchUserAcademicInfo($this);	
		if(count($result) > 0 ){
			$this->objAcademicInfo->setinfo($result);
			return true;
		}
		return false;
	}
	public function getUserAcademicInfo()
	{
	    return $this->objAcademicInfo->getInfo();
	}
	public function getUserAcademicInfoDB()
	{
	    $flag = $this->setUserAcademicInfoDb();
	    return $this->objAcademicInfo->getInfo($flag);
	}
/*******************************************************************************************/	
	public function setUserProjectInfoForm($result){
// 	    echo "<pre/>";
// 	    print_r($result);
// 	    die;

	    $this->setDatainProject($result);

// 	    print_r($this->objProjectInfo[0]->getinfo());
// 	    die;
// 	    $this->objAcademicInfo->setinfo($result);
	    
//	    $resultDB = $this->ObjModel->fetchUserProjectInfo($this);
	     
//	    if(count($resultDB) > 0 ){
//	        $this->ObjModel->updateUserAcademic($this);
//	    }
//	    else{

//        for($i = 0; $i < $maxProjct ; $i++){

//	    if(isset($this->projectCountForm) && isset($this->projectCountDB)){
	     $nwProject = intval($this->projectCountForm) - intval($this->projectCountDB);
//	    }
// 	    print($this->projectCountForm);
// 	    print($this->projectCountDB);
// 	    print("New Projects " . $nwProject);
// 	    die;

	    if($this->projectCountDB > 0 ){
	        $this->ObjModel->updateUserProject($this,$this->projectCountDB);
	    }
//	    else{
        if($nwProject > 0){
	        $this->ObjModel->insertIntoUserProject($this,$this->projectCountDB,$this->projectCountForm);
        }
//        }
//	    }	    
	}
	private function setDatainProject($result){	    
	    $tempuserProjectInfo = array(array("title"=>"","description"=>"","technology"=>"","duration"=>""));
	    $count  = 0;
	    $maxProjct = 0;
	    foreach($result[0] as $key => $value){
	        foreach ($value as $inkey => $invalue){
	            if(!empty($inkey))
	              $maxProjct++;
	        }
	        break;
	    }
	    //         print($maxProjct);
	    //         die;
	    for($i = 0; $i < $maxProjct ; $i++){
	        foreach($result[0] as $key => $value){
	            $id = $key;
	            //print($id);
	            //	        foreach ($key as $inkey => $invalue){
	            $tempuserProjectInfo[0][$id] = $result[0][$id][$i];
	    
	            //	        }
	            }
	            $this->objProjectInfo[$i]->setinfo($tempuserProjectInfo);
	            if($i+1 == $maxProjct){
	                break;
	            }
	            if(!isset($this->objProjectInfo[$i+1])){
	                $this->objProjectInfo[] = new UserProjectInfo();
	            }            
	        }
	        $this->projectCountForm = $maxProjct;
	        if(isset($this->projectCountDB)){
	            if(empty($this->projectCountDB)){
	                $this->projectCountDB = 0;
	            }
	        }
// 	        print($this->projectCountForm);
// 	        print($this->projectCountDB);
// 	        die;

	}
	private function setDatainProjectDB($result){
	    $tempuserProjectInfo = array(array("title"=>"","description"=>"","technology"=>"","duration"=>""));
	    $count  = 0;
	    $maxProjct = 0;
	    foreach($result as $key => $value){
//	        foreach ($value as $inkey => $invalue){
	            $maxProjct++;
//	        }
//	        break;
	    }
	    //         print($maxProjct);
	    //         die;
//	    for($i = 0; $i < $maxProjct ; $i++){
	        foreach($result as $key => $value){
	            $i = $key;
	            foreach($value as $inkey => $invalue){
	            $id = $inkey;
	            //print($id);
	            //	        foreach ($key as $inkey => $invalue){
	            $tempuserProjectInfo[0][$id] = $result[$i][$id];
	             
	            //	        }
	            }
	            $this->objProjectInfo[$i]->setinfo($tempuserProjectInfo);
	            if($i+1 == $maxProjct){
	                break;
	            }
	        	            if($i+1 == $maxProjct){
	                break;
	            }
	            if(!isset($this->objProjectInfo[$i+1])){
	                $this->objProjectInfo[] = new UserProjectInfo();
	            }
	        }
//	    }

	        $this->projectCountDB = $maxProjct;
//  	        print($this->projectCountDB);
// 	    	    echo "<pre/>";
// 	    	    print_r($this->objProjectInfo);
// 	    	    die;
	}
	public function getUserProjectInfo($flag = "true")
	{
	    $allproject = array();
	    foreach ($this->objProjectInfo as $key => $value){
	        $allproject[] = $this->objProjectInfo[$key]->getinfo($flag); 
	    }
	    
// 	    echo "<pre/>";
// 	    print_r($allproject);
// 	    die;
	    return $allproject;
	}
	public function getUserProjectInfoDB()
	{
	    $flag = $this->setUserProjectInfoDb();
	    return $this->getUserProjectInfo($flag);
	}	
	public function setUserProjectInfoDb(){
	    $result = $this->ObjModel->fetchUserProjectInfo($this);
	     
	    if(count($result) > 0 ){
	        $this->setDatainProjectDB($result);
	        return true;
	    }
	    unset($this->objProjectInfo);
	    $this->objProjectInfo[] = new UserProjectInfo();
	    $this->projectCountDB = 0;
	    return false;
	}
/*******************************************************************************************/		
	public function setUserProfessionalInfoForm($result){
		$this->objProfessionalInfo->setinfo($result);
		$resultDB = $this->ObjModel->fetchUserProfessionalInfo($this);
		
		if(count($resultDB) > 0 ){
			$this->ObjModel->updateUserProfessional($this);
		}
		else{
			$this->ObjModel->insertIntoUserProfessional($this);
		}
		//$result=$ObjModel->insertIntoUserProfessional($userInfo);
		//print_r($this->objIdentityInfo->getinfo());
		//		$this->obj->getdefinedvars();
		// 		echo "<pre/>";
		// 		print_r ($result);
		
	}
	public function setUserProfessionalInfoDb(){
		$result = $this->ObjModel->fetchUserProfessionalInfo($this);
		if(count($result) > 0 ){
			$this->objProfessionalInfo->setinfo($result);
			return true;
		}
		return false;
	}
	public function getUserProfessionalInfo()
	{
		return $this->objProfessionalInfo->getinfo();
	}	
	public function getUserProfessionalInfoDB()
	{
	    $flag = $this->setUserProfessionalInfoDb();
	    return $this->objProfessionalInfo->getinfo($flag);
	}
/*******************************************************************************************/
	public function setUserIdInfo($result){
		$this->objIdentityInfo->setinfo($result);
	}
	public function getUserIdInfo(){
		return $this->objIdentityInfo->getinfo();
	}	
/*******************************************************************************************/	
}

$objUserInfo = new user_info_controller;
// $obj->getuserinfo();

?>
