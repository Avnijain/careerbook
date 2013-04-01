<?php 
ini_set('session.cookie_httponly',true);

//session_start ();

if (isset($_SESSION['last_ip']) == false) {
	$_SESSION['last_ip'] = $_SERVER['REMOTE_ADDR'];
}

if ($_SESSION['last_ip'] != $_SERVER['REMOTE_ADDR']) {
	session_unset();
	session_destroy();
}

?>
<div id="contentSide">
			<!-- Box -->
			<div class="box">
				<h2><span>Notifications</span></h2>
				<div class="cl">&nbsp;</div>				
				<div class="posts">
					<!-- Post -->
				    <?php
				    $objFrndControl->start('FrndReq');
				    include_once 'notification.php';
				    ?>
			</div>
			<!-- /Box -->
			<!-- Box -->
			<div class="box">
				<h2><span>Activity Report</span></h2>
				<div class="cl">&nbsp;</div>				
				<div class="posts">
					<!-- Post -->
				    <div class="post">
				    	<div class="image">
				    		<a href="#"><img src="css/images/post-1.jpg" alt=""></a>
				    	</div>
				    	<div class="data">
				    		<h4><a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a></h4>
				    		<p>Maecenas sodales auctor urna cursus facilisis. Cras rutrum justo id mi bibendum luctus. </p>
				    	</div>
				    </div>
				    <!-- /Post -->
					<!-- Post -->
				   <div class="post last">
				    	<div class="image">
				    		<a href="#"><img src="css/images/post-2.jpg" alt=""></a>
				    	</div>
				    	<div class="data">
				    		<h4><a href="#">Maecenas scelerisque sapien </a></h4>
				    		<p>Maecenas sodales auctor urna cursus facilisis. Cras rutrum justo id mi bibendum luctus. </p>
				    	</div>
				    </div>
				    <div class="cl">&nbsp;</div>
				</div>
			</div>
			<!-- /Box -->
			
			
			<div class="cl">&nbsp;</div>	
		


</div></div>
<div id="contentCenter">

<?php
if (isset($_GET['Group'])) {
	include 'group.php';
}else if (isset($_GET['getGroup'])) {
	include 'group.php';
} else if (isset($_GET['addGroup'])) {
	include 'add_group.php';
} else if (isset($_GET['groupPost'])) {
	include 'groupPost.php';
} else if (isset($_GET['groupComment'])) {
	include 'groupComment.php';
} else if (isset($_GET['addGroup'])) {
	include 'add_group.php';
} else if (isset($_GET['searchGroup'])) {
	include 'searchGroup.php';
} else if (isset($_GET['addUserPost'])) {
	include 'post_user_discussion.php';
}
elseif(isset($_GET['Friends'])){
	$objFrndControl->start('myFriends');
	include_once "./friends.php";
}
else if (isset($_GET['Settings'])) {
	include 'userSettings.php';
}
elseif(isset($_GET['Search'])){
	$objFrndControl->start('allUsers',$_GET['Search']);
	include_once "./search.php";
}
elseif(isset($_GET['FriendsRequest'])){
	
	include_once "./friendsRequest.php";
} 

else{

    if(isset($_SESSION['userData']))
    {
       //$obj = new user_info_controller();
      // echo $obj->getuserinfo('first_name');
	//$objUserInfo = unserialize($_SESSION['userData']);
	//$userData=$objUserInfo->getUserPersonalInfo();
	//echo $userData['first_name'];
         //print("<br/>");
         //echo "<pre>";
         //print_r ($objUserInfo->getUserPersonalInfo());
         //print_r ($objUserInfo->getUserIdInfo());
         //print_r ($objUserInfo->getUserProfessionalInfoDB());
         //print_r ($objUserInfo->getUserAcademicInfoDB());
         //print_r ($objUserInfo->getUserAddressInfoDB());
	include_once './Dis.php';

	// print("first_name =>".$obj->getuserinfo('first_name'));print("<br/>");
 	//print("middle_name =>".$obj->getuserinfo('middle_name'));print("<br/>");
 	//print("last_name =>".$obj->getuserinfo('last_name'));print("<br/>");
 	//print("date_of_birth =>".$obj->getuserinfo('date_of_birth'));print("<br/>");
       // echo "<pre>";
        //print_r($obj);
        //echo "</pre>";
    }
    else
    {
       header("location:../index.php");
	die;   
    }
    }
?>

</div>
<div id="sideRight">
<div id="contentSide">

			<!-- Box -->
			<div class="box">
				<h2><span>User Profile</span></h2>
				<div class="cl">&nbsp;</div>				
				<div class="posts">
					<!-- Post -->
				    <div class="post">
						<?php
							include_once('./profile.php');
    
						?>
				    </div>
				    <!-- /Post -->
				    <div class="cl">&nbsp;</div>
				</div>
			</div>
			<!-- /Box -->
			<!-- Box -->
			<div class="box">
				<h2><span>Friends</span></h2>
				<div class="cl">&nbsp;</div>				
				<div class="posts">
					<!-- Post -->
					<?php
						include_once('./friendsImage.php');
					?>
				</div>
			</div>
			<!-- /Box -->
			
			<div class="box">
				<h2><span>Group</span></h2>
				<div class="cl">&nbsp;</div>				
				<div class="posts">
					<!-- Post -->
					<?php
						include_once('./groupImage.php');
					?>									   
				</div>
			</div>
			<!-- /Box -->
			
			
			<div class="cl">&nbsp;</div>	
</div>
</div>