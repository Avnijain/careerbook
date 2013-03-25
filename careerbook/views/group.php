<?php
// include_once('../classes/groupClass.php');
$groupData = array ();
$groupData = unserialize ( $_SESSION ['groupList'] );
?>
<a href="../views/userHomePage.php?addGroup">Add Group</a>
<a href="../views/userHomePage.php?searchGroup">Search Group</a>
<?php
foreach ( $groupData as $keys => $values ) {
	?>
<div>
		<?php
	echo "Id : " . $values ['id'] . "<br/>";
	echo "Title : " . $values ['title'] . "<br />";
	echo "Description : " . $values ['description'] . "<br />";
	echo "Created on " . $values ['created_on'] . "<br/>";
	?>
		<br /> <a
		href="../controller/mainentrance.php?action=getPost&groupId=<?php echo $values['id'];?>">View</a><a
		href="../controller/mainentrance.php?action=unjoinGroup&groupId=<?php echo $values['id'];?>">Unlink</a><br />
</div>
<?php
}
?>
