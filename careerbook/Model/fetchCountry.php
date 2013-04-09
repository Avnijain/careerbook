<?php
/*
**************************** Creation Log *******************************
File Name                   -  fetchCountry.php
Project Name                -  Careerbook
Description                 -  Model Class file to fetch Country
Version                     -  1.0
Created by                  -  Prateek Saini
Created on                  -  April 08, 2013
***************************** Update Log ********************************
Sr.NO.		Version		Updated by           Updated on          Description
-------------------------------------------------------------------------
*************************************************************************
*/
require_once 'DbConnectionModelAbstract.php';
class Country extends model{
    public function __construct(){
       parent::__construct(); 
    }
    public static function getCountry(){
       $tempObj = new Country();
       $result = $tempObj->fetchCountry($_GET['term']);       
       echo (json_encode($result));
    }
    //************************* Get City from Database *************** 
    private function fetchCountry($search){
        $this->db->Fields(array("name"));
        $this->db->From("country");
        $this->db->Where(array("name like('".$search."%')"),true);
        $this->db->Select();
        return $this->db->resultArray();
    }
}
Country::getCountry();