<link rel="stylesheet" type="text/css" href="../css/group.css"></link>
<script type="text/javascript" src="../JavaScript/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="../JavaScript/group.js"> </script>
<?php
	include_once('../classes/groupClass.php');
	
	$objUserId = unserialize($_SESSION['userData']);
	$userData=$objUserId->getUserIdInfo();
	$userId = $userData['id'];
	
	$groupData = unserialize ( $_SESSION ['groupDiscussionComment'] );
	$groupData = ($groupData->getCommentList());
	
	
	$groupData1 = unserialize ( $_SESSION ['postDetail'] );
	$groupData1 = $groupData1->getPostDetail();
	$uri1 = 'data:image/png;base64,'.base64_encode($groupData1[0]['profile_image']);

?>
<div  class="group_header group_div">
	<img src="<?php echo $uri1;?>" class="group_image">
		<?php
		echo "<p>Description : " . nl2br(htmlspecialchars($groupData1[0] ['description'])) . "</p>";
		echo "Posted by<a href=\"#\"> " . $groupData1[0] ['first_name'] . " " . $groupData1[0]['middle_name'] . " " . $groupData1[0]['last_name']."</a>";
		echo " by " . $groupData1[0] ['created_on'] . "";
		?>
</div><br/>
<div id="groupDiscussionComment">
	<form id="groupDiscussionComment_form"
		action="../controller/mainentrance.php?action=addComment&groupDiscussionId=<?php echo $_GET['groupDiscussionId'];?>"
		method="post">
		<p>
			<textarea class="group_textarea" id="group_discussion_comment" name="group_discussion_comment" rows="6" cols="20" placeholder="Post Comment..."></textarea>
		</p>
		<input type="submit" value="Post" class="group_button">
	</form>
</div><br/>
<div class="group_comment group_div">
	<?php
	rsort($groupData);
	foreach ( $groupData as $keys => $values ) {
		$uri = 'data:image/png;base64,'.base64_encode($groupData[$keys]['profile_image']);
		?>
	<div class="group_comment group_div">
		<img src="<?php echo $uri;?>" class="group_image">
		<?php
		echo "" . nl2br(htmlspecialchars($values ['description'])) . "<br />";
		echo "Posted by <a href=\"#\">" . $values ['first_name'] . " " . $values['middle_name'] . " " . $values['last_name']. "</a>";
		echo " on " . $values ['created_on'] . "<br/>";
		if ($values ['created_by'] == $userId) {
			echo "<br/><a class=\"group_button\" href=\"../controller/mainentrance.php?action=delete_comment&commentId={$values['id']}\">Delete</a>";
		}
		?>
		
	</div>
	<?php
	}
	?>
</div>
