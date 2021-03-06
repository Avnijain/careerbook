<?php
// ******************************************************************************************************************************************************
// *
// @author:Mohit K.Singh
// Access: Public
//
// *******************************************************************************************************************************************************

class UserDataValidation {
	
	private $_intgerType;		//will store all integer fields
	private $_floatType;		//will store all float fields
	private $_stringType;		//will store all string fields
	private $_emailType;		//will store all email fields
	private $_imageType;		//will store all image fields
	private $_quotes;			//will store all quotes fields
	private $_wordLimit20;		//will store al feilds having word limit 20 char
	private $_wordLimit50;		//will store al feilds having word limit 50 char
	
	public function __construct() {
		$this->_intgerType = array (
				"phone_no" 
		);
		$this->_wordLimit20=array(
					"",
					""
				);
		$this->_wordLimit50=array(
				"",
				""
		);		
		$this->_floatType = array (
				"percentage_GPA_10",
				"percentage_12",
				"graduation_percentage",
				"post_graduation_percentage"
		);
		$this->_stringType = array (
				"first_name",
				"middle_name",
				"last_name",
				"title",
				"description",
				"group_discussion_description",
				"group_discussion_comment",
				"skill_set",
				"current_position",
				"current_company",
				"position",
				"company",
				"address",
				"city_name",
		        "country_name",
				"state_name",
				"board_10",
				"school_10",
				"board_12",
				"school_12",
				"graduation_degree",
				"graduation_specialization",
				"graduation_college",
				 "post_graduation_degree",
				"post_graduation_specialization",
				"post_graduation_college",
				"duration"
		);
		$this->_emailType = array (
				"email_primary",
				"email_secondary" 
		);
		$this->_imageType = array (
				"group_image" 
		);
		$this->_dateType = array (
				"date_of_birth",
				"start_period",
				"end_period" 
		);
		$this->_quotes = array (
				"first_name",
				"middle_name",
				"last_name",
				"email_primary",
				"title",
				"description",
				"group_discussion_description",
				"group_discussion_comment", 
				"search",
				"skill_set",
				"current_position",
				"current_company",
				"position",
				"company",
				"address",
				"city_name",
				"state_name",
		        "country_name",
				"board_10",
				"school_10",
				"board_12",
				"school_12",
				"graduation_degree",
				"graduation_specialization",
				"graduation_college",
				"post_graduation_degree",
				"post_graduation_specialization",
				"post_graduation_college",
				"duration"
		);
	}
	// *******************************************************Function to
	// validate User data
	// **************************************************************
	public function validate($userData) {
		foreach ( $userData as $keys => $values ) {
			if (in_array ( $keys, $this->_intgerType )) {
				$error = $this->validateInt ( $values );
				if ($error != 0) {
					break;
				}
			}
//			if (in_array ( $keys, $this->_dateType )) {
//				$error = $this->validateDate ( $values );
//				if ($error != 0) {
//					break;
//				}
//			}
			if (in_array ( $keys, $this->_floatType )) {
				$error = $this->validateFloat ( $values );
				if ($error != 0) {
					break;
				}
			}
			if (in_array ( $keys, $this->_quotes )) {
				$error = $this->validateQuotes ( $values );
				if ($error != 0) {
					break;
				}
			}
			if (in_array ( $keys, $this->_stringType )) {
				$error = $this->validateString ( $values );
				if ($error != 0) {
					break;
				}
			}
			if (in_array ( $keys, $this->_emailType )) {
				$error = $this->validateEmail ( $values );
				if ($error != 0) {
					break;
				}
			}
			if (in_array ( $keys, $this->_imageType )) {
				$error = $this->validateImage ( $keys );
				if ($error != 0) {
					break;
				}
			}
			if (in_array ( $keys, $this->_wordLimit20 )) {
				$error = $this->validateWordLimit20( $values );
				if ($error != 0) {
					break;
				}
			}
			if (in_array ( $keys, $this->_wordLimit50 )) {
				$error = $this->validateWordLimit50 ( $values );
				if ($error != 0) {
					break;
				}
			}
		}
		if($error != 0){
		return $error.$keys;
		}
		else{
			return $error;
		}
	}
	// *******************************************************validate interger
	// type data**********************************************
	private function validateInt($value) {
		if ($value == "") {
			return 0;
		}
			if (! (preg_match ( "/[0-9]{10}/", $value ))) {
			return 1;
		} else {
			return 0;
		}
	}
	// *******************************************************validate float
	// type data**********************************************
	private function validateFloat($value) {
		if ($value == "") {
			return 0;
		}
		if (! (preg_match ("'^\d{0,2}(\.\d{1,2})?$'", $value ))) {
			return 2;
		} else {
			return 0;
		}
	
	}
	// *******************************************************validate quotes in
	// data**********************************************
	private function validateQuotes($value) {
		if ($value == "") {
			return 0;
		}
		
		$singleQuotesPos = strrpos ( $value, "'" );
		$doubleQuotesPos = strrpos ( $value, '"' );
		$backwordQuotesPos = strrpos ( $value, '`' );
		
		if ($singleQuotesPos === false && $doubleQuotesPos === false && $backwordQuotesPos === false) {
			return 0;
		} else {
			return 3;
		}
	
	}
	// **************** validate string type data *******************
	private function validateString($value) {
		if ($value == "") {
			return 0;
		}
		if(!preg_match("'^[a-zA-Z\s]+$'",$value)) {		    
    			return 4;
    		}
    		 else {
    			return 0;
    		}
	}
	// **************** validate Email type data *******************
	private function validateEmail($value) {
		if ($value == "") {
			return 0;
		}
		if (! filter_var ( $value, FILTER_SANITIZE_EMAIL, FILTER_SANITIZE_MAGIC_QUOTES )) {
			return 5;
		} else {
			return 0;
		}
	}
	// *******************************************************validate Image
	// type data**********************************************
	private function validateImage($value) {
		
		if ($_FILES [$value] ["tmp_name"] != "") {
			$allowedExts = array (
					"gif",
					"jpeg",
					"jpg",
					"png" 
			);
			$extension = end ( explode ( ".", $_FILES [$value] ["name"] ) );
			if ((($_FILES [$value] ["type"] == "image/gif") || 
					($_FILES [$value] ["type"] == "image/jpeg") || 
					($_FILES [$value] ["type"] == "image/jpg") || 
					($_FILES [$value] ["type"] == "image/png")) && 
					($_FILES [$value] ["size"] < 3145728) && 
					in_array ( $extension, $allowedExts )) 
			{
				if ($_FILES [$value] ["error"] > 0) {
					echo "Error: " . $_FILES ["image"] ["error"] . "<br>";
				} else {
					return 0;
				}
			} else {
				return 8;
			}
		} else {
			return 0;
		}
	}
	// *******************************************************validate 20 Word limit
	// type data**********************************************
	private function validateWordLimit20($value) {
		if ($value == "") {
			return 0;
		}
		if (strlen($value) > 20) {
			return "T";
		} else {
			return 0;
		}
	}
	// *******************************************************validate 50 Word limit
	// type data**********************************************
	private function validateWordLimit50($value) {
		if ($value == "") {
			return 0;
		}
		if (strlen($value) > 50) {
			return "F";
		} else {
			return 0;
		}
	}
	// *******************************************************validate date type
	// data***********************************************
	private function validateDate($value) {
		if ($value == "") {
			return 0;
		}
		if (! (preg_match ( "/[0-9]{4}\/[0-9]{2}\/[0-9]{2}/", $value ))) {
			return 10;
		} else {
			return 0;
		}
	}
}