<link rel="stylesheet" type="text/css" href="../css/group.css"></link>
<?php
	include_once('../classes/groupClass.php');
	
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
	
?>
<div class="group_header group_div">
	<img src="<?php echo $uri1;?>" class="group_image">
		<?php
		echo "<p>" . nl2br($groupData1[0] ['title']) . "</p>";
		echo "<p>" . nl2br($groupData1[0] ['description']) . "</p>";
		?>
</div>
<div id="groupPost">
	<form
		action="../controller/mainentrance.php?action=addPost&groupId=<?php echo $_GET['groupId'];?>"
		method="post">
		<br/>
			<textarea class="group_textarea" name="group_discussion_description" rows="6" cols="20" placeholder="Post Your Message ..."></textarea>
		<br/>
		<input class="group_button" type="submit" value="Post">
	</form>
</div><br/>
<div>
	<?php
	foreach ( $groupData as $keys => $values ) {
	$uri = 'data:image/png;base64,'.base64_encode($groupData[$keys]['profile_image']);
		?>
	<div class="group_post group_div">
		<img src="<?php echo $uri;?>" class="group_image">
		<?php
		echo nl2br($values ['description']) . "<br />";
		echo "Posted by <a href=\"#\">" . $values ['first_name'] . " " . $values['middle_name'] . " " . $values['last_name']. "</a>";
		echo " on " . $values ['created_on'] . "<br/>";
		if ($values ['created_by'] == $userId) {
			echo "<br/><a class=\"group_button\" href=\"../controller/mainentrance.php?action=process_edit_post&postId={$values['id']}\">Edit Post</a>";
		}
		?>
		<a class="group_button"
			href="../controller/mainentrance.php?action=getComment&groupDiscussionId=<?php echo $values['id'];?>">View Comments</a><br />
	</div><br/>
	<?php
	}
	?>
</div>
