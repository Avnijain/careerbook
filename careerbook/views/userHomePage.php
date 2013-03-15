<?php
include_once("../classes/lang.php");
require_once '../controller/userInfo.php';
?>
<html>
<head>
        <link rel="stylesheet" type="text/css" href="../css/global.css" ></link>
        <link rel="stylesheet" type="text/css" href="../css/topheader.css" ></link>
<style>
/* Content */
#contentSide { float:left; width:270px; padding-top: 10px; }

#contentSide h2 { background:url(../images/content-heading.gif) left top no-repeat; padding-left: 3px; position:relative; top:-3px; left:-11px; float:left; }
#contentSide h2 span { float:left; background:url(../images/content-heading.gif) right top no-repeat; color: #FFFFFF; padding:10px 13px 11px 4px; }

#contentSide .see-all { float:right; font-size:12px; line-height:14px; color:#00b1dd; text-decoration:underline; padding-top:6px; }
#contentSide .see-all:hover { text-decoration:none; }

/* Content - Posts */
#contentSide .post { float:left; width:255px; min-height: 76px; margin-right:26px; padding:5px 0 10px 0; }
#contentSide .post .image { float:left; border:1px solid #d7d7d7; width:60px; }
#contentSide .post .image img { border:1px solid #fff; }

#contentSide .post .data { float:right; width:186px; padding-top:1px;  }
#contentSide .post .data p { padding-left:2px; }

#contentCenter{ float:left; width:470px; padding-top: 10px; padding-left: 5px; background-color: #  }


#sideRight {float: right;}
</style>
</head>
<body>
<div id="mainWrapper">
<div id="headerWrapper">
<div id="top">
		<div class="cl">&nbsp;</div>
		<h1 id="logo"><a href="#">CareerBook</a></h1>
		<form action="" method="post" id="search">
			<div class="field-holder">
				<input type="text" class="field" value="Search" title="Search">
			</div>
			<input type="submit" class="button" value="Search">
			<div class="cl">&nbsp;</div>
		</form>
</div>
<nav class="top-nav">
			<div class="shell">
			<a href="#" class="nav-btn">HOMEPAGE<span></span></a>			
				<span class="top-nav-shadow"></span>
				<ul>
					<li class="active first"><span><a href="#">home</a></span></li>
					<li><span><a href="#">group</a></span></li>
					<li><span><a href="#">users</a></span></li>
					<li><span><a href="#">messages</a></span></li>
					<li><span><a href="#">help</a></span></li>					
					<li class="last"><span><a href="UserInfoForm.php">profile</a></span></li>
				</ul>
			</div>
</nav>
</div>
<div id="contentWrapper">
<div id="contentSide">
			<!-- Box -->
			<div class="box">
				<h2><span>Notifications</span></h2>
				<div class="cl">&nbsp;</div>				
				<div class="posts">
					<!-- Post -->
				    <div class="post">
				    	<div class="image">
				    		<a href="#"><img src="css/images/post-1.jpg" alt=""></a>
				    	</div>
				    	<div class="data">
				    		<h4><a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a></h4>
				    		<p>Maecenas sodales auctor urna cursus facilisis. Cras rutrum justo id mi bibendum luctus. </p>
				    	</div>
				    </div>
				    <!-- /Post -->
					<!-- Post -->
				   <div class="post last">
				    	<div class="image">
				    		<a href="#"><img src="css/images/post-2.jpg" alt=""></a>
				    	</div>
				    	<div class="data">
				    		<h4><a href="#">Maecenas scelerisque sapien </a></h4>
				    		<p>Maecenas sodales auctor urna cursus facilisis. Cras rutrum justo id mi bibendum luctus. </p>
				    	</div>
				    </div>
				    <!-- /Post -->
				    <div class="cl">&nbsp;</div>
				</div>
			</div>
			<!-- /Box -->
			<!-- Box -->
			<div class="box">
				<h2><span>Activity Report</span></h2>
				<div class="cl">&nbsp;</div>				
				<div class="posts">
					<!-- Post -->
				    <div class="post">
				    	<div class="image">
				    		<a href="#"><img src="css/images/post-1.jpg" alt=""></a>
				    	</div>
				    	<div class="data">
				    		<h4><a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a></h4>
				    		<p>Maecenas sodales auctor urna cursus facilisis. Cras rutrum justo id mi bibendum luctus. </p>
				    	</div>
				    </div>
				    <!-- /Post -->
					<!-- Post -->
				   <div class="post last">
				    	<div class="image">
				    		<a href="#"><img src="css/images/post-2.jpg" alt=""></a>
				    	</div>
				    	<div class="data">
				    		<h4><a href="#">Maecenas scelerisque sapien </a></h4>
				    		<p>Maecenas sodales auctor urna cursus facilisis. Cras rutrum justo id mi bibendum luctus. </p>
				    	</div>
				    </div>
				    <div class="cl">&nbsp;</div>
				</div>
			</div>
			<!-- /Box -->
			
			
			<div class="cl">&nbsp;</div>	
		


