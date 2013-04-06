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
});
</script>
<div id="discussMain" class="dis">
    <div id="post_user_discussion">
    	<form id="form"
    		action="../controller/mainentrance.php?action=addUserPost" method="post">
    		<h2>Whats in Your Mind...</h2>
    		<div>
    			<textarea class="group_textarea" name="description" cols="25"
    				rows="06" placeholder="Description"></textarea>
    		</div>
    		<div>
    			<input class="group_button" type="submit" value="POST"
    				name="btnsubmit" />
    		</div>
    	</form>
    </div>
    <br/>
<div>
<?php
    include_once 'getMessages.php';
?>
</div>
</div>