<?php
include_once("../classes/lang.php");
include_once ('../classes/friendsClass.php');
$friendsData = unserialize ( $_SESSION ['myFriends'] );
$myfrnd = $friendsData->getMyFriendsNetwork ();
// echo $lang->KEY;

// $encrypted = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $lang->KEY, '17', MCRYPT_MODE_ECB);
// echo $encrypted;
?>
<center>
	<h1><?php echo $lang->YOUHAVE ; echo $friendsData->countMyFriends(); echo " "; echo $lang->FRIENDS;?></h1>
	<table id="frnd">
    <?php
				foreach ( $myfrnd as $keys => $values ) {
					?>
        <tr>
            <?php
					$uri = 'data:image/png;base64,' . base64_encode ( $values ['profile_image'] );
					echo "<td><img src='" . $uri . "' width='80px' height='80px'></td>";
					echo "<td><ul style='list-style: none; margin-left:5px;'>";
					echo "<li>" . $values ['first_name'] . " " . $values ['middle_name'] . " " . $values ['last_name'] . "</li>";
					echo "<li>" . $values ['gender'] . "</li>";
					echo "<li>" . $values ['email_primary'] . "</li>";
					echo "</ul></td>";
					$str= date('ymd');
					$time=strtotime($str);
					$hash=md5($time.$lang->KEY.$values ['id']);
					
					echo "<input type='hidden' value=".$hash." id='hash_code".$values ['id']."'>";
					echo "<td id='aid" . $values ['id'] . "'><input type='button' class='btn blue' value='View' onClick='viewFrnd(" . $values ['id'] . ");'></td>";
					echo "<td id='cid" . $values ['id'] . "'><input type='button' class='btn blue' value='Delete' onClick='frndDelete(" . $values ['id'] . ");'></td>";
					?>
        </tr>
        <?php
				}
				?>
    
</table>
</center>

<!--
<script src="../JavaScript/jquery.min.js" type="text/javascript"></script>-->
<script src="../JavaScript/friends.js"></script>

<style>
#frnd td {
	border-top: 1px solid blue;
	border-bottom: solid 1px blue;
}
</style>