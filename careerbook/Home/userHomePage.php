<?php
ini_set("display_errors",1);
ini_set ( 'session.cookie_httponly', true );
ini_set ( 'session.use_only_cookies', true);
ini_set ( 'session.hash_function', "sha512");
ini_set ( 'session.hash_bits_per_character', 5);

include_once ("../classes/lang.php");
require_once '../controller/userInfo.php';
include_once "../controller/friends_controller.php";

if (! isset ( $_SESSION ['userData'] )) {
	header ( "location:../index.php" );
	die ();
}


$objUserInfo = unserialize ( $_SESSION ['userData'] );
$userData = $objUserInfo->getUserPersonalInfo ();
?>
<?php

if(isset($_GET ['close'])) {
	echo '<script type="text/javascript">'
		, 'closeME();'
		, '</script>';
	
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<link rel="stylesheet" type="text/css" href="../css/style.css"></link>
<script type="text/javascript">
        function closeME() {
            parent.$.fancybox.close(); 
        }
        function changeToken() {
       	 $.post("../View/security.php",function(data){});
       	}
       	var id = setInterval('changeToken();', 10000);
</script>
<script src="../JavaScript/jquery-1.7.1.js"></script>
<script type="text/javascript" src="../JavaScript/fancybox/jquery.fancybox-1.3.4.js"></script>
<script type="text/javascript" src="../JavaScript/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="../JavaScript/fancybox/jquery.fancybox-1.3.4.css" ></link>
<?php
include_once ("../classes/lang.php");
?>

</head>
<body>
    <a href="javascript:void(0)" id="selectorLogin"></a>
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
						<li><span><a href="userHomePage.php?Group"><?php echo $lang->GROUP?></a></span></li>
						<li><span><a href="userHomePage.php?Friends"><?php echo $lang->FRIENDS?></a></span></li>
						<li><span><a href="userHomePage.php?message"><?php echo $lang->MESSAGES?></a></span></li>
						<li><span><a href="userHomePage.php?resume"><?php echo $lang->RESUME?></a></span></li>
						<li><span><a href="userHomePage.php?profile"><?php echo $lang->ACCOUNT?></a></span></li>
						<li><span><a href="userHomePage.php?information"><?php echo $lang->PROFILE?></a></span></li>
						<li class="last"><span><a href="userHomePage.php?Settings"><?php echo $lang->SETTINGS?></a></span></li>
					</ul>
				</div>
			</nav>
		</div>
		<div id="contentWrapper">
<?php
if (isset ( $_GET ['profile'] )) {
	include '../View/UserInfoForm.php';
} else if (isset ( $_GET ['resume'] )) {
	include '../View/resume.php';
} else if (isset ( $_GET ['logOut'] )) {
	unlink($fileName);
	unset($_SESSION);
	session_destroy();
	header ( "location:../index.php" );
	die ();
} else if (isset ( $_GET ['message'] )) {
	include '../View/message.php';
} else if (isset ( $_GET ['information'] )) {
	include '../View/information.php';
} else{
   include '../View/userHomeContent.php';
}
?>
	</div>
</div>
</body>
</html>