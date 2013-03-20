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
           <label id="userName">Welcome User Name</label>
		 <a href="./userHomePage.php?logOut" class="small magenta awesome">LogOut</a><br><br>	
	
	<form action="" method="post" id="search">
		<div class="field-holder">
			<input type="text" class="field" placeholder="Search" title="Search">
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
		<li class="active first"><span><a href="userHomePage.php">home</a></span></li>
		<li><span><a href="userHomePage.php?group">group</a></span></li>
		<li><span><a href="#">users</a></span></li>
		<li><span><a href="#">messages</a></span></li>
		<li><span><a href="userHomePage.php?resume">Resume</a></span></li>					
		<li class="last"><span><a href="userHomePage.php?profile">profile</a></span></li>
		</ul>
	</div>
</nav>
</div>
<div id="contentWrapper">
<?php 

if(!isset($_SESSION['userData']))
{
    header("location:../index.php");
    die;
}


if(isset($_GET['profile'])){
   include 'UserInfoForm.php';
} else if(isset($_GET['resume'])){
   include 'resume.php';
}
else if(isset($_GET['logOut'])){
   session_destroy();
   header("location:../index.php");
   die;
} else if (isset($_GET['group'])) {
	include 'add_group.php';
} else{
   include 'userHomeContent.php';
}
?>
</div>
</div>
</body>	
</html>