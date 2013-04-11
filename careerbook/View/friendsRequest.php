<?php
    include_once('../classes/friendsClass.php');
    include_once("../classes/lang.php");
    $friendsReqData=unserialize($_SESSION['FrndReq']);
    $myfrnd= $friendsReqData->getRequestedFriends();

?>
<center><h1><?php echo $lang->YOUHAVE;echo $friendsReqData->countReqFrnds()." ";echo $lang->FRIENDREQUEST;?> </h1>
<table id="frnd">
    <?php
    foreach($myfrnd as $keys=>$values){
        ?>
        <tr>
            <?php
            $uri = 'data:image/png;base64,'.base64_encode($values['profile_image']);
            echo "<td><img src='".$uri."' width='80px' height='80px'></td>";
            echo "<td><ul style='list-style: none; margin-left:5px;'>";
            echo "<li>".$values['first_name']." ".$values['middle_name']." ".$values['last_name']."</li>";
            echo "<li>".$values['gender']."</li>";
            echo "<li>".$values['email_primary']."</li>";
            echo "</ul></td>";
            echo "<td id='aid".$values['id']."'><input type='button'  class='btn blue' value='$lang->ACCEPT' onClick='frndAccept(".$values['id'].");'></td>";
            echo "<td id='cid".$values['id']."'><input type='button' class='btn blue' value='$lang->CANCEL' onClick='frndDelete(".$values['id'].");'></td>";
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
  #frnd td{
        border-top: 1px solid red;
        border-bottom:  solid 1px red;
    }
    
</style>