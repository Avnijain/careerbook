<link rel="stylesheet" type="text/css" href="../css/group.css"></link>
<?php
// include_once('../classes/groupClass.php');
$groupData = array ();
$groupData = unserialize ( $_SESSION ['groupList'] );
?>
<div class="button">
	<a class="group_button" href="../views/userHomePage.php?addGroup">Add Group</a>
	<a class="group_button" href="../views/userHomePage.php?searchGroup">Search Group</a>
</div>
<br/>
<div>
	<?php
	foreach ( $groupData as $keys => $values ) {
		?>
	<div class="group_list group_div">
		<img src="../images/default-group.jpg" class="group_image">
		<?php
		echo "Title : " . $values ['title'] . "<br />";
		echo "Description : " . $values ['description'] . "<br />";
		?>
		<br />
		<div>
			<a class="group_button"
			href="../controller/mainentrance.php?action=getPost&groupId=<?php echo $values['id'];?>">View</a>
			<a  class="group_button"
			href="../controller/mainentrance.php?action=unjoinGroup&groupId=<?php echo $values['id'];?>">Unlink</a>
		</div>
	</div><br/>
	<?php
	}
?>
</div>
