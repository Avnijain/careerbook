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
                    <p>
                    <div style="float:left">
                    <img src="<?php echo $uri;?>" width="35" height="30" class="group_image">
                    </div>
                    <?php
                }
            }
            if(isset($invalues['description'])){
                if(!empty($invalues['description'])){
                    ?>
                    <div id="displayComments" style="float:left;border:0.1em solid; min-width:350px; max-width:350px; word-wrap:break-word; background-color:#efefee;  ">
                    <?php print nl2br(($invalues['description'])); ?>
                    </div>
                    <?php                    
                }
            }
		    if($userID['id'] == $invalues['user_id'] ){        		         
		    ?>
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
                    <span style="font-family: arial,sans-serif;font-size: 12px;float:right;">
                        <?php
                        print($invalues['first_name']);
                        ?>                    
                    <?php
                }
            }
            if(isset($invalues['created_on'])){
                if(!empty($invalues['created_on'])){
                    ?>
                        <?php
                        print($invalues['created_on']);
                        ?>
                    </span>
                    </p>
                    <?php
                }
            }            
        }
    }
}
?>
<textarea id="commentID" class="group_textarea" placeholder="Comment" rows="4" cols="50"></textarea>
<div id="commentError"></div>
<div id="commentLength"></div>
<input type="submit" id = "commentSubmit" value="post comment"></input>
<script src="../JavaScript/jquery-1.7.1.js"></script>
<script>
$(function(){
	$("#commentID").click(function(){
		$("#commentID").width("425");
		$("#commentID").height("70");
	});
	$( "#commentID" ).on("change keypress",function(){	
		if($("#commentID").val().length >= 200){			
			var temp = $("#commentID").val();
			var subtemp = temp.substring(0,200);
			$("#commentID").val(subtemp);
			$("#commentError")
    		.html("<div style=\"display=\"block\";\" id=\"errorDisplay\"><h4>Max 200 chars Allowed</h4></div>");
    		$("#errorDisplay").fadeOut(3000);			
		}			
		$("#commentLength").html($("#commentID").val().length + "chars");
		
	});
    $(".delete_comments_button").click(function(){
    	id = $(this).attr("id");
        $.post("../controller/mainentrance.php",{"action":"deleteCommentPost","discussionComment":id},function(data,status){
			if(status=="success")
			{
				parent.$("#<?php echo $discussionID; ?>").trigger("click");				
			}
        });
    });
	$("#commentSubmit").click(function(){
		if($("#commentID").val().length > 0 ){
    		if($("#commentID").val().length <= 200 ){        		
    			$.post("../controller/mainentrance.php",{"action":"postComment",
    				"comment":$("#commentID").val(),
    				"discussionID":"<?php echo $discussionID; ?>"},function(data,status){ 
    					parent.$("#<?php echo $discussionID; ?>").trigger("click");
    				});
    		}else{
        		$("#commentID")
        		.after("<div style=\"display=\"block\";\" id=\"errorDisplay\"><h4>Comment Must be within 200 chars</h4></div>");
        		$("#errorDisplay").fadeOut(3000);
        		return false;
    		}
		}else{
			$("#commentID").after("<div style=\"display=\"block\";\" id=\"errorDisplay\"><h4>Empty Comments Not allowed</h4></div>")
			$("#errorDisplay").fadeOut(3000);
			return false;
		}
	});
});
</script>