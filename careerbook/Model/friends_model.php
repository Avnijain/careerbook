 <?php
ini_set("display_errors", "1");
require_once 'singleton.php';




class FriendsModel extends model {
    
   
    public function getFriends($userInfo)
    {
    	$user_id = $userInfo->getUserIdInfo();
    	$user_id=$user_id['id'];
        //$user_id=17;
        $this->db->Fields(array('u.id','u.first_name','u.middle_name','u.last_name','u.gender','u.email_primary','f.status'));
        $this->db->From('users u');
        $this->db->Join('friends f','u.id=f.user_id');
        //$this->db->Join('user_personal_info p','u.id=p.user_id');
        $this->db->Where(array("u.id IN(select friend_id from friends where user_id=".$user_id." and status='F')"),true);
        $this->db->Select();
		$result = $this->db->resultArray();
		return($result);               
    }
    
    public function getFrndsReqData($userInfo)
    {
    	$user_id = $userInfo->getUserIdInfo();
    	$user_id=$user_id['id'];
		//$user_id=17;
        $this->db->Fields(array('u.id','u.first_name','u.middle_name','u.last_name','u.gender','u.email_primary','f.status'));
        $this->db->From('users u');
        $this->db->Join('friends f','u.id=f.user_id');
        //$this->db->Join('user_personal_info p','u.id=p.user_id');
        $this->db->Where(array("u.id IN(select friend_id from friends where user_id=".$user_id." and status='R')"),true);
        $this->db->Select();
		$result = $this->db->resultArray();
		return($result);         
    }
    
    public function getAllUsersData($userInfo,$searchVal)
    {
    	$user_id = $userInfo->getUserIdInfo();
    	$user_id=$user_id['id'];
    	//$user_id=17;
    	$this->db->Fields(array('u.id','u.first_name','u.middle_name','u.last_name','u.gender','u.email_primary','f.status'));
    	$this->db->From('users u');
    	$this->db->Join('friends f','u.id=f.user_id');
    	//$this->db->Join('user_personal_info p','u.id=p.user_id');
    	$this->db->Where(array("u.id IN(select friend_id from friends where user_id=".$user_id." and (status='F' OR status='R' OR status='W')) AND (u.first_name like '%".$searchVal."%' OR u.middle_name like '%".$searchVal."%' OR u.last_name like '%".$searchVal."%' OR u.email_primary like '%".$searchVal."%')"),true);
    	$this->db->Select();
    	$result1 = $this->db->resultArray();
    	
    	$this->db->unsetValues();
    	
    	$this->db->Fields(array('u.id'));
    	$this->db->From('users u');
    	$this->db->Join('friends f','u.id=f.user_id');
    	//$this->db->Join('user_personal_info p','u.id=p.user_id');
    	$this->db->Where(array("u.id IN(select friend_id from friends where user_id=".$user_id." and (status='F' OR status='R' OR status='W'))"),true);
    	$this->db->Select();
    	$result2 = $this->db->resultArray();

    	
    	
    	
    	//return($result);

    	$myStr="1,";
		foreach($result2 as $keys=>$values){
			foreach ($values as $key=>$value)
			{
				$myStr.=$value.",";
			}
		}
		 
    	$myStr=substr($myStr,0,-1);
    	
    	$this->db->unsetValues();
    	
    	$this->db->Fields(array('id','first_name','middle_name','last_name','gender','email_primary','status'));
    	$this->db->From('users');
    	$this->db->Where(array("(status = 'A' AND (first_name like '%".$searchVal."%' OR middle_name like '%".$searchVal."%' OR last_name like '%".$searchVal."%' OR email_primary like '%".$searchVal."%')) AND id NOT IN (".$myStr.") AND id <> ".$user_id." "),true);
    	$this->db->Select();
    	
    	$result = $this->db->resultArray();
    	//echo $myStr;
    	
    	//echo $this->db->lastQuery();
    	//die;

    	
    	$result=array_merge($result1,$result);

    	return($result);
    }


}


// $o=new FriendsModel();
// $o->getAllUsersData("A");

?>