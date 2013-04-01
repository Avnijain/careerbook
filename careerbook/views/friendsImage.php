<?php
		$objUserInfo = unserialize($_SESSION['userData']);
		$userData=$objUserInfo->getUserIdInfo();
                
?>
<img src="../controller/newImage.php?friends&userId=<?php echo $userData['id'];?>" alt="pic" width="98%" height="30%" style="{margin-bottom: 2%;}">