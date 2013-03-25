<div id="add_group">
	<form id="form" enctype="multipart/form-data"
		action="../controller/mainentrance.php?action=add_group" method="post">
		<h2>Create Group</h2>
		<p>
			<label>Title</label><br /> <input type="text" value="" name="title"
				id="title" />
		</p>
		<p>
			<label>Description</label><br />
			<textarea name="description" cols="25" rows="06"></textarea>
		</p>
		<p>
			<label>Group Image</label><br /> <input type="file"
				name="group_image" id="group_image" />
		</p>
		<p>
			<input type="submit" value="Create Group" name="btnsubmit" /> <input
				type="button" value="Cancel" />
		</p>
	</form>
</div>
