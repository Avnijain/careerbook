<link rel="stylesheet" type="text/css" href="../css/group.css"></link>
<div class="button">
	<a class="btn blue"  href="../Home/userHomePage.php?addGroup"><?php echo $lang->ADDGROUP;?></a>
	<a class="btn blue" href="../Home/userHomePage.php?searchGroup"><?php echo $lang->SEARCHGROUP;?></a>
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
		echo "<br/> ".$lang->CREATEDBY. "<a href=\"#\"> " . $values ['first_name'] . " " . $values['middle_name'] . " " . $values['last_name']. "</a><br/>";
		if ($values ['created_by'] == $userId) {
			echo "<br/><a class='btn blue' href='../controller/mainentrance.php?action=process_edit_group&groupId={$values['id']}'> $lang->EDITGROUP</a>";
			echo "<a class='btn blue' href='javascript:deleteGroup(".$values['id'].")'>$lang->DELETE</a>";
		}
		?>
			<a class="btn blue"
			href="javascript:viewGroup(<?php echo $values['id'];?>)"><?php echo $lang->VIEW;?></a>
			<a  class="btn blue"
			href="javascript:unlinkGroup(<?php echo $values['id'];?>)"><?php echo $lang->UNLINK;?></a>
	</div><br/>
	<?php
	}
?>
</div>