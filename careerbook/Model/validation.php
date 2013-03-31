<?php
 
class validation
{
	public function validate($a)
	{  //echo "validation fun";
		foreach ($a as $key=>$value) {

			if(($key=="email_primary")||($key=="email_secondary"))
			{

				if(!filter_var($value, FILTER_SANITIZE_EMAIL))
				{
					if($_POST['action']=="registration")
					{
					header("location:../views/UserInfoForm.php?err=3");
					exit;
					}
					else
					{
						header("location:../views/NewRegistration.php?err=3");
						exit;
					}
				}
			}
			else if(($key=="percentage_GPA_10")||($key=="percentage_12")||($key=="graduation_percentage")||($key=="post_graduation_percentage")||($key=="percentage"))
			{
				if(!(var_dump(filter_var($value, FILTER_VALIDATE_FLOAT))))
				{
					if($_POST['action']=="registration")
						{
						header("location:../views/UserInfoForm.php?err=3");
						exit;
						}
						else
						{
							header("location:../views/NewRegistration.php?err=3");
							exit;
						}
				}
			}
			else if(($key=="date_of_birth")||($key=="startperiod"))
			{
				if(!(preg_match("/[0-9]{2}\/[0-9]{2}\/[0-9]{4}/", $value)))
				{
					if($_POST['action']=="registration")
						{
						header("location:../views/UserInfoForm.php?err=3");
						exit;
						}
						else
						{
							header("location:../views/NewRegistration.php?err=3");
							exit;
						}
				}
			}
			else if(($key=="image"))
			{
				$allowedExts = array("jpg", "jpeg", "gif", "png");
				$extension = end(explode(".", $_FILES["file"]["name"]));
				if ((($_FILES["file"]["type"] == "image/gif")
						|| ($_FILES["file"]["type"] == "image/jpeg")
						|| ($_FILES["file"]["type"] == "image/png")
						|| ($_FILES["file"]["type"] == "image/pjpeg"))
						&& ($_FILES["file"]["size"] < 800)
						&& in_array($extension, $allowedExts))
				{
					if ($_FILES["file"]["error"] > 0)
					{
						echo "Error: " . $_FILES["file"]["error"] . "<br>";
						exit;
					}
					
				}
				else
				{
					header("location:../views/UserInfoForm.php?err=image");
					exit;
				}
			}
			else 
			{
				if(!filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS,FILTER_SANITIZE_MAGIC_QUOTES) && !isset($value))
				{

				if($_POST['action']=="registration")
					{
					header("location:../views/UserInfoForm.php?err=3");
					exit;
					}
					else
					{
						header("location:../views/NewRegistration.php?err=3");
						exit;
					}
				}
			}
		}
	}
	
}

//$validdob= new validation();




//******************************************************************************************************************************************************
//*
//@author:Mohit K.Singh
//Access: Public
//
//*******************************************************************************************************************************************************

class UserDataValidation
{
	
	private $_intgerType;
	private $_floatType;
	private $_stringType;
	private $_emailType;
	private $_imageType;
	private $_quotes;
	
	public function __construct()
	{
		$this->_intgerType=array();
		$this->_floatType=array();
		$this->_stringType=array();
		$this->_emailType=array();
		$this->_imageType=array();
		$this->_quotes=array();	
	}
//*******************************************************Function to validate User data	**************************************************************
	public function validate($userData)
	{
		$error;
		foreach($userData as $keys=>$values)
		{
			if(in_array($keys,$this->_intgerType))
			   {
				$error=$this->validateInt($values);
				if($error!=0)
				{
					break;
				}
			   }
			if(in_array($keys,$this->_floatType))
			   {
				$error=$this->validateFloat($values);
				if($error!=0)
				{
					break;
				}
			   }			   
			if(in_array($keys,$this->_quotes))
			   {
				$error=$this->validateQuotes($values);
				if($error!=0)
				{
					break;
				}
			   }			   
			if(in_array($keys,$this->_stringType))
			   {
				$error=$this->validateString($values);
				if($error!=0)
				{
					break;
				}
			   }
			if(in_array($keys,$this->_emailType))
			   {
				$error=$this->validateEmail($values);
				if($error!=0)
				{
					break;
				}
			   }
			if(in_array($keys,$this->_imageType))
			   {
				$error=$this->validateImage($values);
				if($error!=0)
				{
					break;
				}
			   }			   
		}		
		return $error;
	}
	//*******************************************************validate interger type data**********************************************
	private function validateInt($value)
	{
		if($value=="")
		{
			return 0;
		}
		if(!is_int($value))
		{
			return 1;
		}
		else {
			return 0;
		}
	}
	//*******************************************************validate float type data**********************************************
	private function validateFloat($value)
	{
		if($value=="")
		{
			return 0;
		}
		if(!(var_dump(filter_var($value, FILTER_VALIDATE_FLOAT))))
		{
			return 2;
		}
		else{
			return 0;
		}
		
	}
	//*******************************************************validate quotes in data**********************************************
	private function validateQuotes($value)
	{
		if($value=="")
		{
			return 0;
		}
		$singleQuotesPos = strrpos($value, "'");
		$doubleQuotesPos = strrpos($value, '"');
		$backwordQuotesPos = strrpos($value, '`');
		if($singleQuotesPos===false || $doubleQuotesPos ===false || $backwordQuotesPos ===false) {
			return 3;
		} else {
			return 0;
		}
		
	}
	//*******************************************************validate string type data**********************************************
	private function validateString($value)
	{
		if($value=="")
		{
			return 0;
		}
		if(!filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS,FILTER_SANITIZE_MAGIC_QUOTES))
		{
			return 4;
		}
		else{
			return 0;
		}
		
	}
	//*******************************************************validate Email type data**********************************************
	private function validateEmail($value)
	{
		if($value=="")
		{
			return 0;
		}
		if(!filter_var($value, FILTER_SANITIZE_EMAIL,FILTER_SANITIZE_MAGIC_QUOTES))
		{
			return 5;
		}
		else {
			return 0;
		}
	}
	//*******************************************************validate Image type data**********************************************
	private function validateImage($value)
	{
		if($value=="")
		{
			return 0;
		}
		$allowedExts = array("image/gif", "image/jpeg","image/png","image/pjpeg");
		
		if (($_FILES["file"]["size"] < 800 || $_FILES["file"]["size"] > 5242880) && !(in_array($_FILES["file"]["type"], $allowedExts)) && $_FILES["file"]["error"] > 0)
		{
			return 6;
		}
		else {
			return 0;
		}
	}		
}













































?>
