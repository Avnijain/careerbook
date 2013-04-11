<?php
require_once '../controller/user_discussion_controller.php';

class ActivityReportController {    
    public function getData(){
        $this->getActivityReport();
    }    
	/************* Get Activity Report  *****************/
	private function getActivityReport(){	    	   
	    $this->obj_usrinfo=unserialize($_SESSION['userData']);
	    $this->_obj_user_discussion_controller = new UserDiscussionController ();	    
	    $_SESSION['activityReport'] = $this->_obj_user_discussion_controller->getActivityReport($this->obj_usrinfo,4);
	    $_SESSION ['userData'] = serialize ( $this->obj_usrinfo );	    
	}
}
$objActivityReport = new ActivityReportController();
$objActivityReport->getData();
?>