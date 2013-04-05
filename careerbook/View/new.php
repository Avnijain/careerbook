<?php
include_once 'call.php'; 
?>
<?php
	$b=$_SERVER['QUERY_STRING'];
	//echo $b;
	$a=explode("&",$b);
	/*echo $a[0];
	echo "<br/>";
	echo $a[1];*/
?>
<style>
body {
	color:white;
}	
div#pic {
	float:left;
	width:28%;	
	height:40%;
}
div#content {
	float:left;
	height:40%;
	width:70%;
    border:1px solid blue;
}
div#comment {
        width:100%;
        float:left;
		color:white;
}
#add {
float:left;
font:blue;
font-size: 14px;
}
</style>
<script>
function f()
{
	//alert("jsjdj");
	var input = document.createElement('textarea');
    input.name = 'post';
    input.maxLength = 5000;
    input.cols = 30;
    input.rows = 3;
    var button = document.createElement('button');
	button.name='comment';
	button.width=12;
	button.value="post";
	button.width=10;
	button.onclick = function () {
					alert("Thank you!!! for posting your views.");
					}
    var ob = document.getElementById("add");
   while (ob.childNodes.length > 10)
        ob.removeChild(ob.childNodes[0]);
    ob.appendChild(input);
    ob.appendChild(button);
	//var count=ob.childNodes.length;
	//document.getElementById("likes").innerHTML=""+count+"";
}
/*
function f1(){
	var counter=1;
	var limit=10;
	alert("hhj");
     if (counter == limit)  {
          alert("You can't add more than " + counter + " comments");
     }
     else {
          var newdiv = document.createElement('div');
          newdiv.innerHTML = " <br><input type='text' name='myInputs[]'>";
          document.getElementById("add").appendChild(newdiv);
          counter++;
     }
}*/
function like() {
var c=0;
c++;
if(c>0)
{
	document.getElementById("likes").innerHTML=""+c+"Likes";
}
}


</script>
<body>
<div>
	<div id="likes"></div>
	<div id="pic">
		<img src="../images/<?php echo $a[0]?>" alt="discussion picture" height=150 width=150/>
	</div>
	<div id="content"><?php echo $images[$a[1]][1]?></div><br/>
	<div id="comment"><input type="Button" value="Comment" onclick="f()"/> &nbsp;&nbsp;&nbsp;<a href=# onclick="like()">Like it</div>
	<div id="add"></div>
</div>
<body/>