<link rel="stylesheet" type="text/css" href="../css/group.css"></link>
<?php
    include_once('../classes/groupClass.php');
    $groupData=unserialize($_SESSION['groupList']);
    $groupData= $groupData->getGroupList();
    
    $objUserId = unserialize($_SESSION['userData']);
    $userData=$objUserId->getUserIdInfo();
    $userId = $userData['id'];
?>
<div class="button">
	<a class="btn blue"  onclick="addGroup()"><?php echo $lang->ADDGROUP;?></a>
	<a class="btn blue" href="../Home/userHomePage.php?searchGroup"><?php echo $lang->SEARCHGROUP;?></a>
</div>
<br/>
<div>
	<?php
	foreach ( $groupData as $keys => $values ) {
		?>
	<div class="group_header group_div">
	<?php
	if (($groupData[$keys]['group_image']) == NULL) {
		$uri = "../images/default-group.jpg";
	} else {
		$uri = 'data:image/png;base64,'.base64_encode($groupData[$keys]['group_image']);
	}
	
	?>
		<img src="<?php echo $uri;?>" class="group_image">
		<?php
		echo "<p>Title : " . nl2br(htmlspecialchars($values ['title'])) . "</p>";
		echo "<p>" . nl2br(htmlspecialchars($values ['description'])) . "</p>";
		if ($values ['created_by'] == $userId) {
			echo "<br/><a class=\"btn blue\" href=\"../controller/mainentrance.php?action=process_edit_group&groupId={$values['id']}\"> $lang->EDITGROUP</a>";
			echo "<a class=\"btn blue\" href=\"../controller/mainentrance.php?action=delete_group&groupId={$values['id']}\">$lang->DELETE</a>";
		}
		?>
			<a class="btn blue"
			href="../controller/mainentrance.php?action=getPost&groupId=<?php echo $values['id'];?>"><?php echo $lang->VIEW;?></a>
			<a  class="btn blue"
			href="../controller/mainentrance.php?action=unjoinGroup&groupId=<?php echo $values['id'];?>"><?php echo $lang->UNLINK;?></a>
	</div><br/>
	<?php
	}
?>
</div>
<script type="text/javascript">
		function addGroup() {
			url = "../View/add_group.php";
			$("#selectorLogin").attr("href",url);
	        $("#selectorLogin").trigger("click");
		    
		}

		function editGroup() {
			url = "../View/edit_group.php";
			$("#selectorLogin").attr("href",url);
	        $("#selectorLogin").trigger("click");
		    
		}
		
		$(document).ready(function() {

				$("#selectorLogin").fancybox({
		        'width'			: 450,
		        'height'		: 400,
		        'autoScale'		: true,
		        'transitionIn'	: 'none',
		        'transitionOut'	: 'none',
		        'type'			: 'iframe',
		        'onClosed'      : function() {
                    parent.location.reload(true);
                }
		    });
			
		});
</script>