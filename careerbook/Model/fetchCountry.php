<?php
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