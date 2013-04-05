<link rel="stylesheet" type="text/css" href="../css/group.css"></link>
<?php 
	 include_once("../classes/lang.php"); 
	include_once('../classes/groupClass.php');
	$groupData = array();
	$noOfResult = 0;
	if (isset($_SESSION['groupSearch'])) {
		$groupData = unserialize($_SESSION['groupSearch']);
		$count = $groupData->countGroupSearchList();
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
			?>
			<strong><?php echo $count;?> Records Found</strong>
			<?php
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
		echo "$lang->TITLE"." ".htmlspecialchars(nl2br($values['title'])) . "<br/>";
		echo "$lang->GROUPDESCRIPTION"," ".htmlspecialchars(nl2br($values['description'])) . "<br/>";
		if (isset($values['status'])) {
			if($values['status'] == 'A') {
				echo "<a class='group_button' href=\"../controller/mainentrance.php?action=getPost&groupId={$values['id']}\">View</a>";
			} else if($values['status'] == 'D'){
				echo "<a class=\"group_button\" href=\"../controller/mainentrance.php?action=joinGroup&groupId={$values['id']}\">Join Group</a>";
			}
		}
		 if(!isset($values['status'])) {
			echo "<a class=\"group_button\" href=\"../controller/mainentrance.php?action=joinGroup&groupId={$values['id']}\">Join Group</a>";
		}
		?>
		
	</div>
	<br />
	<?php
	}
	unset($_SESSION['groupSearch']);
	?>
</div>
