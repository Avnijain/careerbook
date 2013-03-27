<link rel="stylesheet" type="text/css" href="../css/group.css"></link>
<?php 
$groupData = array ();
if (isset($_SESSION ['groupSearch'])) {
	$groupData = unserialize ( $_SESSION ['groupSearch'] );

	$searchGroup = count($groupData) . " Result Found";
}
?>
<div id="main">
	<form action="../controller/mainentrance.php?action=searchGroup"
		method="post">
		<input class="group_textbox" type="text" placeholder="Search Group"
			name="groupSearch"> <input class="group_button" type="submit"
			value="Search">
	</form>
</div>
<br />
<div id="searchGroupResult">
	<h2>
		<?php
		if (isset($_SESSION ['groupSearch'])) {
			echo $searchGroup;
		}?>
	</h2><br/>
	<?php 
	foreach ($groupData as $keys=>$values) {
		?>
	<div class="group_list">
		<?php
		echo "Title : " .$values['title'] . "<br/>";
		echo "Description : " .$values['description'] . "<br/>";
		?>
		<a class="group_button"
			href="../controller/mainentrance.php?action=joinGroup&groupId=<?php echo $values['id'];?>">Join
			Group</a>
	</div>
	<br />
	<?php
	}
	unset($_SESSION['groupSearch']);
	?>
</div>
