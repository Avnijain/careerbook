<?php

/**
 * @author  Mohit K. Singh
 * @access Public
 */
ini_set("display_errors", "1");
require_once 'singleton.php';

abstract class model {

	protected $db = "";

	function __construct() {
		$this->db = DBConnection::Connect();
	}

}

class MyClass extends model {

	public function FindUsers() {

		$this->db->Where(array("(first_name = '".$_POST['firstname']."' AND
				middle_name = '".$_POST['middlename']."' AND
				last_name = '".$_POST['lastname']."' AND
				date_of_birth = '".$_POST['dob']."') OR email_primary = '".$_POST['email']."'"),true);
		$this->db->From("users");

	 $this->db->Select();
	 return $this->db->resultArray();
	 /*echo $this->db->lastQuery();
	  $result = $this->db->resultArray();
	 echo "<pre/>";
	 print_r($result);*/
	}
	/* Start *********************************************** Professional Information Manipulation ************************************/
	public function insertIntoUserProfessional($userInfo) {
		$objProfessionalInfo = $userInfo->getUserProfessionalInfo();
		$user_id = $userInfo->getUserIdInfo();
		$objProfessionalInfo['user_id'] = $user_id['id'];

		//	  	print_r($objProfessionalInfo);  // For Testing Display Array Data

		$this->db->Fields($objProfessionalInfo);
		$this->db->From("user_professional_info");
		$this->db->Insert();
		//		echo $this->db->lastQuery();
	}
	public function updateUserProfessional($userInfo) {
		$objProfessionalInfo = $userInfo->getUserProfessionalInfo();
		$user_id = $userInfo->getUserIdInfo();

		//	  	print_r($objProfessionalInfo);  // For Testing Display Array Data

		$this->db->Fields($objProfessionalInfo);
		$this->db->From("user_professional_info");
		$this->db->Where(array("user_id"=>$user_id['id']));
		$this->db->Update();
		//	  	echo $this->db->lastQuery();
	}
	public function fetchUserProfessionalInfo($userInfo){
		$user_id = $userInfo->getUserIdInfo();
		$this->db->From("user_professional_info");
		$this->db->Where(array("user_id"=>$user_id['id']));
		$this->db->Select();
		//		echo $this->db->lastQuery();
		return $this->db->resultArray();
	}
	/* Start *********************************************** Project Information Manipulation ************************************/
	public function fetchUserProjectInfo($userInfo){
	    $user_id = $userInfo->getUserIdInfo();
	    $this->db->From("user_project_info");
	    $this->db->Where(array("user_id"=>$user_id['id']));
	    $this->db->Select();
	    //		echo $this->db->lastQuery();
	    return $this->db->resultArray();	    
	}
	public function insertIntoUserProject($userInfo) {
	    $objProjectInfo = $userInfo->getUserProjectInfo();
	    $user_id = $userInfo->getUserIdInfo();
	    foreach($objProjectInfo as $key => $value){

	        $value['user_id'] = $user_id['id'];
// 	        echo "<pre/>";
// 	        print_r($value);
// 	        die;	        
	        //	  	print_r($objProfessionalInfo);  // For Testing Display Array Data
	        
	        $this->db->Fields($value);
	        $this->db->From("user_project_info");
	        $this->db->Insert();
//	        echo $this->db->lastQuery();
	    }
	        
// 	    $objProjectInfo['user_id'] = $user_id['id'];
	
// 	    //	  	print_r($objProfessionalInfo);  // For Testing Display Array Data
	
// 	    $this->db->Fields($objProjectInfo);
// 	    $this->db->From("user_academic_info");
// 	    $this->db->Insert();
// 		echo $this->db->lastQuery();
// 		die;
	}
	/* Start *********************************************** Address Information Manipulation ************************************/
	public function fetchUserAddressInfo($userInfo){
		$this->db->From("user_personal_info");
		$user_id = $userInfo->getUserIdInfo();

		$this->db->Where(array("user_id"=>$user_id['id']));
		$this->db->Select();
//		echo $this->db->lastQuery();
		return $this->db->resultArray();
	}
	public function fetchFullUserAddressInfo($userInfo){
		$this->db->From("user_personal_info upersnli");
		$user_id = $userInfo->getUserIdInfo();
		
		$this->db->Fields(array('address','cty.name city_name'));

		$this->db->Where(array("user_id"=>$user_id['id']));
		$this->db->Join("city cty", "cty.id = upersnli.city_id ", $type="INNER");
		$this->db->Select();
		
//  		echo $this->db->lastQuery();
//  		print_r ($this->db->resultArray());		
//  		die;
		return $this->db->resultArray();
	}
	public function insertIntoUserAddress($userInfo){
		$objAddressInfo = $userInfo->getUserAddressInfo();
		if(isset($objAddressInfo['city_name'])){
		    $city_id = $this->getCityIdInfo($objAddressInfo['city_name']);
		}
		$user_id = $userInfo->getUserIdInfo();

		if(isset($objAddressInfo['address'])){
		$finalInfo = array("user_id"=>$user_id['id'],
				"address"=>$objAddressInfo['address'],
				"city_id"=>$city_id[0]['id']
		);
		}

		//		print_r($finalInfo);

		if(isset($finalInfo)){
		$this->db->Fields($finalInfo);
		$this->db->From("user_personal_info");
		$this->db->Insert();
		}
//		echo $this->db->lastQuery();
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
	
	
	public function updateUserAddress($userInfo) {
		$objAddressInfo = $userInfo->getUserAddressInfo();
		$city_id = $this->getCityIdInfo($objAddressInfo['city_name']);
		$user_id = $userInfo->getUserIdInfo();

		$finalInfo = array("user_id"=>$user_id['id'],
				"address"=>$objAddressInfo['address'],
				"city_id"=>$city_id[0]['id']
		);
		//	  	print_r($objProfessionalInfo);  // For Testing Display Array Data

		$this->db->Fields($finalInfo);
		$this->db->From("user_personal_info");
		$this->db->Where(array("user_id"=>$user_id['id']));
		$this->db->Update();
//	  	echo $this->db->lastQuery();
	}	
	private function getCityIdInfo($cityName){
		$this->db->From("city");
		$this->db->Where(array("name"=>$cityName));
		$this->db->Select();
		//		echo $this->db->lastQuery();
		return $this->db->resultArray();
	}
	private function getStateIdInfo($stateName){
		$this->db->From("state");
		$this->db->Where(array("name"=>$stateName));
		$this->db->Select();
		//		echo $this->db->lastQuery();
		return $this->db->resultArray();
	}
	/* End *********************************************** Address Information Manipulation ************************************/
	/* Start *********************************************** Academic Information Manipulation ************************************/
	public function fetchUserAcademicInfo($userInfo){
	    $this->db->From("user_academic_info");
	    $user_id = $userInfo->getUserIdInfo();
	
	    $this->db->Where(array("user_id"=>$user_id['id']));
	    $this->db->Select();
//	    echo $this->db->lastQuery();
	    return $this->db->resultArray();
	}
	public function insertIntoUserAcademic($userInfo){
		$objAcademicInfo = $userInfo->getUserAcademicInfo();
		$user_id = $userInfo->getUserIdInfo();
		$objAcademicInfo['user_id'] = $user_id['id'];

		//	  	print_r($objProfessionalInfo);  // For Testing Display Array Data

		$this->db->Fields($objAcademicInfo);
		$this->db->From("user_academic_info");
		$this->db->Insert();
//		echo $this->db->lastQuery();
	}
	public function updateUserAcademic($userInfo) {
		$objAcademicInfo = $userInfo->getUserAcademicInfo();
		$user_id = $userInfo->getUserIdInfo();

		//	  	print_r($objProfessionalInfo);  // For Testing Display Array Data

		$this->db->Fields($objAcademicInfo);
		$this->db->From("user_academic_info");
		$this->db->Where(array("user_id"=>$user_id['id']));
		$this->db->Update();
//	    echo $this->db->lastQuery();
//	    die;
	}
	/* End *********************************************** Address Information Manipulation ************************************/
	/* Start *********************************************** Personal Information Manipulation ************************************/
	public function fetchUserPersonalInfo($userInfo){
		$this->db->From("users");
		$user_id = $userInfo->getUserIdInfo();
	
		$this->db->Where(array("id"=>$user_id['id']));
		$this->db->Select();
		//	    echo $this->db->lastQuery();
		return $this->db->resultArray();
	}
	public function updateUserPersonal($userInfo) {
		$objPersonalInfo = $userInfo->getUserPersonalInfo();
		$user_id = $userInfo->getUserIdInfo();
	
		//	  	print_r($objProfessionalInfo);  // For Testing Display Array Data
	
		$this->db->Fields($objPersonalInfo);
		$this->db->From("users");
		$this->db->Where(array("id"=>$user_id['id']));
		$this->db->Update();
		//	    echo $this->db->lastQuery();
		//	    die;
	}
	/* End *********************************************** Address Information Manipulation ************************************/
	/* Start *********************************************** User Image Information Manipulation ************************************/
	public function insertIntoUserImage($userInfo){
		$objImageInfo = $userInfo->getImageInfo();
		$user_id = $userInfo->getUserIdInfo();
		$objImageInfo['user_id'] = $user_id['id'];
		
		//	  	print_r($objProfessionalInfo);  // For Testing Display Array Data
		
		$this->db->Fields($objImageInfo);
		$this->db->From("user_personal_info");
		$this->db->Insert() or die(mysql_error());
//		echo $this->db->lastQuery();
//		die;
	}
	public function updateIntoUserImage($userInfo){
		$objImageInfo = $userInfo->getImageInfo();
		$user_id = $userInfo->getUserIdInfo();
		
		//	  	print_r($objProfessionalInfo);  // For Testing Display Array Data
		
		$this->db->Fields($objImageInfo);
		$this->db->From("user_personal_info");
		$this->db->Where(array("user_id"=>$user_id['id']));
		$this->db->Update();
//	    echo $this->db->lastQuery();
//	    die;
	}	
	/* End *********************************************** User Image Information Manipulation ************************************/
	public function FindLoginUsers() {

	 //$this->db->Fields(array("email_primary","password"));
		$this->db->From("users");
		$this->db->Where(array("email_primary"=>$_POST['userid']));

	 $this->db->Select();
	 return $this->db->resultArray();
	 /*echo $this->db->lastQuery();
	  $result = $this->db->resultArray();
	 echo "<pre/>";
	 print_r($result);*/
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

		$this->db->Fields(array("first_name"=>$_POST['first_name'],
				"middle_name"=>$_POST['middle_name'],
				"last_name"=>$_POST['last_name'],
				"date_of_birth"=>$_POST['date_of_birth'],
				"email_primary"=>$_POST['email_primary'],
				" phone_no"=>$_POST['phone_no'],
				" gender"=>$_POST['gender'],
				"profile_image"=>$imageData,
				"password"=>md5("12345"),
				"created_on"=>date('Y-m-d h:i:s', time())));
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
	public function DeleteUser(){
		$this->db->From("users");
		$this->db->Where(array("id"=>42));
		$this->db->Delete();
//		echo $this->db->lastQuery();
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

