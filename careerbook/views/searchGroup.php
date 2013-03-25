<?php 
$groupData = array ();
if (isset($_SESSION ['groupSearch'])) {
	$groupData = unserialize ( $_SESSION ['groupSearch'] );
}
?>
<div id="main">
	<form action="../controller/mainentrance.php?action=searchGroup" method="post">
		<label>Search Group</label> <input type="text" name="groupSearch"><input
			type="submit" value="Search">
	</form>
</div>
<div id="searchGroupResult">
	<h2>Search Results</h2>
	<?php 
	foreach ($groupData as $keys=>$values) {
		echo "Title : " .$values['title'] . "<br/>";
		echo "Description : " .$values['description'] . "<br/>";
		?>
		<a href="#">Join Group</a><br/>
		<?php
	}
	unset($_SESSION['groupSearch']);
	?>
</div>
