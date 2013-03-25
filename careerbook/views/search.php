<?php
    include_once('../classes/friendsClass.php');
    $AllUserData=unserialize($_SESSION['allUsers']);
    $allUserData= $AllUserData->getAllUsers();

?>
<center><h1><?php echo $AllUserData->countAllUsers();?> Result Found</h1>
<table id="frnd">
    <?php
    foreach($allUserData as $keys=>$values){
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