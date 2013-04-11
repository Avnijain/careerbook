<link rel="stylesheet" type="text/css" href="../css/group.css"></link>
<script type="text/javascript" src="../JavaScript/jquery-1.9.1.min.js"></script>
<script src="../JavaScript/jquery.validate.min.js"></script>
<script type="text/javascript" src="../JavaScript/group.js"> </script>
<?php 
include_once('../classes/groupClass.php');
$groupData=unserialize($_SESSION['postDetail']);
$groupData= $groupData->getPostDetail();
$groupId=$_REQUEST['groupId'];
$uri = 'data:image/png;base64,'.base64_encode($groupData[0]['profile_image']);
?>
<div id="groupPost">
	<form id="editPost_form"
		action="../controller/mainentrance.php?action=edit_post&postId=<?php echo $groupData[0]['id'];?>>"
		method="post">
		<input type="hidden" name="groupId" value="<?php echo $groupId;?>">
		<h2><?php echo $lang->EDITPOST;?></h2><br/>
		<img src="<?php echo $uri;?>" class="group_image">
		<?php echo "<br/><a href=\"#\"> " . $groupData[0] ['first_name'] . " " . $groupData[0]['middle_name'] . " " . $groupData[0]['last_name']. "</a><br/>";?>

		<textarea class="group_textarea" id="group_discussion_description" name="group_discussion_description" rows="6" cols="20"><?php if(isset($_SESSION['postDetail'])) echo nl2br($groupData[0]['description']);?></textarea>
		<br/><input class="btn blue" type="submit" value="<?php echo $lang->SUBMIT;?>">
	</form>
</div>