 <?php
ini_set("display_errors", "1");
require_once 'singleton.php';

class FriendsModel extends model {
    
   
    public function getFriends($userInfo)
    {
    	$user_id = $userInfo->getUserIdInfo();
    	$user_id=$user_id['id'];
        $this->db->Fields(array('u.id','u.first_name','u.middle_name','u.last_name','u.gender','u.email_primary','u.profile_image','f.status',));
        $this->db->From('users u,friends f');
        
        $this->db->Where(array("user_id=".$user_id." AND friend_id=u.id AND f.status='F'"),true);
        $this->db->Select();
		$result = $this->db->resultArray();
		return($result);               
    }
    
    public function getFrndsDis($userInfo){
    	$user_id = $userInfo->getUserIdInfo();
    	$user_id=$user_id['id'];
    	
    	$this->db->Fields ( array (
    			"user_discussions.id",
    			"description",
    			"user_discussions.user_id",
    			"created_on",
    			"Likes"
    	) );
    	
    	$this->db->From ( "user_discussions" );
    	$this->db->Join ( "friends", " user_discussions.user_id = friends.friend_id " );
    	$this->db->Where ( array (
    			"user_discussions.user_id IN (SELECT friends_id from". $user_id . " AND user_discussions.status = 'A'"
    	), true );
    	
    	$this->db->Select ();
    	$this->db->lastQuery();
    	return $this->db->resultArray ();
    	
    }
    
    public function getFrndsReqData($userInfo)
    {
    	$user_id = $userInfo->getUserIdInfo();
    	$user_id=$user_id['id'];
		//$user_id=17;
        $this->db->Fields(array('u.id','u.first_name','u.middle_name','u.last_name','u.gender','u.email_primary','u.profile_image','f.status'));
        $this->db->From('users u,friends f');
        
        $this->db->Where(array("user_id=".$user_id." AND friend_id=u.id AND f.status='R'"),true);
        $this->db->Select();
		$result = $this->db->resultArray();
		/*echo $this->db->lastQuery();
		echo "<pre>";
		print_r($result);
		die;*/
		return($result);         
    }
    
    public function getAllUsersData($userInfo,$searchVal)
    {
    	$user_id = $userInfo->getUserIdInfo();
    	$user_id=$user_id['id'];
    	//$user_id=17;
    	$this->db->Fields(array('u.id','u.first_name','u.middle_name','u.last_name','u.gender','u.email_primary','u.profile_image','f.status'));
        $this->db->From('users u,friends f');
        $this->db->Where(array("user_id=".$user_id." AND friend_id=u.id  AND (f.status='F' OR f.status='R' OR f.status='W') AND  (u.first_name like '%".$searchVal."%' OR u.middle_name like '%".$searchVal."%' OR u.last_name like '%".$searchVal."%' OR u.email_primary like '%".$searchVal."%')  "),true);
    	
    	$this->db->Select();
    	$result1 = $this->db->resultArray();
    	
    	$this->db->unsetValues();
    	
    	$this->db->Fields(array('u.id'));
        $this->db->From('users u,friends f');
        $this->db->Where(array("user_id=".$user_id." AND friend_id=u.id  AND (f.status='F' OR f.status='R' OR f.status='W') AND  (u.first_name like '%".$searchVal."%' OR u.middle_name like '%".$searchVal."%' OR u.last_name like '%".$searchVal."%' OR u.email_primary like '%".$searchVal."%')  "),true);
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
    	$this->db->Where(array("(status = 'A' AND (first_name like '%".$searchVal."%' OR middle_name like '%".$searchVal."%' OR last_name like '%".$searchVal."%' OR email_primary like '%".$searchVal."%')) AND id NOT IN (".$myStr.") AND id <> ".$user_id." "),true);
    	$this->db->Select();
    	
    	$result = $this->db->resultArray();

    	$result=array_merge($result1,$result);

    	return($result);
    }


}


// $o=new FriendsModel();
// $o->getAllUsersData("A");

?>