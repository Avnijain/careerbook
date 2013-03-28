<link rel="stylesheet" type="text/css" href="../css/group.css"></link>
<?php
include_once 'call.php';
?>
<head>
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
});
</script>

</head>
<body>
	<div id="discussMain" class="dis">

		<div id="addPost">
			<a href="../views/userHomePage.php?addUserPost" class="group_button">ADD
				POST</a>
		</div>
<?php
$cal = 0; // check odd even div

//print_r ($frndDisData);
?>
<div>
<?php 
foreach ( $frndDisData as $keys => $values ) {
	?>
	<div class="group_list group_div">
		<img src="../images/default-group.jpg" class="group_image">
		<?php
		echo "Description : " . $values ['description'] . "<br />";
		?>
		<br />
		<div>
			<a class="group_button"
			href="../controller/mainentrance.php?action=getPost&groupId=<?php echo $values['id'];?>">View</a>
			<a  class="group_button"
			href="../controller/mainentrance.php?action=unjoinGroup&groupId=<?php echo $values['id'];?>">Unlink</a>
		</div>
	</div><br/>
	<?php
	}
?>
</div>
</div>


