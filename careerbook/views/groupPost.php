<?php
// include_once('../classes/groupClass.php');
$groupData = array ();
$groupData = unserialize ( $_SESSION ['groupPost'] );
// $groupList= $groupData->getGroupList();
// var_dump($groupData);
?>
<div id="groupComment">
	<form
		action="../controller/mainentrance.php?action=addPost&groupId=<?php echo $_GET['groupId'];?>"
		method="post">
		<p>
			<textarea name="group_discussion_description" rows="6" cols="20"></textarea>
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
		<a
			href="../controller/mainentrance.php?action=getComment&groupDiscussionId=<?php echo $values['id'];?>">View</a><br />
	</div>
	<?php
	}
	?>
</div>
