
<?php
ini_set ( 'session.cookie_httponly', true );
// suhosin.session.encrypt=Off
ini_set ( "suhosin.session.encrypt", true );
// echo gethostname();

// session_start ();
// echo "dshfjkfs";
// $time = time();
// $date = $today = date("Ymd");
// $id = $time + $date;

// $a=session_id($id);
// session_regenerate_id(true);
// echo $a;
// echo $_COOKIE["PHPSESSID"];

?>
<?php

include_once ("../classes/lang.php");
require_once '../controller/userInfo.php';
include_once "../controller/friends_controller.php";

if (! isset ( $_SESSION ['userData'] )) {
	header ( "location:../index.php" );
	die ();
}

?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="../css/style.css"></link>
<?php
include_once ("../classes/lang.php");
?>
</head>
<body>
	<div id="mainWrapper">
		<div id="headerWrapper">
			<div id="top">
				<div class="cl">&nbsp;</div>
				<div id="header_left">
    				<h1 id="logo">
    					<a href="#"><?php echo $lang->PROJECTTITLE; ?></a>
    				</h1>
				</div>				
				<div id="header_right">
					<div id = "header_userName" > 
    				<label id="header_userNameLabel"><?php echo $lang->WELCOME ?> <?php				
    				$objUserInfo = unserialize ( $_SESSION ['userData'] );
    				$userData = $objUserInfo->getUserPersonalInfo ();				
    				echo $userData ['first_name'] . " " . $userData ['last_name'];
    				?></label></div>
    				<div id = "header_logout" ><a href="./userHomePage.php?logOut"
        			class="btn blue"><?Php echo $lang->LOGOUT?></a></div>    				
				</div>
				<div id="header_right_search">
    				<form action="userHomePage.php" method="get" id="search">
    					<div class="field-holder">
    						<input type="text" class="field" placeholder="Search"
    							title="Search" name="Search">
    					</div>
    					<input type="submit" class="button" value="Search">
    					<div class="cl">&nbsp;</div>
    				</form>
				</div>
			</div>
			<nav class="top-nav">
				<div class="shell">
					<a href="#" class="nav-btn"><?php echo $lang->HOME?><span></span></a>
					<span class="top-nav-shadow"></span>
					<ul>
						<li class="active first"><span><a href="userHomePage.php"><?php echo $lang->HOME?></a></span></li>
						<li><span><a href="../controller/mainentrance.php?action=Group"><?php echo $lang->GROUP?></a></span></li>
						<li><span><a href="userHomePage.php?Friends"><?php echo $lang->FRIENDS?></a></span></li>
						<li><span><a href="userHomePage.php?message"><?php echo $lang->MESSAGES?></a></span></li>
						<li><span><a href="userHomePage.php?resume"><?php echo $lang->RESUME?></a></span></li>
						<li class="last"><span><a href="userHomePage.php?profile"><?php echo $lang->ACCOUNT?></a></span></li>
						<li class="last"><span><a href="userHomePage.php?information"><?php echo $lang->PROFILE?></a></span></li>
						<li class="last"><span><a href="userHomePage.php?Settings"><?php echo $lang->SETTINGS?></a></span></li>
					</ul>
				</div>
			</nav>
		</div>
		<div id="contentWrapper">
<?php
if (isset ( $_GET ['profile'] )) {
	include 'UserInfoForm.php';
} else if (isset ( $_GET ['resume'] )) {
	include 'resume.php';
} else if (isset ( $_GET ['logOut'] )) {
	session_destroy ();
	header ( "location:../index.php" );
	die ();
} else if (isset ( $_GET ['message'] )) {
	include 'message.php';
} else if (isset ( $_GET ['information'] )) {
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