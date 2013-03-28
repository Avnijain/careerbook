<link rel="stylesheet" type="text/css" href="../css/group.css"></link>
<div id="post_user_discussion">
	<form id="form"
		action="../controller/mainentrance.php?action=addUserPost" method="post">
		<h2>Post Message</h2>
		<div>
			<label>Description</label><br />
			<textarea class="group_textarea" name="description" cols="25"
				rows="06" placeholder="Description"></textarea>
		</div>
		<div>
			<input class="group_button" type="submit" value="POST"
				name="btnsubmit" /> <input class="group_button" type="button"
				value="Cancel" />
		</div>
	</form>
</div>