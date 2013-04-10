<?php
include_once("./classes/lang.php");
if(isset($_SESSION['userData']))
{
    header("location:./Home/userHomePage.php");
    die;
}

?>
<!DOCTYPE html>
<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
<html>
    <head>
        <title><?php echo $lang->CAREERBOOKHOME?></title>
        <link rel="stylesheet" type="text/css" href="css/mainpage.css" ></link>
        <link rel="stylesheet" href="css/login-form.css" media="screen"></link>
	 	<script type="text/javascript" src="JavaScript/jquery-1.7.1.js"></script>
        <script type="text/javascript" src="JavaScript/modernizr.custom.63321.js"></script>
        <script type="text/javascript" src="JavaScript/indexPage.js"></script>
		<script type="text/javascript" src="JavaScript/fancybox/jquery.fancybox-1.3.4.js"></script>
		<script type="text/javascript" src="JavaScript/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
		<script src="JavaScript/slideshow.js" type="text/javascript" charset="utf-8"></script>
		<link rel="stylesheet" href="css/slideshow.css" type="text/css"></link>
		<link rel="stylesheet" type="text/css" href="JavaScript/fancybox/jquery.fancybox-1.3.4.css" ></link>
	    <script type="text/javascript" src="JavaScript/jquery.easing.1.3.js"></script>
		        
    </head>
    <body id="mainBody">
        <a href="javascript:void(0)" id="selectorLogin"></a>
        <div id="main">
            <div id="header_wrapper">
                <?php require_once './View/header.php'; ?>
            </div>
            <div id="left">
                <?php require_once './View/slider.php'; ?>
            </div>
            <div id="right">
                <?php require_once './View/login.php';  if(isset($_REQUEST['err'])&&($_REQUEST['err']=="AuthenticationFailed")) {
				?><center><h3><?PHP echo $lang->INVAILDLOGIN; ?></h3></center><?php }?>
            </div>
            <div id="googleAdds"></div>
	    		<?php require_once './View/slideShow.html'; ?>
            <div id="footer">
		<div class="footer-bottom">
			<div class="shell">
				<center><p class="copy"><?php echo $lang->COPYRIGHT?><span></span><?php echo $lang->INDEXMSG?></p></center>
			</div>
		</div>            
            <!--          <center>Career Book|All Right are Reserved|2013</center>-->
            </div>
	    
        </div>        
    </body>
</html>