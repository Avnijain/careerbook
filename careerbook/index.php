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
	    
				

		<style type="text/css">

/* the overlayed element */
.apple_overlay {

    /* initially overlay is hidden */
    display:none;

    /* growing background image */
    background-image:url(images/white.png);

    /*
      width after the growing animation finishes
      height is automatically calculated
      */
    width:640px;

    /* some padding to layout nested elements nicely  */
    padding:35px;

    /* a little styling */
    font-size:11px;
}

/* default close button positioned on upper right corner */
.apple_overlay .close {
    background-image:url(images/close.png);
    position:absolute; right:5px; top:5px;
    cursor:pointer;
    height:35px;
    width:35px;
}		


  #overlay {
    background-image:url(images/transparent.png);
    /*color:#efefef;*/
    height:450px;
  }
  /* container for external content. uses vertical scrollbar, if needed */
  div.contentWrap {
    height:441px;
    overflow-y:auto;
  }

		</style>
		
		        
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
                    <center>Career Book|All Right are Reserved|2013</center>
            </div>
<div class="apple_overlay" id="overlay">
  <!-- the external content is loaded inside this tag -->
  <div class="contentWrap"></div>
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
		        'height'		: '70%',
		        'autoScale'		: false,
		        'transitionIn'		: 'none',
		        'transitionOut'		: 'none',
		        'type'			: 'iframe'
		    });
			
		});
		</script>    
