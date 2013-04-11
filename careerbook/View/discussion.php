<?php 
/*
**************************** Creation Log *******************************
File Name                   -  Discussions.php
Project Name                -  Careerbook
Description                 -  View File to display user discussions
Version                     -  1.0
Created by                  -  Prateek Saini
Created on                  -  March 31, 2013
***************************** Update Log ********************************
Sr.NO.		Version		Updated by           Updated on          Description
-------------------------------------------------------------------------
*************************************************************************
*/
?>
<link rel="stylesheet" type="text/css" href="../css/group.css"></link>
<!--<script type="text/javascript" src="../JavaScript/jquery-1.9.1.min.js"></script>-->
<link rel="stylesheet" type="text/css" href="../css/call.css" />
<script>
$(function() {
	var screenW = 1024, screenH = 768;
    $(".view_comments_button").click(function(){
    	id = $(this).attr("id");
        $.post("../controller/mainentrance.php",{"action":"getComments","discussionComment":id},function(data,status){
			if(status=="success")
			{
    	        var url = "../View/comments.php";
    	        $('#selectorLogin').attr("href",url);
    			$("#selectorLogin").trigger("click");
			}
        });
    });
    $(".delete_post_button").click(function(){
    	id = $(this).attr("id");
        $.post("../controller/mainentrance.php",{"action":"deleteDiscussionPost","discussionComment":id},function(data,status){
			if(status=="success")
			{
				location.reload();
			}
        });
    });
	$("#selectorLogin").fancybox({
        'width'			: screenW/2,
        'height'		: screenH/2+60,
        'autoScale'		: false,
        'transitionIn'		: 'none',
        'transitionOut'		: 'none',
        'type'			: 'iframe'
    });
	$("#textAreaDiscussions").click(function(){
		$("#textAreaDiscussions").width("425");
		$("#textAreaDiscussions").height("70");
	});
	$( "#textAreaDiscussions" ).on("change keypress",function(){	
		if($("#textAreaDiscussions").val().length > 400){			
			var temp = $("#textAreaDiscussions").val();
			var subtemp = temp.substring(0,399);
			$("#textAreaDiscussions").val(subtemp);
			$("#discussionError")
    		.html("<div style=\"display=\"block\";\" id=\"errorDisplay\"><h4>Max 400 chars Allowed</h4></div>");
    		$("#errorDisplay").fadeOut(3000);			
		}
	});
	$("#form").submit(function(){
		if($("#textAreaDiscussions").val().length > 0 ){
    		if($("#textAreaDiscussions").val().length < 399 ){
        		return true; 
    		}else{
        		$("#discussionError")
        		.html("<div style=\"display=\"block\";\" id=\"errorDisplay\"><h4>Discussions Must be within 400 chars</h4></div>");
        		$("#errorDisplay").fadeOut(3000);
        		return false;
    		}
		}else{
			$("#discussionError").html("<div style=\"display=\"block\";\" id=\"errorDisplay\"><h4>Empty Discussions Not allowed</h4></div>");
			$("#errorDisplay").fadeOut(3000);
			return false;
		}
	});
});
</script>
<div id="discussMain" class="dis">
    <div id="post_user_discussion">
    	<form id="form"
    		action="../controller/mainentrance.php?action=addUserPost" method="post">
    		<h2>Whats in Your Mind...</h2>
    		<div>
    			<textarea id="textAreaDiscussions" class="group_textarea" name="description" cols="25"
    				rows="06" placeholder="Description"></textarea>
    		</div>
    		<div>
    			<input class="btn blue" type="submit" value="POST"
    				name="btnsubmit" />
    		</div>
    	</form>
<div id="discussionError"></div>
<div id="discussionLength"></div>    	
    </div>
    <br/>
<div>
<?php
    include_once 'getMessages.php';
?>
</div>
</div>