<?php
include_once("../classes/lang.php");
?>
<center><div id="float-left">
	<?php
		$objUserInfo = unserialize($_SESSION['userData']);
		$userData=$objUserInfo->getUserPersonalInfo();
		$uri = 'data:image/png;base64,'.base64_encode($userData['profile_image']);
	?>
	
	<img id="profile-pic" alt="user" src="<?php echo $uri;?>" width="140" height="150">
</div></center>
<div id="float-left">
	<?php

					
	       echo "<b>$lang->USERNAME</b>    ".$userData['first_name']." ".$userData['last_name']."<br>";
	       echo "<b>$lang->GENDER</b>       ".$userData['gender']."<br>";
	       echo "<b>$lang->DOB</b>".$userData['date_of_birth'];
						       

	?>
</div>
