<link rel="stylesheet" type="text/css" href="../css/group.css"></link>
<?php
	include_once('../classes/groupClass.php');
	$groupData = unserialize ( $_SESSION ['groupDiscussionComment'] );
	$groupData = $groupData->getCommentList();

?>
<div id="groupDiscussionComment">
	<form
		action="../controller/mainentrance.php?action=addComment&groupDiscussionId=<?php echo $_GET['groupDiscussionId'];?>"
		method="post">
		<p>
			<textarea class="group_textarea" name="group_discussion_comment" rows="6" cols="20"></textarea>
		</p>
		<input type="submit" value="Post" class="group_button">
	</form>
</div>
<div>
	<?php
	foreach ( $groupData as $keys => $values ) {
		?>
	<div class="group_comment group_div">
		<img src="../images/default-group.jpg" class="group_image">
		<?php
		echo "Description : " . $values ['description'] . "<br />";
		echo "Posted on " . $values ['created_on'] . "<br/>";
		?>
		
	</div><br />
	<?php
	}
	?>
</div>
