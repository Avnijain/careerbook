<?php
session_start();
if(isset($_SESSION['userData']))
{
    header("location:./Home/userHomePage.php");
    die;
}


include_once("./classes/lang.php");

?>
<html>
    <head>
        <title><?php echo $lang->CAREERBOOKHOME?></title>
        <link rel="stylesheet" type="text/css" href="css/mainpage.css" ></link>
<!--         <link rel="stylesheet" type="text/css" href="JavaScript/fancybox/jquery.fancybox.css" ></link> -->
        <link rel="stylesheet" href="css/login-form.css" media="screen"></link>
	   <!-- The JavaScript -->
<!--<script type="text/javascript" src="JavaScript/jquery-1.9.1.min.js"></script>	   -->
	   <script src="JavaScript/jquery-1.7.1.js"></script>

        <script src="JavaScript/modernizr.custom.63321.js"></script>
		<!--[if lte IE 7]><style>.main{display:none;} .support-note .note-ie{display:block;}</style><![endif]-->
		
		<script type="text/javascript" src="JavaScript/fancybox/jquery.fancybox-1.3.4.js"></script>
		<script type="text/javascript" src="JavaScript/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
		
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
                <?php require_once './View/login.php'; ?>
            </div>
            <div id="googleAdds"></div>
	    
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


<script type="text/javascript">
		function testoverlay() {
			url = "View/NewRegistration.php";
			$("#selectorLogin").attr("href",url);
	        $("#selectorLogin").trigger("click");
		    
		}
		function forgetPwdOverlay() {
			url = "View/forgetPasswd.php";
			$("#selectorLogin").attr("href",url);
	        $("#selectorLogin").trigger("click");
		    
		}
		$(document).ready(function() {
			var screenW = 640, screenH = 480;
			if (parseInt(navigator.appVersion)>3) {
			 screenW = screen.width;
			 screenH = screen.height;
			}
			else if (navigator.appName == "Netscape" 
			    && parseInt(navigator.appVersion)==3
			    && navigator.javaEnabled()
			   ) 
			{
			 var jToolkit = java.awt.Toolkit.getDefaultToolkit();
			 var jScreenSize = jToolkit.getScreenSize();
			 screenW = jScreenSize.width;
			 screenH = jScreenSize.height;
			}
				$("#selectorLogin").fancybox({
		        'width'			: screenW/2,
		        'height'		: screenH/2+60,
		        'autoScale'		: false,
		        'transitionIn'		: 'none',
		        'transitionOut'		: 'none',
		        'type'			: 'iframe'
		    });
			
		});
</script>