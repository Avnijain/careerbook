
<?php
include_once 'call.php'; 
?>
<head>
<!--<script type="text/javascript" src="../JavaScript/jquery-1.9.1.min.js"></script>-->
<script type="text/javascript" src="../JavaScript/jquery.tools.min.js"></script>
<link rel="stylesheet" type="text/css" href="../css/call.css"/>

<style>
 #overlay {
    background-image:url(../images/transparent.png);
    color:white;
    height:400px;
	height:400px;
  }
  /* container for external content. uses vertical scrollbar, if needed */
  div.contentWrap {
    height:400px;
    overflow-y:auto;
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
<center>
<div id="addPost"><input type="button" value="Add Post"></div>
<?php
$cal=0;  // check odd even div
foreach($images as $i){
	if($cal%2==0){
?>
	<div id=<?php echo "even"?> class="myDiscuss">
 		<div class="disInfo" id="hhhh"><a href="new.php?<?php echo $i[0];?>&amp;<?php echo $cal;?>" rel="#overlay" id="<?php echo $cal;?>" style="text-decoration:none"><img id="<?php echo $cal;?>" src="../images/<?php echo $i[0];?>" alt="User Pic"/></a></div>
		<div class="disInfo"><div class="bubbleLeft" id="<?php echo $cal;?>"><p id="text"><?php echo $i[1];?></p></div></div>
	
	</div>

<?php 
	}
	else {
?>
	<div id=<?php echo "odd"?> class="myDiscuss">
	<div class="disInfo"><div class="bubbleRight" id="<?php echo $cal;?>"><p id="text"><?php echo $i[1];?></p></div></div>
	<div class="disInfo"><a href="new.php?<?php echo $i[0];?>&amp;<?php echo $cal;?>" rel="#overlay" id="<?php echo $cal;?>" style="text-decoration:none"><img id="<?php echo $cal;?>" src="../images/<?php echo $i[0];?>" alt="User Pic"/></a></div>
	</div>

<?php 
	}
	$cal++;
}
?>
</center>
<!-- overlayed element -->
<div class="apple_overlay" id="overlay">
  <!-- the external content is loaded inside this tag -->
  <div class="contentWrap"></div>
</div>
</div>
</body>
