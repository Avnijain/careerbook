<?php
include_once("../classes/lang.php");
?>
<div class="post">
	<p>
    <?php
        $ip= $_SERVER['REMOTE_ADDR'];
        echo $lang->IPADDRESS;
        echo " " . $ip;
        echo "<br>";
        //echo $_SERVER['HTTP_USER_AGENT'];
    ?>
	</p>
	<div class="image">
		<a href="userHomePage.php?message"><img src="../images/message.jpg" alt="" width="90%"></a>
	</div>
	<div class="data">
	<?php
        require_once '../controller/message_controller.php';
        $objMessage1 = new MessageController();
        $count=$objMessage1->handleNewMessage();
        if(($count[0]['count(id)'])>=1) {
    ?>
    	<p style="color:red;"><?php echo $lang->NEWUSERMESSAGES?> </br>
            <?php  print($count[0]['count(id)']);?>
    	</p>
    <?php 
        }
        else {
	?>
	<p>
		<?php echo $lang->NONEWMESSAGES?>
	</p>
    <?php 
        }
    ?>
	</div>
</div>
<!-- /Post -->
<!-- Post -->
<div class="post last">
	<div class="image">
		<a href="userHomePage.php?FriendsRequest"><img src="../images/addFriends.jpg" alt="" width="90%"></a>
	</div>
	<div class="data">
	<?php
        include_once('../classes/friendsClass.php');
        $friendsReqData=unserialize($_SESSION['FrndReq']);
        $myFrndReqCount= $friendsReqData->countReqFrnds();
        //echo ($myFrndReqCount);
        if($myFrndReqCount>0) {
    ?>
    <p style="color:red;">
        <?php echo $lang->NEWFRIENDREQUEST?></br>
        <?php  print($myFrndReqCount);?>
    </p>	
    <?php 
        }
        else {
    ?>
    <p>
        <?php echo $lang->NONEWFRIENDREQUEST?>
    </p>
    <?php 
        }
    ?>
</div>
</div>
<!-- /Post -->
<div class="cl">&nbsp;</div>