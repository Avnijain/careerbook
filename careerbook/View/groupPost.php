<link rel="stylesheet" type="text/css" href="../css/group.css"></link>
<script type="text/javascript" src="../JavaScript/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="../JavaScript/group.js"> </script>
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
	//print_r($groupData);
?>
<div class="group_header group_div">
	<img src="<?php echo $uri1;?>" class="group_image">
		<?php
		echo "<p>" . nl2br(htmlspecialchars($groupData1[0] ['title'])) . "</p>";
		echo "<p>" . nl2br(htmlspecialchars($groupData1[0] ['description'])) . "</p>";
		echo "<br/> ".$lang->CREATEDBY. "<a href=\"#\"> " . $groupData1[0]  ['first_name'] . " " . $groupData1[0] ['middle_name'] . " " . $groupData1[0] ['last_name']. "</a><br/>";
		?>
</div>
<div id="groupPost">
	<form id="group_post_form"
		action="../controller/mainentrance.php?action=addPost&groupId=<?php echo $groupData1[0] ['id'];?>"
		method="post">
		<br/>
			<textarea class="group_textarea" id="group_discussion_description" name="group_discussion_description" rows="6" cols="20" placeholder="Post Your Message ..."></textarea>
		<br/>
		<input class="group_button" type="submit" value="Post">
	</form>
</div><br/>
<div>
	<?php
	rsort($groupData);
	foreach ( $groupData as $keys => $values ) {
	$uri = 'data:image/png;base64,'.base64_encode($groupData[$keys]['profile_image']);
		?>
	<div class="group_post group_div">
		<img src="<?php echo $uri;?>" class="group_image">
		<?php
		if (strlen($values ['description']) > 10) {
			echo "<p id=\"".$values ['id'] ."\" >". nl2br(htmlspecialchars(substr($values ['description'],0,10))) .'...' . "<a onclick=expand(" .$values ['id'] .",\"".addslashes($values ['description']."\"").");>.$lang->VIEWMORE.</a></p>";
		} else {
			echo "<p>". $values ['description'] . "</p>";
		}
	
		echo "<br/> ".$lang->POSTEDBY. "<a href='#'> " . $values ['first_name'] . " " . $values['middle_name'] . " " . $values['last_name']. "</a> ";
		echo $lang->ON ." ". $values ['created_on'] . "<br/>";
		if ($values ['created_by'] == $userId) {
			echo "<br/><a class='group_button' href='../controller/mainentrance.php?action=process_edit_post&groupId={$groupData1[0] ['id']}&postId={$values['id']}'>$lang->EDITPOST </a>";
		}
		?>
		<a class="group_button"
			href="javascript:viewComment(<?php echo $values['id'];?>)"><?php echo $lang->VIEWCOMMENT; ?></a><br />
	</div><br/>
	<?php
	}
	?>
</div>
<script type="text/javascript">
function expand(id,description) {
	$("#"+id).html("<p>"+description+"</p>");
}

</script>
