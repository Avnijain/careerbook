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
    
    public function getFrndsDis($userInfo){
    	$user_id = $userInfo->getUserIdInfo();
    	$user_id=$user_id['id'];

// select b.description discussion,d.first_name,a.description comment
// FROM user_discussions b
// JOIN
// users d
// on
// d.id = '21'
// LEFT OUTER JOIN
// user_discussions_comments a
// ON
// a.user_discussions_id = b.id
// where b.user_id = '21';    

    	$this->db->Fields ( array (
    			"a.description comments",
    			"b.description discussion",
    	        "d.first_name",
    	        "b.id"
    	    
    	));
 
    	$this->db->From ( "user_discussions b" );
    	$this->db->Join ( "users d", " d.id = $user_id " );
    	$this->db->Join ( "user_discussions_comments a", " a.user_discussions_id = b.id ","LEFT OUTER" );
    	$this->db->Where (array ("b.user_id" => "$user_id"));
    	$this->db->Select ();
//     	echo $this->db->lastQuery();
//     	die;

    	$result = array($this->db->resultArray ());
// select a.description comments,b.description discussion,d.first_name, b.id
// FROM user_discussions b
// JOIN
// friends c
// ON
// c.user_id = '21'
// JOIN
// user_discussions_comments a
// ON
// a.user_discussions_id = b.id AND b.user_id = c.friend_id
// JOIN
// users d
// on
// d.id = c.friend_id;
    	
    	$this->db->Fields ( array (
    	    "a.description comments",
    	    "b.description discussion",
    	    "d.first_name",
    	    "b.id"
    	));
    	
    	$this->db->From ( "user_discussions b" );
    	$this->db->Join ( "friends c", " c.user_id = $user_id " );
    	$this->db->Join ( "user_discussions_comments a", " a.user_discussions_id = b.id AND b.user_id = c.friend_id " );
    	$this->db->Join ( "users d", " d.id = c.friend_id " );
    	$this->db->Select ();

    	$result[] = $this->db->resultArray ();
    	
//     	echo"<pre/>";
//     	print_r($result);
//     	die;
    	
//    	echo $this->db->lastQuery();
//     	echo "<pre/>";
//     	print_r ( $this->db->resultArray () );
//     	die;	
    	
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