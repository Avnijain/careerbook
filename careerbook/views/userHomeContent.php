<?php 


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

	include_once './Dis.php';

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