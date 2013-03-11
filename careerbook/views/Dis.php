
<?php
include_once 'call.php'; 
?>
<head>
<script type="text/javascript" src="../JavaScript/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="../JavaScript/jquery.tools.min.js"></script>
<link rel="stylesheet" type="text/css" href="../css/call.css"/>

<style>
 #overlay {
    background-image:url(../images/transparent.png);
    color:#efefef;
    height:450px;
  }
  /* container for external content. uses vertical scrollbar, if needed */
  div.contentWrap {
    height:441px;
    overflow-y:auto;
  }
.apple_overlay {
    background-image: url("../images/white.png");
    display: none;
    font-size: 11px;
    padding: 35px;
    width: 640px;
}
.apple_overlay .close {

    cursor: pointer;
    height: 35px;
    position: absolute;
    right: 5px;
    top: 5px;
    width: 35px;
}
  

</style>
<script>

$(function() {
	 
    // if the function argument is given to overlay,
    // it is assumed to be the onBeforeLoad event listener
    $("#sdfgds").overlay({
 
        mask: 'balck',

 
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
 		<div class="disInfo" id="hhhh"><a href="new.php" rel="#overlay" id="sdfgds" style="text-decoration:none"><img id="sdfgdfsg" src="../images/<?php echo $i[0];?>" alt="User Pic"/></a></div>
		<div class="disInfo"><p><?php echo $i[1];?></p></div>
	
	</div>

<?php 
	}
	else {
?>
	<div id=<?php echo "odd"?> class="myDiscuss">
	<div class="disInfo"><p><?php echo $i[1];?></p></div>
	<div class="disInfo"><a href="new.php" rel="#overlay" id="sdfgds" style="text-decoration:none"><img id="sdfgdfsg" src="../images/<?php echo $i[0];?>" alt="User Pic"/></a></div>
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