<?php
	include_once("../classes/lang.php");
    include_once('../classes/friendsClass.php');
    $AllUserData=unserialize($_SESSION['allUsers']);
    $allUserData= $AllUserData->getAllUsers();

?>
<center><h1><?php echo $AllUserData->countAllUsers();?><?php echo $lang->RESULTFOUND?></h1>
<table id="frnd">
    <?php
    foreach($allUserData as $keys=>$values){
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
            ?>
            <?php
            echo "<td id='aid".$values['id']."'>";
            		if($values['status']=='F')
            		{
            			echo "<p class='frndStatus'>$lang->FRIEND</p>";
            		}
            		elseif($values['status']=='R')
            		{
            			echo "<p class='RequestStatus'>$lang->REQUESTSENT</p>";
            		}
            		elseif($values['status']=='W')
            		{
            			echo "<p class='ReqSentstatus'>$lang->REQUESTPENDING</p>";
            		}            		
            		elseif($values['status']=='A')
            		{
						//echo "<div class="btn blue"><input type='button' value='Add' onClick='addFrnd(".$values['id'].");'></div>";
            			echo "<center><input type='button' class='btn blue' value='$lang->ADDASAFRIEND' onClick='addFrnd(".$values['id'].");'></center>";
            		}            
            ?></td>
            
        </tr>
        <?php
        }
    ?>
    
</table>
</center>

<script src="../JavaScript/search.js"></script>
<style>
  #frnd td{
        border-top: 1px solid blue;
        border-bottom:  solid 1px blue;
		border: 1px solid blue;
    }
    .frndStatus{
    	width : 100%;
    	height: 100%;
    	
    }
    .RequestStatus{
    	width : 100%;
    	height: 100%;
    	
    }
    .ReqSentstatus{
    	width : 100%;
    	height: 100%;
    	
    }
	.btn {
 display: inline-block;
 background: url(btn.bg.png) repeat-x 0px 0px;
 padding:5px 10px 6px 10px;
 font-weight:bold;
 text-shadow: 1px 1px 1px rgba(255,255,255,0.5);
 border:1px solid rgba(0,0,0,0.4);
 -moz-border-radius: 5px;
 -moz-box-shadow: 0px 0px 2px rgba(0,0,0,0.5);
 -webkit-border-radius: 5px;
 -webkit-box-shadow: 0px 0px 2px rgba(0,0,0,0.5);
}

.btn:hover {
 text-shadow: 1px 1px 1px rgba(0,0,0,0.5);
 cursor:pointer;
}

/* COLOR VARIATIONS */

.blue {background-color: #CCCCCC; color: #141414;}
.blue:hover {background-color: #00c0ff; color: #ffffff;}
* {
 margin:0px;
 padding:0px;
 border:0px;
 outline:0px;
}
</style>