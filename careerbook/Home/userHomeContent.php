<?php
include_once("../classes/lang.php");
include_once '../controller/activityReportController.php';
?>
<!--[if gte IE 7]>
<style>
	#mainWrapper {width: 100%; margin: 0 auto;}
</style>
<div style="text-align: center;">
  <div style="text-align: left; margin: auto; width: 100%;">
<![endif]-->
<script type="text/javascript">
$(function() {
    $("#contactus").fancybox({
            'width'			: 600,
            'height'		: 600,
            'autoScale'		: false,
            'transitionIn'		: 'none',
            'transitionOut'		: 'none',
            'type'			: 'iframe'
    });
});
</script>
<div id="contentSide">
			<!-- Box -->
			<div class="box">
				<h2><span><?php echo $lang->NOTIFICATIONS ?></span></h2>
				<div class="cl">&nbsp;</div>				
				<div class="posts">
					<!-- Post -->
				    <?php
				    $objFrndControl->start('FrndReq');
				    require_once '../controller/message_controller.php';
				    $objMessage1 = new MessageController();
				    $count=$objMessage1->handleNewMessage();
				    include_once('../classes/friendsClass.php');
				    $friendsReqData=unserialize($_SESSION['FrndReq']);
				    $myFrndReqCount= $friendsReqData->countReqFrnds();
				    include_once '../View/notification.php';
				    ?>
				</div>
			</div>
			<!-- /Box -->
			<!-- Box -->
			<div class="box">
				<h2><span><?php echo $lang->ACTIVITYREPORT?></span></h2>
				<div class="cl">&nbsp;</div>
				<div class="posts">
				    <div id="activityReport">
				    	<?php include '../View/activityReport.php'; ?>
				    </div>
				    <div class="cl">&nbsp;</div>
				</div>
			</div>
			<!-- /Box -->
			<div class="box">
				<h2><span><?php echo "Contact Us"; ?></span></h2>
				<div class="cl">&nbsp;</div>				
				<a id="contactus" href="../Home/userHomePage.php?contactUs"><img src="../images/suggestion1.jpg" width=240 height=200></a>
			</div>
			<div class="cl">&nbsp;</div>
</div>
<div id="contentCenter">

<?php
if (isset($_GET['addGroup'])) {
	include '../View/add_group.php';
}else if (isset($_GET['Group'])) {
    $groupData=unserialize($_SESSION['groupList']);
    $groupData= $groupData->getGroupList();
    $objUserId = unserialize($_SESSION['userData']);
    $userData=$objUserId->getUserIdInfo();
    $userId = $userData['id'];
	include '../View/group.php';
} else if (isset($_GET['addGroup'])) {
	include '../View/add_group.php';
} else if (isset($_GET['groupPost'])) {
    
    $objUserId = unserialize($_SESSION['userData']);
    $userData=$objUserId->getUserIdInfo();
    $userId = $userData['id'];
    
    if(isset($_SESSION ['groupPost'])) {
        $groupData = unserialize ( $_SESSION ['groupPost'] );
        $groupData= $groupData->getPostList();
    }
    if (isset($_SESSION['groupDetail'])) {
        $groupData1=unserialize($_SESSION['groupDetail']);
        $groupData1= $groupData1->getGroupDetail();
    
        if (($groupData1[0]['group_image']) == NULL) {
            $uri1 = "../images/default-group.jpg";
        } else {
            $uri1 = 'data:image/png;base64,'.base64_encode($groupData1[0]['group_image']);
        }
    }
	include '../View/groupPost.php';
} else if (isset($_GET['groupComment'])) {
    $objUserId = unserialize($_SESSION['userData']);
    $userData=$objUserId->getUserIdInfo();
    $userId = $userData['id'];
    
    $groupData = unserialize ( $_SESSION ['groupDiscussionComment'] );
    $groupData = ($groupData->getCommentList());
    
    
    $groupData1 = unserialize ( $_SESSION ['postDetail'] );
    $groupData1 = $groupData1->getPostDetail();
    $uri1 = 'data:image/png;base64,'.base64_encode($groupData1[0]['profile_image']);
    rsort($groupData);
	include '../View/groupComment.php';
} else if (isset($_GET['addGroup'])) {
	include '../View/add_group.php';
} else if (isset($_GET['searchGroup'])) {
    $groupData = array();
    $noOfResult = 0;
    if (isset($_SESSION['groupSearch'])) {
        $groupData = unserialize($_SESSION['groupSearch']);
        $count = $groupData->countGroupSearchList();
        $groupData = $groupData->getGroupSearchList();
    
    }
	include '../View/searchGroup.php';
} else if (isset($_GET['addUserPost'])) {
	include '../View/post_user_discussion.php';
} else if (isset($_GET['editGroup'])) {
    $groupData=unserialize($_SESSION['groupDetail']);
    $groupData= $groupData->getGroupDetail();
	include '../View/edit_group.php';
} else if (isset($_GET['editPost'])) {
    $groupData=unserialize($_SESSION['postDetail']);
    $groupData= $groupData->getPostDetail();
    $groupId=$_REQUEST['groupId'];
    $uri = 'data:image/png;base64,'.base64_encode($groupData[0]['profile_image']);
	include '../View/edit_post.php';
}else if(isset($_GET['Friends'])){
	$objFrndControl->start('myFriends');
	$friendsData = unserialize ( $_SESSION ['myFriends'] );
	$myfrnd = $friendsData->getMyFriendsNetwork ();
	include_once "../View/friends.php";
}else if (isset($_GET['Settings'])) {

	include '../View/setting.php';
	
}else if(isset($_GET['Search'])){
	$objFrndControl->start('allUsers',$_GET['Search']);
	$AllUserData=unserialize($_SESSION['allUsers']);
	$allUserData= $AllUserData->getAllUsers();
	$count=$AllUserData->countAllUsers();
	include_once "../View/search.php";
}else if(isset($_GET['FriendsRequest'])){	
    $friendsReqData=unserialize($_SESSION['FrndReq']);
    $myfrnd= $friendsReqData->getRequestedFriends();
	include_once "../View/friendsRequest.php";
}
else{

    if(isset($_SESSION['userData']))
    {

	include_once '../View/discussion.php';

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
						$objUserInfo = unserialize($_SESSION['userData']);
						$userData=$objUserInfo->getUserPersonalInfo();
						$uri = 'data:image/png;base64,'.base64_encode($userData['profile_image']);
						include_once('../View/profile.php');
    
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
    					$objUserInfo = unserialize($_SESSION['userData']);
    					$userData=$objUserInfo->getUserIdInfo();
						include_once('../View/friendsImage.php');
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
					$objUserInfo = unserialize($_SESSION['userData']);
					$userData=$objUserInfo->getUserIdInfo();
						include_once('../View/groupImage.php');
					?>									   
				</div>
			</div>
			<!-- /Box -->
			<div class="cl">&nbsp;</div>	
</div>
</div>
<!--[if gte IE 7]>
  </div>
</div>
<![endif]-->