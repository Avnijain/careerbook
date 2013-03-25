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
            ?>
            <?php
            echo "<td id='aid".$values['id']."'>";
            		if($values['status']=='F')
            		{
            			echo "<p class='frndStatus'>Friend</p>";
            		}
            		elseif($values['status']=='R')
            		{
            			echo "<p class='RequestStatus'>Request Pending</p>";
            		}
            		elseif($values['status']=='W')
            		{
            			echo "<p class='ReqSentstatus'>Request Sent</p>";
            		}            		
            		elseif($values['status']=='A')
            		{
            			echo "<input type='button' value='Add' onClick='addFrnd(".$values['id'].");'>";
            		}            
            ?></td>
            
        </tr>
        <?php
        }
    ?>
    
</table>
</center>
<script src="../JavaScript/jquery.min.js" type="text/javascript"></script>
<script src="../JavaScript/search.js"></script>
<style>
  #frnd td{
        border-top: 1px solid red;
        border-bottom:  solid 1px red;
    }
    .frndStatus{
    	width : 100%;
    	height: 100%;
    	background-color: green;
    }
    .RequestStatus{
    	width : 100%;
    	height: 100%;
    	background-color: red;
    }
    .ReqSentstatus{
    	width : 100%;
    	height: 100%;
    	background-color: blue;
    }
    
</style>