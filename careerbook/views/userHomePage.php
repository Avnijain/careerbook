<?php
include_once("../classes/lang.php");
require_once '../controller/userInfo.php';
include_once "../controller/friends_controller.php";

if(!isset($_SESSION['userData']))
{
    header("location:../index.php");
    die;
}

?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../css/global.css" ></link>
    <link rel="stylesheet" type="text/css" href="../css/topheader.css" ></link>
    <link rel="stylesheet" type="text/css" href="../css/homeContent.css" ></link>
</head>
<body>
<div id="mainWrapper">
<div id="headerWrapper">
<div id="top">
	<div class="cl">&nbsp;</div>
	<h1 id="logo"><a href="#">CareerBook</a></h1>
           <label id="header_userName">Welcome <?php
	   
					$objUserInfo = unserialize($_SESSION['userData']);
					$userData=$objUserInfo->getUserPersonalInfo();
					
					echo $userData['first_name']." ".$userData['last_name'];
					?></label>
		 <a href="./userHomePage.php?logOut" class="small magenta awesome">LogOut</a><br><br>	
	
	<form action="userHomePage.php" method="get" id="search">
		<div class="field-holder">
			<input type="text" class="field" placeholder="Search" title="Search" name="Search">
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
		<li><span><a href="../controller/mainentrance.php?action=Group">group</a></span></li>
		<li><span><a href="userHomePage.php?users">users</a></span></li>
		<li><span><a href="userHomePage.php?message">messages</a></span></li>
		<li><span><a href="userHomePage.php?resume">Resume</a></span></li>					
		<li class="last"><span><a href="userHomePage.php?profile">Account</a></span></li>
		<li class="last"><span><a href="userHomePage.php?information">Profile</a></span></li>
		<li class="last"><span><a href="userHomePage.php?Settings">Settings</a></span></li>
		</ul>
	</div>
</nav>
</div>
<div id="contentWrapper">
<?php 
if(isset($_GET['profile'])){
   include 'UserInfoForm.php';
} else if(isset($_GET['resume'])){
   include 'resume.php';
}
else if(isset($_GET['logOut'])){
   session_destroy();
   header("location:../index.php");
   die;
} 
else if (isset($_GET['message'])) {
	include 'message.php'; 
}
else if (isset($_GET['information'])) {
	include 'information.php';
}
  else{
   include 'userHomeContent.php';
}
?>
</div>
</div>
</body>	
</html>