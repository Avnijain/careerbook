<?php 
include_once('../classes/groupClass.php');
$groupData=unserialize($_SESSION['postDetail']);
$groupData= $groupData->getPostDetail();

?>
<link rel="stylesheet" type="text/css" href="../css/group.css"></link>
<div id="groupPost">
	<form
		action="../controller/mainentrance.php?action=edit_post&postId=<?php echo $groupData[0]['id'];?>;?>"
		method="post">
		<h2><?php echo $lang->EDITPOST;?></h2><br/>
		<textarea class="group_textarea" name="group_discussion_description" rows="6" cols="20"><?php echo nl2br($groupData[0]['description']);?></textarea>
		<input type="hidden" name="groupId" value="">
		<br/><input class="group_button" type="submit" value="Post">
	</form>
</div>