<link rel="stylesheet" type="text/css" href="../css/group.css"></link>
<?php
    include_once('../classes/groupClass.php');
    $groupData=unserialize($_SESSION['groupList']);
    $groupData= $groupData->getGroupList();
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
	<div class="group_header group_div">
	<?php
	if (($groupData[$keys]['group_image']) == NULL) {
		$uri = "../images/default-group.jpg";
	} else {
		$uri = 'data:image/png;base64,'.base64_encode($groupData[$keys]['group_image']);
	}
	
	?>
		<img src="<?php echo $uri;?>" class="group_image">
		<?php
		echo "<p>Title : " . nl2br($values ['title']) . "</p>";
		echo "<p>" . nl2br($values ['description']) . "</p>";
		?>
		<br />
			<a class="group_button"
			href="../controller/mainentrance.php?action=getPost&groupId=<?php echo $values['id'];?>">View</a>
			<a  class="group_button"
			href="../controller/mainentrance.php?action=unjoinGroup&groupId=<?php echo $values['id'];?>">Unlink</a>
	</div><br/>
	<?php
	}
?>
</div>
