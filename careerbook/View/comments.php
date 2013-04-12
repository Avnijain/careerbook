<div id="discussionDisplay"></div>
<?php include_once 'getComments.php'; ?>
<textarea id="commentID" class="group_textarea" placeholder="Comment" rows="4" cols="50"></textarea>
<div id="commentError"></div>
<div id="commentLength"></div>
<?php if(isset($_GET['error'])){echo $_GET['error'];} ?>
<input type="submit" class="btn blue" id = "commentSubmit" value="post comment"></input>
<script src="../JavaScript/jquery-1.7.1.js"></script>
<script>
$(function(){
	$("#commentID").click(function(){
		$("#commentID").width("425");
		$("#commentID").height("70");
	});
	$( "#commentID" ).on("change keypress",function(){	
		if($("#commentID").val().length > 200){			
			var temp = $("#commentID").val();
			var subtemp = temp.substring(0,199);
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
    		if($("#commentID").val().length < 200 ){        		
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
	$("#discussionDisplay").ready(function(){
		var $temp = parent.$("#<?php echo $discussionID; ?>").parent().parent().text();
		$("#discussionDisplay").html($temp);
	});
	$(".justComments").mouseover(function(){
		var $str = $(this).attr("id");
		var $id = $str.substr(15,$str.length);		
		$("#dispNameDateTime"+$id).css("display","block");		 
	});
	$(".justComments").mouseout(function(){
		var $str = $(this).attr("id");
		var $id = $str.substr(15,$str.length);		
		$("#dispNameDateTime"+$id).css("display","none");		 
	});
});
</script>
<link href="../css/comment.css" rel="stylesheet" type="text/css" />