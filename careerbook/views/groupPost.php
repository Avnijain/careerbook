<link rel="stylesheet" type="text/css" href="../css/group.css"></link>
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
		<br/>
			<textarea class="group_textarea" name="group_discussion_description" rows="6" cols="20"></textarea>
		<br/>
		<input class="group_button" type="submit" value="Post">
	</form>
</div><br/>
<div>
	<?php
	foreach ( $groupData as $keys => $values ) {
		?>
	<div class="group_post">
		<?php
		echo "Description : " . $values ['description'] . "<br />";
		echo "Posted on " . $values ['created_on'] . "<br/>";
		?>
		<a class="group_button"
			href="../controller/mainentrance.php?action=getComment&groupDiscussionId=<?php echo $values['id'];?>">View</a><br />
	</div><br/>
	<?php
	}
	?>
</div>
