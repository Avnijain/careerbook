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
function __autoload($className)
{
    if( strstr($className, "Model")){
        require('../Model/'.$className.'.php');
    }
    else if($className == "UserDataValidation"){
        require('../Model/validation.php');
    }
    else{
        require('../classes/'.$className.'.php');
    }
	
}

class user_info_controller
{
	private $objPersonalInfo;
	private $objProfessionalInfo;
	private $objAcademicInfo;
	private $objIdentityInfo;	
	private	 $ObjUserModel;
	private $objAddressInfo;
	private $objProjectInfo;
	private $projectCountDB;
	private $projectCountForm;
	private $certificateCountDB;
	private $certificateCountForm;	
	private $extraCurricularCountDB;
	private $extraCurricularCountForm;		
	private $objPreviousJobInfo;
	private $objCertificateInfo;
	private $objExtraCurricularInfo;
	private $objValidation;

	public function __construct()
	{
	    $this->objValidation = new UserDataValidation();
		$this->objPersonalInfo = new UserPersonalInfo();
		$this->objProfessionalInfo = new UserProfessionalInfo();
		$this->objIdentityInfo = new userIdentityInfo();
		$this->ObjUserModel = new UserInfoModel ();
		$this->objAddressInfo = new UserAddressInfo();
		$this->objAcademicInfo = new UserAcademicInfo();		
		$this->objProjectInfo[] = new UserProjectInfo();
		$this->objPreviousJobInfo = new UserPreviousJobInfo();
		$this->objCertificateInfo[] = new UserCertificationInfo();
		$this->objExtraCurricularInfo[] = new UserExtraCurricularInfo();
	}
/*************************************** User Personal Information ****************************************************/
	public function setUserPersonalInfoForm($result){
		$this->objPersonalInfo->setinfo($result);
		
		$error = $this->objValidation->validate($this->objPersonalInfo->getinfo());
		if($error != 0 ){
		    return $error;
		}
		$resultDB = $this->ObjUserModel->fetchUserPersonalInfo($this);
// 		echo "<pre/>";
// 		print_r($resultDB);
// 		die;
		if(count($resultDB) > 0 ){
			$this->ObjUserModel->updateUserPersonal($this);
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
		$result = $this->ObjUserModel->fetchUserPersonalInfo($this);
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
/*************************************** User Profile Image  ****************************************************/	
	public function setUserImageInfoForm($result){
		$this->objPersonalInfo->addImage($result);
		$resultDB = $this->ObjUserModel->fetchUserPersonalInfo($this);
		
		if(count($resultDB) > 0 ){
			$this->ObjUserModel->updateIntoUserImage($this);
		}
		else{
		    //This will never be called
			//$this->ObjUserModel->insertIntoUserImage($this);
		}		
	}
	public function getImageInfo(){
		return $this->objPersonalInfo->getInfo();
	}
/**************************************** User Address Information ***************************************************/
	public function setUserAddressInfoForm($result){
		$this->objAddressInfo->setinfo($result);		
		$resultDB = $this->ObjUserModel->fetchUserAddressInfo($this);
		if(count($resultDB) > 0 ){
			$this->ObjUserModel->updateUserAddress($this);
		}
		else{
			$this->ObjUserModel->insertIntoUserAddress($this);
		}
	}
	public function setUserAddressInfoDb(){
		$result = $this->ObjUserModel->fetchFullUserAddressInfo($this);
//		print_r($result);
//		die;
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
/***************************************** User Academic Information **************************************************/
	public function setUserAcademicInfoForm($result){
	    $this->objAcademicInfo->setinfo($result);
	    $resultDB = $this->ObjUserModel->fetchUserAcademicInfo($this);
	    
	    if(count($resultDB) > 0 ){
	        $this->ObjUserModel->updateUserAcademic($this);
	    }
	    else{
	        $this->ObjUserModel->insertIntoUserAcademic($this) or die(mysql_error());
	    }	    
	}
// 	private function serializedata($userInfo){
// 		session_start();
// 		$_SESSION['userData'] = serialize($userInfo);
// 	}
	public function setUserAcademicInfoDb(){
		$result = $this->ObjUserModel->fetchUserAcademicInfo($this);	
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
/***************************************** User Certificate Information **************************************************/
	public function setUserCertificateInfoForm($result){
	    
	    $this->setDatainCertificate($result);
	    
	    $nwProject = intval($this->certificateCountForm) - intval($this->certificateCountDB);
//	    }
	    if($this->certificateCountDB > 0 ){
	        $this->ObjUserModel->updateUserCertificateInfo($this,$this->certificateCountDB);
	    }

        if($nwProject > 0){
	        $this->ObjUserModel->insertIntoUserCertificateInfo($this,$this->certificateCountDB,$this->certificateCountForm);
        }
	}
	private function setDatainCertificate($result){
	    $this->setDatainFormsArray($result, $this->objCertificateInfo,
	    	    	    array(array("name"=>"","description"=>"","duration"=>"")),
	    	    	    $this->certificateCountForm,
	    	    	    $this->certificateCountDB
	    	    	    );
	}
	private function setDatainCertificateDB($result){
	    $this->setDatainDBArray($result, 
                                $this->objCertificateInfo,
    	    	                array(array("name"=>"","description"=>"","duration"=>"","id"=>"")),	    	    	    
    	    	                $this->certificateCountDB
	    	    	           );
	}	
	public function setUserCertificateInfoDb(){
	    unset($this->objCertificateInfo);
	    $this->objCertificateInfo[] = new UserCertificationInfo();
	    $this->certificateCountDB = 0;	    
		$result = $this->ObjUserModel->fetchUserCertificateInfo($this);
		if(count($result) > 0 ){
			$this->setDatainCertificateDB($result);
			return true;
		}
		return false;
	}
	public function getUserCertificateInfo($flag = "true")
	{
	    $allproject = array();
	    foreach ($this->objCertificateInfo as $key => $value){
	        $allproject[] = $this->objCertificateInfo[$key]->getinfo($flag);
	    }
	    return $allproject;
	}
	public function getUserCertificateInfoDB()
	{
	    $flag = $this->setUserCertificateInfoDb();
	    return $this->getUserCertificateInfo($flag);
	}
	public function deleteUserCertificate($certificateID){
	    return $this->ObjUserModel->deleteUserCertificate($this,$certificateID);	    
	}
/************************* Generic Data in Forms and DB Inertion Function for Array Objects ******************/	
	private function setDatainFormsArray($result, &$ojbtoUpdate, $arrayFormat, &$countForm, &$countDB ){
	    $max = 0;
	    foreach($result[0] as $key => $value){
	        foreach ($value as $inkey => $invalue){
	            if(!empty($invalue))
	              $max++;
	        }
	        break;
	    }
//        print($max);
//        die;	    
	    for($i = 0; $i < $max ; $i++){
	        $tempArray = $arrayFormat;
	        foreach($result[0] as $key => $value){
	            $id = $key;
	            //print($id);
	            if(!empty($result[0][$id][$i])){
	                $tempArray[0][$id] = $result[0][$id][$i];
	            }
	            }
	            $ojbtoUpdate[$i]->setinfo($tempArray);
	            if($i+1 == $max){
	                break;
	            }
	            if(!isset($ojbtoUpdate[$i+1])){
	                if(get_class($ojbtoUpdate[0])){
	                    $tmpClass = get_class($ojbtoUpdate[0]);
	                    $ojbtoUpdate[] = new $tmpClass; 
	                }
	                //UserCertificationInfo();
	            }            
	        }
	        $countForm = $max;
	        if(isset($countDB)){
	            if(empty($countDB)){
	                $countDB = 0;
	            }
	        }
//echo "<pre/>";
//print_r($ojbtoUpdate);
//print($countForm);
//print($countDB);
//die;	    
	}
	private function setDatainDBArray($result, &$ojbtoUpdate, $arrayFormat, &$countDB ){
	    $max = 0;
	    foreach($result as $key => $value){
	        $max++;
	    }
//        print($max);
//        die;
//        echo "<pre/>";
//        print_r($ojbtoUpdate);
//        die;
        foreach($result as $key => $value){
            $i = $key;
            $tempuser = $arrayFormat;
            foreach($value as $inkey => $invalue){
            $id = $inkey;
            //print($id);
            //foreach ($key as $inkey => $invalue){
            $tempuser[0][$id] = $result[$i][$id];
             
            //}
            }
            $ojbtoUpdate[$i]->setinfo($tempuser);
            if($i+1 == $max){
                break;
            }
            if(!isset($ojbtoUpdate[$i+1])){
                if(get_class($ojbtoUpdate[0])){
                    $tmpClass = get_class($ojbtoUpdate[0]);
                    $ojbtoUpdate[] = new $tmpClass;
                }
            }
        }
        $countDB = $max;
//print($countDB);
//echo "<pre/>";
//print_r($ojbtoUpdate);
//die;
	}	

/***************************************** User Extra Curricular Information **************************************************/
	public function setUserExtraCurricularInfoForm($result){
	    
	    $this->setDatainExtraCurricular($result);
	    
	    $nwProject = intval($this->extraCurricularCountForm) - intval($this->extraCurricularCountDB);
//	    }
	    if($this->extraCurricularCountDB > 0 ){
	        $this->ObjUserModel->updateUserExtraCurricularInfo($this,$this->extraCurricularCountDB);
	    }

        if($nwProject > 0){
	        $this->ObjUserModel->insertIntoUserExtraCurricularInfo($this,$this->extraCurricularCountDB,$this->extraCurricularCountForm);
        }
	}
	private function setDatainExtraCurricular($result){
	    $this->setDatainFormsArray($result, 
	                               $this->objExtraCurricularInfo, 
	                               array(array("name"=>"")), 
	                               $this->extraCurricularCountForm, 
	                               $this->extraCurricularCountDB
	                               );
// 	    echo "<pre/>";
// 	    print_r($this->objExtraCurricularInfo);
// 	    print($this->extraCurricularCountForm);
// 	    print($this->extraCurricularCountDB);
// 	    die;
	}
	public function setUserExtraCurricularInfoDb(){
	    unset($this->objExtraCurricularInfo);
	    $this->objExtraCurricularInfo[] = new UserExtraCurricularInfo();
	    $this->extraCurricularCountDB = 0;
		$result = $this->ObjUserModel->fetchUserExtraCurricularInfo($this);
		if(count($result) > 0 ){
			$this->setDatainExtraCurricularDB($result);
			return true;
		}
		return false;
	}
	private function setDatainExtraCurricularDB($result){
	    $this->setDatainDBArray($result, 
	                            $this->objExtraCurricularInfo, 
	                            array(array("name"=>"")),	                                
	                            $this->extraCurricularCountDB
	                           );
	}
	public function getUserExtraCurricularInfo($flag = "true")
	{
	    $allproject = array();
	    foreach ($this->objExtraCurricularInfo as $key => $value){
	        $allproject[] = $this->objExtraCurricularInfo[$key]->getinfo($flag);
	    }
	    return $allproject;
	}
	public function getUserExtraCurricularInfoDB()
	{
	    $flag = $this->setUserExtraCurricularInfoDb();
	    return $this->getUserExtraCurricularInfo($flag);
	}	
	public function deleteUserExtraCurricular($extraCurricularID){
	    return $this->ObjUserModel->deleteUserExtraCurricular($this,$extraCurricularID);	    
	}
/***************************************** User Project Information **************************************************/	
	public function setUserProjectInfoForm($result){
// 	    echo "<pre/>";
// 	    print_r($result);
// 	    die;
	    $this->setDatainProject($result);
//	    if(isset($this->projectCountForm) && isset($this->projectCountDB)){
	     $nwProject = intval($this->projectCountForm) - intval($this->projectCountDB);
//	    }
	    if($this->projectCountDB > 0 ){
	        $this->ObjUserModel->updateUserProject($this,$this->projectCountDB);
	    }

        if($nwProject > 0){
	        $this->ObjUserModel->insertIntoUserProject($this,$this->projectCountDB,$this->projectCountForm);
        }
	}
	private function setDatainProject($result){
	    $this->setDatainFormsArray($result, $this->objProjectInfo,
	                  array(array("title"=>"","description"=>"","technology"=>"","duration"=>"")),
	                  $this->projectCountForm,
	                  $this->projectCountDB 
	                  );
	}
	private function setDatainProjectDB($result){	    
	    $this->setDatainDBArray($result, $this->objProjectInfo,
	                  array(array("title"=>"","description"=>"","technology"=>"","duration"=>"","id"=>"")),	                  
	                  $this->projectCountDB 
	                  );
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
	    unset($this->objProjectInfo);
	    $this->objProjectInfo[] = new UserProjectInfo();
	    $this->projectCountDB = 0;	    
	    $result = $this->ObjUserModel->fetchUserProjectInfo($this);
	    if(count($result) > 0 ){
	        $this->setDatainProjectDB($result);
	        return true;
	    }
	    return false;
	}
	public function deleteUserProject($projectID){
	    return $this->ObjUserModel->deleteUserProject($this,$projectID);	    
	}
/***************************************** User Professional Information **************************************************/		
	public function setUserProfessionalInfoForm($result){
		$this->objProfessionalInfo->setinfo($result);
		$resultDB = $this->ObjUserModel->fetchUserProfessionalInfo($this);
		
		if(count($resultDB) > 0 ){
			$this->ObjUserModel->updateUserProfessional($this);
		}
		else{
			$this->ObjUserModel->insertIntoUserProfessional($this);
		}
		//$result=$ObjUserModel->insertIntoUserProfessional($userInfo);
		//print_r($this->objIdentityInfo->getinfo());
		//		$this->obj->getdefinedvars();
//		echo "<pre/>";
// 		print_r ($result);
// 		die;
	}
	public function setUserProfessionalInfoDb(){
		$result = $this->ObjUserModel->fetchUserProfessionalInfo($this);
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
/************************************** User Previous Job Information *****************************************************/
	public function setUserPreviousJobInfoForm($result){
		$this->objPreviousJobInfo->setinfo($result);
		$resultDB = $this->ObjUserModel->fetchUserPreviousJobInfo($this);
		
		if(count($resultDB) > 0 ){
			$this->ObjUserModel->updateUserPreviousJobInfo($this);
		}
		else{
			$this->ObjUserModel->insertIntoUserPreviousJobInfo($this);
		}
		//$result=$ObjUserModel->insertIntoUserProfessional($userInfo);
		//print_r($this->objIdentityInfo->getinfo());
		//		$this->obj->getdefinedvars();
		// 		echo "<pre/>";
		// 		print_r ($result);
		
	}
	public function setUserPreviousJobInfoDb(){
		$result = $this->ObjUserModel->fetchUserPreviousJobInfo($this);
		if(count($result) > 0 ){
			$this->objPreviousJobInfo->setinfo($result);
			return true;
		}
		return false;
	}
	public function getUserPreviousJobInfo()
	{
		return $this->objPreviousJobInfo->getinfo();
	}	
	public function getUserPreviousJobInfoDB()
	{
	    $flag = $this->setUserPreviousJobInfoDb();
	    return $this->objPreviousJobInfo->getinfo($flag);
	}
/************************************** User Id Info *****************************************************/
	public function setUserIdInfo($result){
		$this->objIdentityInfo->setinfo($result);
	}
	public function getUserIdInfo(){
		return $this->objIdentityInfo->getinfo();
}	
/***************************************** END OF user_info_controller CLASS **************************************************/
}
$objUserInfo = new user_info_controller;
// $obj->getuserinfo();
?>