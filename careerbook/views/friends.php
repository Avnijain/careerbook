<?php
if($_SESSION['request']=='result')
{
    include_once('../classes/friendsClass.php');
    //echo $_SESSION['myFriends'];
    $friendsData=unserialize($_SESSION['myFriends']);
    $myfrnd= $friendsData->getMyFriendsNetwork();
//echo "<pre>";
  //  print_r($myfrnd);
}
?>
<center><h1>You Have <?php echo $friendsData->countMyFriends();?> Friends</h1>
<table id="frnd">
    <?php
    foreach($myfrnd as $keys=>$values){
        ?>
        <tr>
            <?php
            echo "<td><img src='../images/a6.jpg' width='80px' height='80px'></td>";
            echo "<td><ul style='list-style: none; margin-left:5px;'>";
            echo "<li>".$values['first_name']." ".$values['middle_name']." ".$values['last_name']."</li>";
            echo "<li>".$values['gender']."</li>";
            echo "<li>".$values['email_primary']."</li>";
            echo "</ul></td>";
            echo "<td>".$values['status']."</td>";
            ?>
        </tr>
        <?php
        }
    ?>
    
</table>
</center>
<style>
  #frnd td{
        border-top: 1px solid red;
        border-bottom:  solid 1px red;
    }
    
</style>