<?php
/***************************** Creation Log *******************************
File Name                   -  comments.php
Project Name                -  Careerbook
Description                 -  file for displaying discussion comments
Version                     -  1.0
Created by                  -  Prateek Saini
Created on                  -  April 04, 2013
*************************************************************************/
session_start();
require_once '../controller/userInfo.php';
$objUserInfo = unserialize($_SESSION['userData']);
$userID = $objUserInfo->getUserIdInfo();

if(isset($_SESSION['displayComments'])) {
    $resultSet = $_SESSION['displayComments'];
    $discussionID = $resultSet[0]['discussionID'];

unset($resultSet[0]['discussionID']);
//     echo "<pre/>";
//     print_r($resultSet);
//     die; 
    foreach ( $resultSet as $keys => $values ) {        
        foreach ( $values as $inkeys => $invalues ){
            if(isset($invalues['profile_image'])){
                if(!empty($invalues['profile_image'])){
                    $uri = 'data:image/png;base64,'.base64_encode($invalues['profile_image']);
                    ?>
                    <div id="commentWrapper">
                    <div id="commentImage">
                    <img src="<?php echo $uri;?>" width="35" height="30" class="group_image">
                    </div>
                    <?php
                }
            }
            if(isset($invalues['description'])){
                if(!empty($invalues['description'])){
                    ?>
                    <div id="displayComments<?php echo $invalues['id'] ?>" class="justComments displayComment">
                    <?php print nl2br(htmlspecialchars(($invalues['description']))); ?>
                    </div>
                    <?php                    
                }
            }
		    if($userID['id'] == $invalues['user_id'] ){        		         
		    ?>
		    <div id="delBtnTime">
		    <input type="button" id="<?php 
		    if(isset($invalues['id'])){
		        if(!empty($invalues['id'])){
		            echo $invalues['id'];
		        }
		    }
		    ?>" class="delete_comments_button" value="Delete Comment"/>
		    <?php }		    
            if(isset($invalues['first_name'])){
                if(!empty($invalues['first_name'])){
                    ?>
                    <span id="dispNameDateTime<?php echo $invalues['id'] ?>" class="custon_font floatRight textWhite dispNDT" >
                        <?php
                        print("Comment By ".$invalues['first_name']);
                        ?>                    
                    <?php
                }
            }
            if(isset($invalues['created_on'])){
                if(!empty($invalues['created_on'])){
                    ?>
                        <?php
                        $date = new DateTime($invalues['created_on']);
                        $dispDate = $date->format("d/m/Y");
                        $dispTime = $date->format("g:i A");
                        print("On ".$dispDate." at ".$dispTime);
                        ?>
                    </span>
                    </div>
                    </div>
                    <?php
                }
            }            
        }
    }
}
?>