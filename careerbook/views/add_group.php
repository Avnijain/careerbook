<link rel="stylesheet" type="text/css" href="../css/group.css"></link>
<script type="text/javascript" src="../JavaScript/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="../JavaScript/group.js"> </script>
<div id="add_group">
	<form id="add_group_form" enctype="multipart/form-data"
		action="../controller/mainentrance.php?action=add_group" method="post">
		<h2>Create Group</h2>
		<div>
			<label>Title</label><br />
			<input class="group_textbox" type="text" placeholder="Group Title"
				value="" name="title" id="title" />
		</div>
		<br /> <br />
		<div>
			<label>Description</label><br />
			<textarea class="group_textarea" name="description" cols="25"
				rows="06" placeholder="Group Description"></textarea>
		</div>
		<div>
			<label>Group Image</label><br /> <input type="file"
				name="group_image" id="group_image" />
		</div><br/>
		<div>
			<input class="group_button" type="submit" value="Create Group"
				name="btnsubmit" /> <input class="group_button" type="button"
				value="Cancel" />
		</div>
	</form>
</div>
