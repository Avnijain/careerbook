<?php 
include_once('../classes/groupClass.php');
$groupData=unserialize($_SESSION['groupDetail']);
$groupData= $groupData->getGroupDetail();

?>
<link rel="stylesheet" type="text/css" href="../css/group.css"></link>

<div id="add_group">
	<form id="edit_group_form" enctype="multipart/form-data"
		action="../controller/mainentrance.php?action=edit_group&groupId=<?php echo $groupData[0]['id'];?>" method="post">
		<h2><?php echo $lang->EDITGROUP?></h2>
		<div>
			<label><?php echo $lang->TITLE;?></label><br />
			<input class="group_textbox" type="text" placeholder="Group Title"
				value="<?php echo $groupData[0]['title'];?>" name="title" id="title" />
		</div>
		<br /> <br />
		<div>
			<label><?php echo $lang->GROUPDESCRIPTION;?></label><br />
			<textarea class="group_textarea" name="description" cols="25"
				rows="06"><?php echo nl2br($groupData[0]['description']);?></textarea>
		</div>
		<div>
			<label><?php echo $lang->GROUPIMAGE;?></label><br /> <input type="file"
				name="group_image" id="group_image" />
		</div><br/>
		<div>
			<input class="group_button" type="submit" value="Edit Group"
				name="btnsubmit" /> <input class="group_button" type="button"
				value="Cancel" />
		</div>
	</form>
</div>
