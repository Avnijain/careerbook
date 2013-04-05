<link rel="stylesheet" type="text/css" href="../css/group.css"></link>
<?php
include_once 'getMessages.php';
?>

<!--<script type="text/javascript" src="../JavaScript/jquery-1.9.1.min.js"></script>-->

<script src="../JavaScript/jquery-1.7.1.js"></script>
<script type="text/javascript" src="../JavaScript/fancybox/jquery.fancybox-1.3.4.js"></script>
<script type="text/javascript" src="../JavaScript/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="../JavaScript/fancybox/jquery.fancybox-1.3.4.css" ></link>


<link rel="stylesheet" type="text/css" href="../css/call.css" />

<script>
$(function() {
	var screenW = 640, screenH = 480;
    $(".view_comments_button").click(function(){
//         alert("My Comments + " + $(this).attr("id"));
//     	,function(data){
	id = $(this).attr("id");
            $.post("../controller/mainentrance.php",{"action":"getComments","discussionComment":id},function(data){
        		url = "../View/comments.php";
        		$("#selectorLogin").attr("href",url);
                $("#selectorLogin").trigger("click");
					//alert(data);
                
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

		<a href="javascript:void(0)" id="selectorLogin"></a>
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
</div><br/>
<?php
$cal = 0; // check odd even div

//print_r ($frndDisData);
?>
<div>
<?php 
foreach ( $frndDisData as $keys => $values ) {
foreach ( $values as $inkeys => $invalues ){
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
		if(isset($invalues['discussion'])){
		    if(!empty($invalues['discussion'])){		
		        echo "Description : " . nl2br($invalues['discussion']) . "<br />";
		    }
		}
		//echo "Comments : " . $invalues['comments'] . "<br />";
		?>
		<br />
		<div>
		    <input type="button" id="<?php 
		    if(isset($invalues['id'])){
		        if(!empty($invalues['id'])){
		            echo $invalues['id'];
		        }
		    }
		    ?>" class="view_comments_button" value="View Comments"/>
		</div>
	</div><br/>
	<?php
	}
	}
?>
</div>
</div>


