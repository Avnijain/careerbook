<?php

ini_set("display_errors", "1");
//include_once '../controller/userInfo.php';
require_once 'singleton.php';

abstract class model {

	protected $db = "";

	function __construct() {
		$this->db = DBConnection::Connect();
	}

}

class MyImageGet extends model {

	public function UpdateUser(){
                $tmpName="../images/a6.jpg";
                //$fp = fopen($tmpName, 'r');
                //$data = fread($fp, filesize($tmpName));
                //$data = addslashes($data);
                //fclose($fp);

		$this->db->Fields(array("profile_image"=>$data));
		$this->db->From("users");
		$this->db->Where(array("id"=>23));
		$this->db->Update();
		echo $this->db->lastQuery();
	}
        public function getUserImage($userId)
        {
            $this->db->Fields(array('profile_image'));
            $this->db->From('users');
            $this->db->Where(array("id"=>$userId));
            $this->db->Select();
            $image=$this->db->resultArray();

            $uri = 'data:image/png;base64,'.base64_encode($image[0]['profile_image']);
	    return($uri);
            
        }
        public function getUserFrndsImage($userId)
        {
		$this->db->Fields(array('u.profile_image'));
		$this->db->From('users u,friends f');
		
		$this->db->Where(array("user_id=".$userId." AND friend_id=u.id AND f.status='F'"),true);
		$this->db->Select();
		$result = $this->db->resultArray();
		$uri="";
		foreach($result as $keys=>$values){
			$uri[]='data:image/png;base64,'.base64_encode($values['profile_image']);
		}
		
		//echo "<pre>";
		//print_r($uri);
		return($uri); 

           // $uri = 'data:image/png;base64,'.base64_encode($image[0]['profile_image']);
	    //return($uri);
            
        }

}

//$obj = new MyImageGet();
//$obj->getUserFrndsImage(17);


?>