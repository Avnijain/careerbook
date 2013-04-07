<?php
require_once '../Model/DbConnectionModelAbstract.php';
class SkillSet extends model{
    private $skill;
    public function __construct(){
       parent::__construct(); 
    }
    public static function getSkillset(){
       $tempObj = new SkillSet();
       $result = $tempObj->fetchSkillSet($_GET['term']);       
       echo (json_encode($result));
    }
    //************************* Get Skill Set from Database *************** 
    private function fetchSkillSet($search){
        $this->db->Fields(array("skill"));
        $this->db->From("skillSet_info");
        $this->db->Where(array("skill like('".$search."%')"),true);
        $this->db->Select();
        return $this->db->resultArray();
    }
}
SkillSet::getSkillset();