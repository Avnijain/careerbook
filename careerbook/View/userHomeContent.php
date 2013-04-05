<?php 

include_once("../classes/lang.php");
?>
<div id="contentSide">
			<!-- Box -->
			<div class="box">
				<h2><span><?php echo $lang->NOTIFICATIONS ?></span></h2>
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
				<h2><span><?php echo $lang->ACTIVITYREPORT?></span></h2>
				<div class="cl">&nbsp;</div>
				<div class="posts">
					<!-- Post 
				    <div class="post">
				    	<div class="image">
				    		<a href="#"><img src="css/images/post-1.jpg" alt=""></a>
				    	</div>
				    	<div class="data">
				    		<h4><a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a></h4>
				    		<p>Maecenas sodales auctor urna cursus facilisis. Cras rutrum justo id mi bibendum luctus. </p>
				    	</div>
				    </div>
				     /Post -->
					<!-- Post 
				   <div class="post last">
				    	<div class="image">
				    		<a href="#"><img src="css/images/post-2.jpg" alt=""></a>
				    	</div>
				    	<div class="data">
				    		<h4><a href="#">Maecenas scelerisque sapien </a></h4>
				    		<p>Maecenas sodales auctor urna cursus facilisis. Cras rutrum justo id mi bibendum luctus. </p>
				    	</div>
				    </div>-->
				    <div id="activityReport">
				    	<img id="activityReportIMG" alt="userActivityReport" src="../View/activityReport.php" width="250" height="250">
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
} else if (isset($_GET['editGroup'])) {
	include 'edit_group.php';
} else if (isset($_GET['editPost'])) {
	include 'edit_post.php';
}else if(isset($_GET['Friends'])){
	$objFrndControl->start('myFriends');
	include_once "friends.php";
}else if (isset($_GET['Settings'])) {
	include 'userSettings.php';
}else if(isset($_GET['Search'])){
	$objFrndControl->start('allUsers',$_GET['Search']);
	include_once "search.php";
}else if(isset($_GET['FriendsRequest'])){	
	include_once "friendsRequest.php";
}
else{

    if(isset($_SESSION['userData']))
    {

	include_once 'discussion.php';

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
				<h2><span><?php echo $lang->USERPROFILE?></span></h2>
				<div class="cl">&nbsp;</div>				
				<div class="posts">
					<!-- Post -->
				    <div class="post">
						<?php
							include_once('profile.php');
    
						?>
				    </div>
				    <!-- /Post -->
				    <div class="cl">&nbsp;</div>
				</div>
			</div>
			<!-- /Box -->
			<!-- Box -->
			<div class="box">
				<h2><span><?php echo  $lang->FRIENDS?></span></h2>
				<div class="cl">&nbsp;</div>				
				<div class="posts">
					<!-- Post -->
					<?php
						include_once('friendsImage.php');
					?>
				</div>
			</div>
			<!-- /Box -->
			
			<div class="box">
				<h2><span><?php echo $lang->GROUP?></span></h2>
				<div class="cl">&nbsp;</div>				
				<div class="posts">
					<!-- Post -->
					<?php
						include_once('groupImage.php');
					?>									   
				</div>
			</div>
			<!-- /Box -->
			
			
			<div class="cl">&nbsp;</div>	
</div>
</div>