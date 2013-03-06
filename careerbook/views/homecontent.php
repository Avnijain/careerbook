<html>
    <head>
        <link rel="stylesheet" type="text/css" href="./css/mainpage.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script type="text/javascript" src="./js/jquery-1.9.1.min.js"></script>
        <script type="text/javascript" src="./js/jquery.tools.min.js"></script>
        <script type="text/javascript">
/* <![CDATA[ */
$(document).ready(function(){
	$("#tabs li").click(function() {
		//	First remove class "active" from currently active tab
		$("#tabs li").removeClass('active');

		//	Now add class "active" to the selected/clicked tab
		$(this).addClass("active");

		//	Hide all tab content
		$(".tab_content").hide();

		//	Here we get the href value of the selected tab
		var selected_tab = $(this).find("a").attr("href");

		//	Show the selected tab content
		$(selected_tab).fadeIn();

		//	At the end, we add return false so that the click on the link is not executed
		return false;
	});
});
/* ]]> */
</script>
    </head>
    <body>
	<div id="tabs_wrapper">
            <div id="tabs_container">
                <ul id="tabs">
                    <li class="active"><a href="#tab1">Home</a></li>
                    <li><a class="icon_accept" href="#tab2">About Us</a></li>
                    <li><a href="#tab3">Contact Us</a></li>
                </ul>
            </div>
            <div id="tabs_content_container">
                <div id="tab1" class="tab_content" style="display: block;">
                    <img alt="career" src="./images/career.jpg">
                </div>
                <div id="tab2" class="tab_content">
                    <img alt="career" src="./images/Whatiscb.png">
                </div>
                <div id="tab3" class="tab_content">
                    <img alt="career" src="./images/contactus.png">
                </div>
            </div>
	</div>
    </body>
</html>