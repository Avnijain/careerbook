<?php
require_once 'DbConnectionModelAbstract.php';
class State extends model{
    public function __construct(){
       parent::__construct(); 
    }
    public static function getState(){
       $tempObj = new State();
       $result = $tempObj->fetchState($_GET['term']);       
       echo (json_encode($result));
    }
    //************************* Get City from Database *************** 
    private function fetchState($search){
        $this->db->Fields(array("id"));
        $this->db->From("country");
        $this->db->Where(array("name like('".$search."%')"),true);
        $this->db->Select();
        $temp =  $this->db->resultArray();
        $temp = $temp[0]['id']; 
        
        $this->db->Fields(array("name"));
        $this->db->From("state");
        $this->db->Where(array("country_id = '$temp'"),true);
        $this->db->Select();
        return $this->db->resultArray();
    }
}
State::getState();