</div>
<div id="contentCenter">

<?php

$ip= $_SERVER['REMOTE_ADDR'];
echo $lang->IPADDRESS;
echo "<br> " . $ip;
echo "<br>";
echo $_SERVER['HTTP_USER_AGENT'];
    if(isset($_SESSION['userData']))
    {
        $obj = new user_info_controller();
        $obj = unserialize($_SESSION['userData']);
        print("<br/>");
        echo "<pre>";
        print_r ($obj->getUserPersonalInfo());
        print_r ($obj->getUserIdInfo());

//     print("first_name =>".$obj->getuserinfo('first_name'));print("<br/>");
// 	print("middle_name =>".$obj->getuserinfo('middle_name'));print("<br/>");
// 	print("last_name =>".$obj->getuserinfo('last_name'));print("<br/>");
// 	print("date_of_birth =>".$obj->getuserinfo('date_of_birth'));print("<br/>");
//        echo "<pre>";
//        print_r($obj);
//        echo "</pre>";
    }
    else
    {
       header("location:../index.php");
	die;   
    }
?>

</div>
<div id="sideRight">
<div id="contentSide">

			<!-- Box -->
			<div class="box">
				<h2><span>User Profile</span></h2>
				<div class="cl">&nbsp;</div>				
				<div class="posts">
					<!-- Post -->
				    <div class="post">
				    	<div class="image">
				    		<a href="#"><img src="css/images/post-1.jpg" alt=""></a>
				    	</div>
				    	<div class="data">
				    		<h4><a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a></h4>
				    		<p>Maecenas sodales auctor urna cursus facilisis. Cras rutrum justo id mi bibendum luctus. </p>
				    	</div>
				    </div>
				    <!-- /Post -->
					<!-- Post -->
				   <div class="post last">
				    	<div class="image">
				    		<a href="#"><img src="css/images/post-2.jpg" alt=""></a>
				    	</div>
				    	<div class="data">
				    		<h4><a href="#">Maecenas scelerisque sapien </a></h4>
				    		<p>Maecenas sodales auctor urna cursus facilisis. Cras rutrum justo id mi bibendum luctus. </p>
				    	</div>
				    </div>
				    <!-- /Post -->
				    <div class="cl">&nbsp;</div>
				</div>
			</div>
			<!-- /Box -->
			<!-- Box -->
			<div class="box">
				<h2><span>Friends</span></h2>
				<div class="cl">&nbsp;</div>				
				<div class="posts">
					<!-- Post -->
				    <div class="post">
				    	<div class="image">
				    		<a href="#"><img src="css/images/post-1.jpg" alt=""></a>
				    	</div>
				    	<div class="data">
				    		<h4><a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a></h4>
				    		<p>Maecenas sodales auctor urna cursus facilisis. Cras rutrum justo id mi bibendum luctus. </p>
				    	</div>
				    </div>
				    <!-- /Post -->
					<!-- Post -->
				   <div class="post last">
				    	<div class="image">
				    		<a href="#"><img src="css/images/post-2.jpg" alt=""></a>
				    	</div>
				    	<div class="data">
				    		<h4><a href="#">Maecenas scelerisque sapien </a></h4>
				    		<p>Maecenas sodales auctor urna cursus facilisis. Cras rutrum justo id mi bibendum luctus. </p>
				    	</div>
				    </div>
				    <div class="cl">&nbsp;</div>
				</div>
			</div>
			<!-- /Box -->
			
			
			<div class="cl">&nbsp;</div>	
</div>
</div>
</div>
</div>
</body>	
</html>