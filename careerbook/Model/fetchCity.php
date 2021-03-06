<?php
/*
**************************** Creation Log *******************************
File Name                   -  fetchCity.php
Project Name                -  Careerbook
Description                 -  Model Class file to fetch City
Version                     -  1.0
Created by                  -  Prateek Saini
Created on                  -  April 08, 2013
***************************** Update Log ********************************
Sr.NO.		Version		Updated by           Updated on          Description
-------------------------------------------------------------------------
*************************************************************************
*/
require_once 'DbConnectionModelAbstract.php';
class City extends model{
    public function __construct(){
       parent::__construct(); 
    }
    public static function getCity(){
       $tempObj = new City();
       $result = $tempObj->fetchCity($_GET['term']);       
       echo (json_encode($result));
    }
    //************************* Get City from Database *************** 
    private function fetchCity($search){
        $this->db->Fields(array("id"));
        $this->db->From("state");
        $this->db->Where(array("name like('".$search."%')"),true);
        $this->db->Select();
        $temp =  $this->db->resultArray();
        $temp = $temp[0]['id'];
                
        $this->db->Fields(array("name"));
        $this->db->From("city");
        $this->db->Where(array("state_id = '$temp'"),true);
        $this->db->Select();
        return $this->db->resultArray();
    }
}
City::getCity();