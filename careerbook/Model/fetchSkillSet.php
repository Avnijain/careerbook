<?php
/*
**************************** Creation Log *******************************
File Name                   -  fetchSkill.php
Project Name                -  Careerbook
Description                 -  Model Class file to fetch Skill Sets
Version                     -  1.0
Created by                  -  Prateek Saini
Created on                  -  April 08, 2013
***************************** Update Log ********************************
Sr.NO.		Version		Updated by           Updated on          Description
-------------------------------------------------------------------------
*************************************************************************
*/
require_once 'DbConnectionModelAbstract.php';
class SkillSet extends model{
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