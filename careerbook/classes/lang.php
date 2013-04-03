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

	public function __construct($language) {
		$this->_lang=$language;
	}

	public function __get($key){
		return $this->_lang[$key];
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
$a=explode('/', $s);
$n=count($a);
if(($a[$n-1])=="careerbook"){
	include_once './lang/lang.'.$selectedLang.".php";
}
else 
{
	include_once '../lang/lang.'.$selectedLang.".php";
}
$lang= new language($langArr);

?>
