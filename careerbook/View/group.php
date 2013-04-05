<link rel="stylesheet" type="text/css" href="../css/group.css"></link>
<?php
    include_once('../classes/groupClass.php');
    $groupData=unserialize($_SESSION['groupList']);
    $groupData= $groupData->getGroupList();
    
    $objUserId = unserialize($_SESSION['userData']);
    $userData=$objUserId->getUserIdInfo();
    $userId = $userData['id'];
?>
<div class="button">
	<a class="group_button" href="../Home/userHomePage.php?addGroup"><?php echo $lang->ADDGROUP;?></a>
	<a class="group_button" href="../Home/userHomePage.php?searchGroup"><?php echo $lang->SEARCHGROUP;?></a>
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
		echo "<p>Title : " . nl2br(htmlspecialchars($values ['title'])) . "</p>";
		echo "<p>" . nl2br(htmlspecialchars($values ['description'])) . "</p>";
		if ($values ['created_by'] == $userId) {
			echo "<br/><a class=\"group_button\" href=\"../controller/mainentrance.php?action=process_edit_group&groupId={$values['id']}\"> $lang->EDITGROUP</a>";
			echo "<a class=\"group_button\" href=\"../controller/mainentrance.php?action=delete_group&groupId={$values['id']}\">$lang->DELETE</a>";
		}
		?>
			<a class="group_button"
			href="../controller/mainentrance.php?action=getPost&groupId=<?php echo $values['id'];?>"><?php echo $lang->VIEW;?></a>
			<a  class="group_button"
			href="../controller/mainentrance.php?action=unjoinGroup&groupId=<?php echo $values['id'];?>"><?php echo $lang->UNLINK;?></a>
	</div><br/>
	<?php
	}
?>
</div>
