<?php include_once("../classes/lang.php"); ?>
<link rel="stylesheet" type="text/css" href="../css/group.css"></link>
<script type="text/javascript" src="../JavaScript/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="../JavaScript/group.js"> </script>
<div id="add_group">
	<form id="add_group_form" enctype="multipart/form-data"
		action="../controller/mainentrance.php?action=add_group" method="post">
		<h2><?php echo $lang->CREATEGROUP;?></h2>
		<div>
			<label><?php echo $lang->TITLE;?></label><br />
			<input class="group_textbox" type="text" placeholder="Group Title"
				value="" name="title" id="title" />
		</div>
		<br /> <br />
		<div>
			<label><?php echo $lang->GROUPDESCRIPTION;?></label><br />
			<textarea class="group_textarea" name="description" id="description" cols="25"
				rows="06" placeholder="Group Description"></textarea>
		</div>
		<div>
			<label><?php echo $lang->GROUPIMAGE;?></label><br /> <input type="file"
				name="group_image" id="group_image" />
		</div><br/>
		<div>
			<input class="group_button" type="submit" value="Create Group"
				name="btnsubmit" /> <input class="group_button" type="button"
				value="Cancel" />
		</div>
	</form>
</div>
