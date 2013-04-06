<?php
/*
**************************** Creation Log *******************************
File Name                   -  model.php
Project Name                -  Careerbook
Description                 -  Model Class file for Database Connection
Version                     -  1.0
Created by                  -  
Created on                  -  March 31, 2013
***************************** Update Log ********************************
Sr.NO.		Version		Updated by           Updated on          Description
-------------------------------------------------------------------------
*************************************************************************
*/
require_once '../Model/model.php';

abstract class model {
    protected $db = "";

    function __construct() {
        $this->db = DBConnection::Connect();
    }
}
?>