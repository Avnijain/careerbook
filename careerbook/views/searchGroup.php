<link rel="stylesheet" type="text/css" href="../css/group.css"></link>
<?php 
	include_once('../classes/groupClass.php');
	$groupData = array();
	$noOfResult = 0;
	if (isset($_SESSION['groupSearch'])) {
		$groupData = unserialize($_SESSION['groupSearch']);
		$groupData = $groupData->getGroupSearchList();

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
<?php 
//echo "<pre>";
//print_r($groupData);
?>
<div id="searchGroupResult">
	<h2>
		<?php
		if (isset($_SESSION ['groupSearch'])) {
			//echo $noOfResult;
		}
		?>
	</h2><br/>
	<?php 
	foreach ($groupData as $keys=>$values) {
		?>
		<div class="group_list group_div">
		<?php 
		if (($groupData[$keys]['group_image']) == NULL) {
			$uri = "../images/default-group.jpg";
		} else {
			$uri = 'data:image/png;base64,'.base64_encode($groupData[$keys]['group_image']);
		}
		?>
		<img src="<?php echo $uri; ?>" class="group_image">
		<?php
		echo "Title : " .$values['title'] . "<br/>";
		echo "Description : " .$values['description'] . "<br/>";
		if($values['status'] == 'A') {
			echo "<a class='group_button' href=\"../controller/mainentrance.php?action=getPost&groupId={$values['id']}\">View</a>";
		} else {
			echo "<a class=\"group_button\" href=\"../controller/mainentrance.php?action=joinGroup&groupId={$values['id']}\">Join Group</a>";
		}
		?>
		
	</div>
	<br />
	<?php
	}
	//unset($_SESSION['groupSearch']);
	?>
</div>
