<html>
    <head>
        <title>Career Book : Home</title>
        <link rel="stylesheet" type="text/css" href="css/mainpage.css" ></link>
<!--         <link rel="stylesheet" type="text/css" href="JavaScript/fancybox/jquery.fancybox.css" ></link> -->
        <link rel="stylesheet" href="css/login-form.css" media="screen"></link>
	   <!-- The JavaScript -->
	   
	   <script src="JavaScript/jquery-1.7.1.js"></script>
<!-- 	   <script src="JavaScript/jquery.tools.min.js"></script> -->
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
                <?php require_once './views/header.php'; ?>
            </div>
            <div id="left">
                <?php require_once './views/slider.php'; ?>
            </div>
            <div id="right">
                <?php require_once './views/login.php'; ?>
            </div>
            <div id="googleAdds"></div>
            <div id="footer">
		<div class="footer-bottom">
			<div class="shell">
				<p class="copy">© Copyright 2013<span>|</span>Career Book | All Right Reserved</p>
			</div>
		</div>            
            <!--          <center>Career Book|All Right are Reserved|2013</center>-->
            </div>
        </div>        
    </body>
</html>


<script type="text/javascript">
		function testoverlay() {
			url = "views/NewRegistration.php";
			$("#selectorLogin").attr("href",url);
	        $("#selectorLogin").trigger("click");
		    
		}

		$(document).ready(function() {
				$("#selectorLogin").fancybox({
		        'width'			: '60%',
		        'height'		: '100%',
		        'autoScale'		: false,
		        'transitionIn'		: 'none',
		        'transitionOut'		: 'none',
		        'type'			: 'iframe'
		    });
			
		});
</script>