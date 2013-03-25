<div id="float-left">
	<img id="profile-pic" alt="user" src="../images/user_men.jpeg" width="140" height="150">
</div>
<div id="float-left">
	<?php
		$objUserInfo = unserialize($_SESSION['userData']);
		$userData=$objUserInfo->getUserPersonalInfo();
					
	       echo "<b>User Name:</b>    ".$userData['first_name']." ".$userData['last_name']."<br>";
	       echo "<b>Gender:</b>       ".$userData['gender']."<br>";
	       echo "<b>Date of Birth:</b>".$userData['date_of_birth'];
						       

	?>
</div>