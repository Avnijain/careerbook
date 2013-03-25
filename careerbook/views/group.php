<?php
//include_once('../classes/groupClass.php');
$groupData = array();
$groupData=unserialize($_SESSION['groupList']);


	foreach ($groupData as $keys=>$values) {
		?>
	<div>
		<?php
		echo "Id : " . $values['id'] . "<br/>";
		echo "Title : ". $values['title'] . "<br />";
		echo "Description : ". $values['description'] . "<br />";
		echo "Posted on ". $values['created_on'] . "<br/>";
		?>
		<br />
		<a
			href="../controller/mainentrance.php?action=getPost&groupId=<?php echo $values['id'];?>">View</a><a href="#">Unlink</a><br />
	</div>
	<?php
	}
	?>
