<link rel="stylesheet" type="text/css" href="../css/group.css"></link>
<div  class="group_header group_div">
	<img src="<?php echo $uri1;?>" class="group_image">
		<?php
		echo "<p>" . $lang->GROUPDESCRIPTION .": " . nl2br(htmlspecialchars($groupData1[0] ['description'])) . "</p>";
		echo $lang->POSTEDBY . " <a href=\"#\"> " . $groupData1[0] ['first_name'] . " " . $groupData1[0]['middle_name'] . " " . $groupData1[0]['last_name']." </a>";
		echo $lang->ON ." " . $groupData1[0] ['created_on'] . "";
		?>
</div><br/>
<div id="groupDiscussionComment">
	<form id="groupDiscussionComment_form"
		action="../controller/mainentrance.php?action=addComment&groupDiscussionId=<?php echo $groupData1[0] ['id'];?>"
		method="post">
		<p>
			<textarea class="group_textarea" id="group_discussion_comment" name="group_discussion_comment" rows="6" cols="20" placeholder="Post Comment..."></textarea>
		</p>
		<?php
		if(isset($_GET['errno'])) {
		    echo $lang->COMMENTERROR;
		}
		?>
		<br/>
		<input type="submit" value="<?php echo $lang->POST;?>" class="btn blue">
	</form>
</div><br/>
<div>
	<?php
	
	foreach ( $groupData as $keys => $values ) {
		$uri = 'data:image/png;base64,'.base64_encode($groupData[$keys]['profile_image']);
		?>
	<div class="group_comment group_div">
		<img src="<?php echo $uri;?>" class="group_image">
		<?php
		echo "" . nl2br(htmlspecialchars($values ['description'])) . " <br />";
		echo $lang->POSTEDBY . " <a href=\"#\">" . $values ['first_name'] . " " . $values['middle_name'] . " " . $values['last_name']. " </a>";
		echo $lang->ON ." " . $values ['created_on'] . "<br/>";
		if ($values ['created_by'] == $userId) {
			echo "<br/><a class='btn blue' href='javascript:deleteComment(".$values['id'].",".$groupData1[0] ['id'].")'>$lang->DELETE</a>";
		}
		?>
		
	</div>
	<?php
	}
	?>
</div>