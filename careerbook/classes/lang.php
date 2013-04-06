<?php
/*
 **************************** Creation Log *******************************
File Name                   -  lang.php
Project Name                -  Careerbook
Description                 -  Class file for start
Version                     -  1.0
Created by                  -  Mohit K. Singh
Created on                  -  March 08, 2013
***************************** Update Log ********************************
Sr.NO.		Version		Updated by           Updated on          Description
-------------------------------------------------------------------------

*************************************************************************

*/
session_start();
class Language {

	private $_lang;          //store user selected language array
	private $_regError;		//Store all users registration errors

	public function __construct($language,$regError) {
		$this->_lang=$language;
		$this->_regError=$regError;
	}

	public function __get($key){
		return $this->_lang[$key];
	}
	
	public function getRegError($key)
	{
		return $this->_regError[$key];
	}

}


if(isset($_SESSION['lang'])){
	$this->_langType=$_SESSION['lang'];
}
else
{
	$selectedLang='en';
}
$s=getcwd();
$file = basename($s);         // $file is set to "index.php"
$file = basename($s, ".php"); 

if($file=="careerbook"){
	
	include_once './lang/lang.'.$selectedLang.".php";
}
else 
{
	include_once '../lang/lang.'.$selectedLang.".php";
}
$lang= new language($langArr,$regError);

?>
