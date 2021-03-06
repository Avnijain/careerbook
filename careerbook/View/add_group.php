<link rel="stylesheet" type="text/css" href="../css/group.css"></link>
<script type="text/javascript" src="../JavaScript/jquery-1.9.1.min.js"></script>
<script src="../JavaScript/jquery.validate.min.js"></script>
<script type="text/javascript" src="../JavaScript/group.js"> </script>

<div id="add_group">
	<form id="add_group_form" enctype="multipart/form-data"
		action="../controller/mainentrance.php?action=add_group" method="post">
		<h2><?php echo $lang->CREATEGROUP;?></h2>
		<div>
			<label><?php echo $lang->TITLE;?></label><br />
			<input class="group_textbox" type="text" placeholder="Group Title"
				value="" name="title" id="title" /><br/>
				<?php
                       if(isset($_GET['errno'])) {
                           if($_GET['errno'] == 3) {
                               echo $lang->TITLEERROR;
                           } 
                       }
                       ?>
		</div>
		<br /> <br />
		<div>
			<label><?php echo $lang->GROUPDESCRIPTION;?></label><br />
			<textarea class="group_textarea" name="description" id="description" cols="25"
				rows="06" placeholder="Group Description"></textarea><br/>
				<?php
        		if(isset($_GET['errno'])) {
        		    if($_GET['errno'] == 4)
        		        echo $lang->DESCRIPTIONERROR;
        		}
        		?>
		</div>
		<div>
			<label><?php echo $lang->GROUPIMAGE;?></label><br /> <input type="file"
				name="group_image" id="group_image" class="btn blue" />
		</div><br/>
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
			<input class="btn blue" type="submit" value="Create Group" 
				name="btnsubmit" /> <input class="btn blue" type="button"
				value="Cancel" onclick="cancelAddGroup()" />
		</div>
	</form>
</div>