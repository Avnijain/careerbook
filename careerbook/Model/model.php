<?php

/**
 * @author  Mohit K. Singh
 * @access Public
 */
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
	  public function insertIntoUserProfessional() {
	  
		$this->db->Fields(array("skill_set"=>$_POST['first_name'],
					"current_position"=>$_POST['middle_name'],
					"current_company"=>$_POST['last_name'],
					"start_period"=>$_POST['date_of_birth']));
		$this->db->From("users");
		$this->db->Insert();
		echo $this->db->lastQuery();
	  }	  
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
		echo $this->db->lastQuery();
	}
	public function UpdateUser(){
	
		$this->db->Fields(array("first_name"=>$_POST['firstname']));
		$this->db->From("users");
		$this->db->Where(array("id"=>42));
		$this->db->Update();
		echo $this->db->lastQuery();
	}
	public function DeleteUser(){
		$this->db->From("users");
		$this->db->Where(array("id"=>42));
		$this->db->Delete();
		echo $this->db->lastQuery();
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

