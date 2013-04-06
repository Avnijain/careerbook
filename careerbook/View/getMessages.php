<?php
/*
**************************** Creation Log *******************************
File Name                   -  getMessages.php
Project Name                -  Careerbook
Description                 -  Fetch User Discussion Posts from Friends 
							   Controller 
Version                     -  1.0
Created by                  -  Prateek Saini
Created on                  -  April 02, 2013
***************************** Update Log ********************************
Sr.NO.		Version		Updated by           Updated on          Description
-------------------------------------------------------------------------
*************************************************************************
*/ 
//ini_set("display_errors",1); // To Enable Error Display
include_once "../controller/friends_controller.php";
require_once '../controller/userInfo.php';

    $frndDisData = array();
    $frndDisData = $objFrndControl->start('getFrndsDis');
    $objUserInfo = unserialize($_SESSION['userData']);
    $userID = $objUserInfo->getUserIdInfo();
//  		print_r($frndDisData[0][0]['first_name']);
//  		die;    
    foreach ( $frndDisData as $keys => $values ) {
        foreach ( $values as $inkeys => $invalues ){
            if($invalues['first_name'] != "Administrator"){
                if(isset($invalues['profile_image'])){
                    if(!empty($invalues['profile_image'])){
                        $uri = 'data:image/png;base64,'.base64_encode($invalues['profile_image']);
                    }
                }
?>
    			<div class="group_list group_div">
    			<img src="<?php echo $uri;?>" class="group_image">
                <?php
    //  		print_r($values);
    //  		die;
                if(isset($invalues['first_name'])){
        		    if(!empty($invalues['first_name'])){		
        		        echo "$invalues[first_name]";
        		    }
        		}
        		if(isset($invalues['discussion'])){
        		    if(!empty($invalues['discussion'])){		
        		        echo " : " . nl2br($invalues['discussion']) 
        		        . "<br />";
        		    }
        		}
//echo "Comments : " . $invalues['comments'] . "<br />";
                ?>
        		<div>
        		    <input type="button" id="<?php 
        		    if(isset($invalues['id'])){
        		        if(!empty($invalues['id'])){
        		            echo $invalues['id'];
        		        }
        		    }
        		    ?>" class="view_comments_button" value="View Comments"/>
        		    <?php
        		    if($userID['id'] == $invalues['user_id'] ){        		         
        		    ?>
        		    <input type="button" id="<?php 
        		    if(isset($invalues['id'])){
        		        if(!empty($invalues['id'])){
        		            echo $invalues['id'];
        		        }
        		    }
        		    ?>" class="delete_post_button" value="Delete Post"/>
        		    <?php } ?>
        		</div>
		</div>
	    <?php
            }
            else{
                 if(isset($invalues['profile_image'])){
                    if(!empty($invalues['profile_image'])){
                        $uri = 'data:image/png;base64,'.base64_encode($invalues['profile_image']);
                    }
                }
                ?>
    			<div class="group_list group_div">
    			<img src="<?php echo $uri;?>" class="group_image">
                <?php
                if(isset($invalues['first_name'])){
        		    if(!empty($invalues['first_name'])){
        		        echo "$invalues[first_name]";
        		    }
        		}
        		if(isset($invalues['discussion'])){
        		    if(!empty($invalues['discussion'])){
        		        echo " : " . nl2br($invalues['discussion'])
        		        . "<br />";
        		    }
        		}
        		?>    		
        		</div>
        		<?php
            }
	    }
	}
?>