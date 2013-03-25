<?php
// include_once('../classes/groupClass.php');
$groupData = array ();
$groupData = unserialize ( $_SESSION ['groupDiscussionComment'] );

?>
<div id="groupDiscussionComment">
	<form
		action="../controller/mainentrance.php?action=addComment&groupDiscussionId=<?php echo $_GET['groupDiscussionId'];?>"
		method="post">
		<p>
			<textarea name="group_discussion_comment" rows="6" cols="20"></textarea>
		</p>
		<input type="submit" value="Post">
	</form>
</div>
<div>
	<?php
	foreach ( $groupData as $keys => $values ) {
		?>
	<div>
		<?php
		echo "Description : " . $values ['description'] . "<br />";
		echo "Posted on " . $values ['created_on'] . "<br/>";
		?>
		<br />
	</div>
	<?php
	}
	?>
</div>
