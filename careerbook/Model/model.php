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
		
// 		echo $this->db->lastQuery();
// 		print_r ($this->db->resultArray());		
// 		die;
		return $this->db->resultArray();
	}
	public function insertIntoUserAddress($userInfo){
		$objAddressInfo = $userInfo->getUserAddressInfo();
		$city_id = $this->getCityIdInfo($objAddressInfo['city_name']);
		$user_id = $userInfo->getUserIdInfo();
		
		$finalInfo = array("user_id"=>$user_id['id'],
				"address"=>$objAddressInfo['address'],
				"city_id"=>$city_id[0]['id']
				);
		
//		print_r($finalInfo);
		
		$this->db->Fields($finalInfo);
		$this->db->From("user_personal_info");
		$this->db->Insert();
//		echo $this->db->lastQuery();
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
	    //	  	echo $this->db->lastQuery();
	}	
/* End *********************************************** Address Information Manipulation ************************************/	
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
	
		$this->db->Fields(array("first_name"=>$_POST['first_name'],
					"middle_name"=>$_POST['middle_name'],
					"last_name"=>$_POST['last_name'],
					"date_of_birth"=>$_POST['date_of_birth'],
					"email_primary"=>$_POST['email_primary'],
					" phone_no"=>$_POST['phone_no'],
					" gender"=>$_POST['gender'],
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

