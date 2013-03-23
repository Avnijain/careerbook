<?php
ini_set("display_errors", "1");
require_once 'singleton.php';

class FriendsModel extends Model {
   
    public function getFriends()
    {
        $user_id=17;
        $this->db->Fields(array('u.id','u.first_name','u.middle_name','u.last_name','u.gender','u.email_primary','f.status'));
        $this->db->From('users u');
        $this->db->Join('friends f','u.id=f.user_id');
        //$this->db->Join('user_personal_info p','u.id=p.user_id');
        $this->db->Where(array("u.id IN(select friend_id from friends where user_id=".$user_id." and status='F')"),true);
        $this->db->Select();
	$result = $this->db->resultArray();
	return($result);               
    }

}

?>