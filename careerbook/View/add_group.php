<?php
include_once("../classes/lang.php");
?>
<script src="../JavaScript/jquery-1.7.1.js"></script>
<script type="text/javascript" src="../JavaScript/fancybox/jquery.fancybox-1.3.4.js"></script>
<script type="text/javascript" src="../JavaScript/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="../JavaScript/fancybox/jquery.fancybox-1.3.4.css" ></link>
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
			<input class="btn blue" type="submit" value="Create Group" 
				name="btnsubmit" /> <input class="btn blue" type="button"
				value="Cancel" />
		</div>
	</form>
</div>
