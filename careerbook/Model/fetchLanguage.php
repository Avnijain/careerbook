<?php
/*
**************************** Creation Log *******************************
File Name                   -  fetchLanguage.php
Project Name                -  Careerbook
Description                 -  Model Class file to fetch language
Version                     -  1.0
Created by                  -  Prateek Saini
Created on                  -  April 09, 2013
***************************** Update Log ********************************
Sr.NO.		Version		Updated by           Updated on          Description
-------------------------------------------------------------------------
*************************************************************************
*/
require_once 'DbConnectionModelAbstract.php';
class Language extends model{
    public function __construct(){
       parent::__construct(); 
    }
    public static function getLanguage(){
       $tempObj = new Language();
       $result = $tempObj->fetchLanguage($_GET['term']);       
       echo (json_encode($result));
    }
    //************************* Get City from Database *************** 
    private function fetchLanguage($search){
        $this->db->Fields(array("name"));
        $this->db->From("language");
        $this->db->Where(array("name like('".$search."%')"),true);
        $this->db->Select();
        return $this->db->resultArray();
    }
}
Language::getLanguage();