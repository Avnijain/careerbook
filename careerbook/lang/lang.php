<?php
/*
    **************************** Creation Log *******************************
    File Name                   -  lang.php
    Project Name                -  Careerbook
    Description                 -  Class file for start
    Version                     -  1.0
    Created by                  -  Mohit K. Singh 
    Created on                  -  March 05, 2013
	***************************** Update Log ********************************
	Sr.NO.		Version		Updated by           Updated on          Description
    -------------------------------------------------------------------------
     
    *************************************************************************

*/
session_start();
class Language{
    
	private static $_instance;   //store a instance of language class
        private $_langType;          //store user selected language type
	private $_lang=array('en' => array('USERNAME'=> "User Name",
                                           'PASSWORD'=> "Password",
                                           'PROJECTTITLE'=> "CareerBook",
                                           'FIRSTNAME'=> "First Name*",
                                           'LASTNAME'=> "Last Name",
                                           'MIDDLENAME'=> "Middle Name",
                                           'DOB'=> "Date of Birth",
                                           'GENDER'=> "Gender",
                                           'BOARD10'=>"10th Board",
                                           'SCHOOL10'=>"10th School",
                                           'BOARD12'=>"12th Board",
                                           'SCHOOL12'=>"12th School",
                                           'DEGREE'=>"Graduation Degree",
                                           'POST_DEGREE'=>"Post Graduation Degree",
                                           'SPECIALIZATION'=>"Specialization",
                                           'COLLEGE'=>"College",
                                           'PERCENTAGE'=>"Percentage%",
                                           'ADDMORE'=>"Add More",
                                           'ADDRESS'=>"Address",
                                           'CITY'=>"City",
                                           'STATE'=>'State',
                                           'IMAGE'=>'User Image',
                                           'EMAIL'=> "Email",
                                           'SEC_EMAIL'=>"Secondary Email",
                                           'PHONENUMBER'=> "Phone number",
                                           'ACCEPTTERMS'=> "I accept the terms",
                                           'SUBMIT'=> "Submit",
                                           'RESET'=> "Reset",
                                           'MALE'=> "Male",
                                           'FEMALE'=> "Female",
                                           'ERRORMSG1'=> "Please enter Required details correctly",
                                           'REGISTARTION'=> "Registration form",
                                           'MAILSUBJECT'=> "Registration in careerbook",
                                           'MESSAGEBODY'=> "Verification of your email address is pending.Your Email Careerbook",
                                           'CONFIRMATIONMSG'=> "CareerBook send a user name and password to your email Id
                                                                please  with this user name and password to confirm your email Id.",
                                            'IPADDRESS'=> " Your IP address :",
                                           'EMAILMESSAGE'=>"Kindly login with this user name and password to complete verification of your email.
                                                            http://www.careerbook.com/

                                                            Best wishes,
                                                             Team CareerBook" ,
                                            'FROM'=> "From",
                                            'SITENAME'=> "careerbook.com",
                                            'MAILSENT'=> "Mail has been sent",
					     'CURRENTPOSITION'=>"Current Position",
					     'CURRENTCOMPANY'=>"Cureent Company",
					     'STARTPERIOD'=>"start Period",

					     'POSITION'=>"position",
					     'COMPANY'=>"Company",
					     'ENDPERIOD'=>"end Period",
					      'SKILLSET'=>"Skillset"
                                           ));
	private function __construct() {
	
	}
	
	public static function getinstance() {
		if (is_null(language::$_instance)) {
				self::$_instance = new language();
		}
		return self::$_instance;
	}
        
        public function __get($key){
            $this->getLangType();
            return $this->_lang[$this->_langType][$key];
            
        }
        //this function fetch the user selected language type from session 
        private function getLangType(){
            if(isset($_SESSION['lang'])){
              $this->_langType=$_SESSION['lang']; 
            }
            else
            {
                $this->_langType='en';
            }          
        }
    
}
$lang= language::getinstance();


define('PROJECTTITLE', "CareerBook");
define('FIRSTNAME', "first name*");
define('LASTNAME', "last Name");
define('MIDDLENAME', "Middle Name");
define('DOB', "Date of Birth");
define('GENDER', "Gender");
define('EMAIL', "Email");
define('PHONENUMBER', "Phone number");
define('ACCEPTTERMS', "I accept the terms");
define('SUBMIT', "Submit");
define('RESET', "Reset");
define('MALE', "Male");
define('FEMALE', "Female");
define('ERRORMSG1', "Please enter Required details correctly");
define('REGISTARTION', "Registration form");
define('MAILSUBJECT', "Registration in careerbook");
define('MESSAGEBODY', "Verification of your email address is pending.Your Email Careerbook");
define('CONFIRMATIONMSG', "CareerBook send a user name and password to your email Id
		please  with this user name and password to confirm your email Id.");
define('IPADDRESS', " Your IP address :");
define('USERNAME', "User Name");
define('PASSWORD', "Password");
define('EMAILMESSAGE', "Kindly login with this user name and password to complete verification of your email.
    http://www.careerbook.com/

    Best wishes,
    Team CareerBook");
define('FROM', "From");
define('SITENAME', "careerbook.com");
define('MAILSENT', "Mail has been sent");
?>
