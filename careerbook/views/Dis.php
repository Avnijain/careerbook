<link rel="stylesheet" type="text/css" href="../css/group.css"></link>
<?php
include_once 'call.php';
?>

<!--<script type="text/javascript" src="../JavaScript/jquery-1.9.1.min.js"></script>-->
<script type="text/javascript" src="../JavaScript/jquery.tools.min.js"></script>
<link rel="stylesheet" type="text/css" href="../css/call.css" />

<style>
#overlay {
	background-image: url(../images/transparent.png);
	color: white;
	height: 400px;
	height: 400px;
}
/* container for external content. uses vertical scrollbar, if needed */
div.contentWrap {
	height: 400px;
	overflow-y: auto;
}

.apple_overlay {
	background-image: url("../images/white.png");
	display: none;
	font-size: 16px;
	padding: 35px;
	width: 580px;
}

.apple_overlay .close {
	background-image: url("../images/close4.png");
	cursor: pointer;
	height: 40px;
	position: absolute;
	right: 5px;
	top: 5px;
	width: 40px;
}
</style>
<script>

$(function() {
	 
    // if the function argument is given to overlay,
    // it is assumed to be the onBeforeLoad event listener
    $("a[rel]").overlay({
 
        mask: 'grey',

 
        onBeforeLoad: function() {
 
            // grab wrapper element inside content
            var wrap = this.getOverlay().find(".contentWrap");
 
            // load the page specified in the trigger
            wrap.load(this.getTrigger().attr("href"));
        }
 
    });
    $(".group_button").click(function(){
//         alert("My Comments + " + $(this).attr("id"));
//     	,function(data){
            $.post("../controller/mainentrance.php",{"action":"getComments"},function(data){
                alert(data);
            });        
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
		    ?>" class="group_button" value="View Comments"/>
		</div>
	</div><br/>
	<?php
	}
	}
?>
</div>
</div>


