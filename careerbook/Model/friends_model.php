 <?php
 /*
    **************************** Creation Log *******************************
    File Name                   -  Friends_model.php
    Project Name                -  Careerbook
    Description                 -  Friends model classes
    Version                     -  1.0
    Created by                  -  Mohit K. Singh 
    Created on                  -  March 20, 2013
	***************************** Update Log ********************************
	Sr.NO.		Version		Updated by           Updated on          Description
	1            1.0        Prateek Saini        April 04, 2013      Modified getFrndsDis($userInfo)
	1            1.0        Prateek Saini        April 05, 2013      Added getFrndsComnt($userInfo) 
    -------------------------------------------------------------------------
    */
 
ini_set("display_errors", "1");
require_once 'singleton.php';

class FriendsModel extends model {		//class to get all data of friends from database 
    
   //*******************************************************fetch all my friends data********************************************
    public function getFriends($userInfo)
    {
    	$user_id = $userInfo->getUserIdInfo();
    	$user_id=$user_id['id'];
        $this->db->Fields(array('u.id','u.first_name','u.middle_name','u.last_name','u.gender','u.email_primary','u.profile_image','f.status',));
        $this->db->From('users u,friends f');
        
        $this->db->Where(array("user_id=".$user_id." AND friend_id=u.id AND f.status='F' AND u.status='A'"),true);
        $this->db->Select();
		$result = $this->db->resultArray();
		return($result);               
    }
   //******************************************** fetch all user and his friends Discussions ***************************************    
    public function getFrndsDis($userInfo){
    	$user_id = $userInfo->getUserIdInfo();
    	$user_id=$user_id['id'];
// SELECT distinct b.description discussion, d.first_name, b.id
// FROM user_discussions b
// INNER JOIN friends c
// ON
// c.user_id = '21'
// INNER JOIN users d
// ON
// d.id in (c.friend_id,'21')
// where b.user_id = d.id
// ORDER BY b.created_on desc;    	
    	
    	
/* This Code will fetch all the User Post on their profile home page */
    	$this->db->Fields ( array (
    	    "distinct b.description discussion",
    	    "d.profile_image",
    	    "b.id"
    	));
    	
    	$this->db->From ( "user_discussions b" );
    	$this->db->Join ( "friends c", " c.user_id = '$user_id' " );
    	$this->db->Join ( "users d", " d.id in (c.friend_id, \"$user_id\")" );
    	$this->db->Where (array ("b.user_id = d.id"),true);
    	$this->db->OrderBy("b.created_on desc");
    	$this->db->Select ();
//     	echo $this->db->lastQuery();
    	//       print_r($this->db->resultArray ());
//     	die;
    	
    	$tempData = $this->db->resultArray();
    	
    	if(!empty($tempData)){
    	    $result[] = $tempData;
    	}
/* This Code will fetch all the User Friends Post on their profile home page */
//     	$this->db->Fields ( array (
//     	    "b.description discussion",
//     	    "d.profile_image",
//     	    "b.id"
//     	));
    	 
//     	$this->db->From ( "user_discussions b" );
//     	$this->db->Join ( "friends c", " c.user_id = '$user_id' " );
//     	$this->db->Join ( "users d", " d.id = c.friend_id " );
//     	$this->db->Where (array ("b.user_id = c.friend_id"),true);
//     	$this->db->OrderBy("b.created_on desc");
//     	$this->db->Select ();
// //     	    	echo $this->db->lastQuery();
// //     	    	die;
//     	$tempData = $this->db->resultArray();
//     	if(!empty($tempData)){
//     	    $result[] = $tempData;
//     	}    	
/* This Code will fetch all the Admin Post from User Discussions Table */    	
    	$this->db->Fields ( array (    	    
    	    "b.description discussion",
    	    "d.profile_image",
    	    "b.id"
    	));
    	
    	$this->db->From ( "user_discussions b" );
    	$this->db->Join ( "users d", " d.id = 1" );
    	$this->db->Where (array ("b.user_id" => "1"));
    	$this->db->Select ();    	
        
    	$tempData = $this->db->resultArray();

    	if(!empty($tempData)){
    	    $result[] = $tempData;
    	}
    	
//     	echo"<pre/>";
//     	print_r($result);
//     	die;
    	

//     	echo "<pre/>";
//     	print_r ( $this->db->resultArray () );
	
    	
//     	$this->db->Fields ( array (
//     			"user_discussions.id",
//     			"description",
//     			"user_discussions.user_id",
//     			"created_on",
//     			"Likes"
//     	) );
    	
//     	$this->db->From ( "user_discussions" );
//     	$this->db->Join ( "friends", " user_discussions.user_id = friends.friend_id " );
//     	$this->db->Where ( array (
//     			"user_discussions.user_id IN (SELECT friends_id from". $user_id . " AND user_discussions.status = 'A'"
//     	), true );
    	
//     	$this->db->Select ();
//     	$this->db->lastQuery();
    	return $result;
    	
    }
    //*******************************fetch all my freinds request data*****************************************************
    public function getFrndsReqData($userInfo)
    {
    	$user_id = $userInfo->getUserIdInfo();
    	$user_id=$user_id['id'];
		//$user_id=17;
        $this->db->Fields(array('u.id','u.first_name','u.middle_name','u.last_name','u.gender','u.email_primary','u.profile_image','f.status'));
        $this->db->From('users u,friends f');
        
        $this->db->Where(array("user_id=".$user_id." AND friend_id=u.id AND f.status='R' AND u.status='A'"),true);
        $this->db->Select();
		$result = $this->db->resultArray();
		/*echo $this->db->lastQuery();
		echo "<pre>";
		print_r($result);
		die;*/
		return($result);         
    }
    //************************************************************fetch all users data****************************************************
    public function getAllUsersData($userInfo,$searchVal)
    {
    	$user_id = $userInfo->getUserIdInfo();
    	$user_id=$user_id['id'];
    	//$user_id=17;
    	$this->db->Fields(array('u.id','u.first_name','u.middle_name','u.last_name','u.gender','u.email_primary','u.profile_image','f.status'));
        $this->db->From('users u,friends f');
        $this->db->Where(array("user_id=".$user_id." AND friend_id=u.id  AND u.status='A' AND
			       (f.status='F' OR f.status='R' OR f.status='W') AND
			       (u.first_name like '%".$searchVal."%' OR
			       u.middle_name like '%".$searchVal."%' OR
			       u.last_name like '%".$searchVal."%' OR
			       u.email_primary like '%".$searchVal."%')  "),true);    	
    	$this->db->Select();
    	$result1 = $this->db->resultArray();
    	
    	$this->db->unsetValues();
    	
    	$this->db->Fields(array('u.id'));
        $this->db->From('users u,friends f');
        $this->db->Where(array("user_id=".$user_id."
			       AND friend_id=u.id AND u.status='A'
			       AND (f.status='F' OR f.status='R' OR f.status='W')
			       AND  (u.first_name like '%".$searchVal."%'
			       OR u.middle_name like '%".$searchVal."%'
			       OR u.last_name like '%".$searchVal."%'
			       OR u.email_primary like '%".$searchVal."%')  "),true);
    	$this->db->Select();
    	$result2 = $this->db->resultArray();

    	$myStr="1,";
		foreach($result2 as $keys=>$values){
			foreach ($values as $key=>$value)
			{
				$myStr.=$value.",";
			}
		}
		 
    	$myStr=substr($myStr,0,-1);
    	
    	$this->db->unsetValues();
    	$this->db->Fields(array('id','first_name','middle_name','last_name','gender','email_primary','profile_image','status'));
    	$this->db->From('users');
    	$this->db->Where(array("(status = 'A' AND
			       (first_name like '%".$searchVal."%'
			       OR middle_name like '%".$searchVal."%'
			       OR last_name like '%".$searchVal."%'
			       OR email_primary like '%".$searchVal."%'))
			       AND id NOT IN (".$myStr.")
			       AND id <> ".$user_id." "),true);
    	$this->db->Select();
    	$result = $this->db->resultArray();
    	$result=array_merge($result1,$result);
    	return($result);
    }


}




?>