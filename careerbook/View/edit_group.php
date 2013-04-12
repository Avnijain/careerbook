<?php 



?>
<link rel="stylesheet" type="text/css" href="../css/group.css"></link>
<script type="text/javascript" src="../JavaScript/jquery-1.9.1.min.js"></script>
<script src="../JavaScript/jquery.validate.min.js"></script>
<script type="text/javascript" src="../JavaScript/group.js"> </script>

<div id="add_group">
	<form id="edit_group_form" enctype="multipart/form-data"
		action="../controller/mainentrance.php?action=edit_group&groupId=<?php echo $groupData[0]['id'];?>" method="post">
		<h2><?php echo $lang->EDITGROUP?></h2>
		<div>
			<label><?php echo $lang->TITLE;?></label><br />
			<input class="group_textbox" type="text" placeholder="Group Title"
				value="<?php echo $groupData[0]['title'];?>" name="title" id="title" /><br/>
				<?php
                       if(isset($_GET['errno'])) {
                           if($_GET['errno'] == 5) {
                               echo $lang->TITLEERROR;
                           }
                       }
                       ?>
		</div>
		<br /> <br />
		<div>
			<label><?php echo $lang->GROUPDESCRIPTION;?></label><br />
			<textarea class="group_textarea" name="description" cols="25" id="description"
				rows="06"><?php echo nl2br($groupData[0]['description']);?></textarea><br/>
				<?php
        		if(isset($_GET['errno'])) {
        		    if($_GET['errno'] == 6)
        		        echo $lang->DESCRIPTIONERROR;
        		}
        		?>
		</div>
		<div>
		    <?php $uri = 'data:image/png;base64,'.base64_encode($groupData[0]['group_image']); ?>
		    <img src="<?php echo $uri;?>" class="group_image">
			<label><?php echo $lang->GROUPIMAGE;?></label><br /> <input class="btn blue" type="file"
				name="group_image" id="group_image" />
		</div><br/><br/>
		<?php
        		if(isset($_GET['errno'])) {
        		   if($_GET['errno'] == 7) {
				 		echo $lang->IMAGENOTCORRECT;
					} elseif($_GET['errno'] == 8) {
						echo $lang->IMAGEINCORRECT;
					}
        		}
       ?>
		<div>
			<input class="btn blue" type="submit" value="Edit Group"
				name="btnsubmit" /> <input class="btn blue" type="button"
				value="Cancel" />
		</div>
	</form>
</div>
