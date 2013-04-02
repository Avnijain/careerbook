<?php include_once '../controller/message_controller.php'; $a="false";?>

   
    <script type="text/javascript" src="../JavaScript/jquery1.min.js"></script>
    <!--[if IE 7]>
    <style type="text/css">
        #vtab > ul > li.selected{
            border-right: 1px solid #fff !important;
        }
        #vtab > ul > li {
            border-right: 1px solid #ddd !important;
        }
        #vtab > div { 
            z-index: -1 !important;
            left:1px;
        }
    </style>
    <![endif]-->
    <style type="text/css">
/*         body { */
/*             background: #fff; */
/*             font-family: verdana; */
/*             padding-top: 50px; */
/*         } */
        #vtab {
            margin: auto;
            width: 800px;
            height: 100%;
        }
        #vtab > ul > li {
            width: 110px;
            height: 110px;
            background-color: #fff !important;
            list-style-type: none;
            display: block;
            text-align: center;
            margin: auto;
            padding-bottom: 10px;
            border: 1px solid #fff;
            position: relative;
            border-right: none;
            opacity: .3;
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=30)";
            filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=30);
        }
        #vtab > ul > li.Inbox {
            background: url('../images/inbox.jpg') no-repeat center center;
        }
        #vtab > ul > li.Compose {
            background: url('../images/compose.jpg') no-repeat center center;
        }
        #vtab > ul > li.Outbox {
            background: url('../images/outbox.jpg') no-repeat center center;
        }
        #vtab > ul > li.selected {
            opacity: 1;
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)";
            filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=100);
            border: 1px solid #ddd;
            border-right: none;
            z-index: 10;
            background-color: #fafafa !important;
            position: relative;
        }
        #vtab > ul {
            float: left;
            width: 110px;
            text-align: left;
            display: block;
            margin: auto 0;
            padding: 0;
            position: relative;
            top: 30px;
        }
        #vtab > div {
            background-color: #fafafa;
            margin-left: 110px;
            border: 1px solid #ddd;
            min-height: 500px;
            padding: 12px;
            position: relative;
            z-index: 9;
            -moz-border-radius: 20px;
        }
        #vtab > div > h4,h3 {
            color: #800;
            font-size: 1.2em;
            border-bottom: 1px dotted #800;
            padding-top: 5px;
            margin-top: 0;
        }
        #SendForm label {
            float: left;
            width: 100px;
            text-align: right;
            clear: left;
            margin-right: 15px;
        }
        #SendForm fieldset {
            border: none;
        }
        #SendForm fieldset > div {
            padding-top: 3px;
            padding-bottom: 3px;
        }
        #SendForm #message {
            margin-left: 115px;
        }
        #searchresult{
    	    	/*border: 1px dashed black;*/
		}
        
    </style>
	<link rel="stylesheet" type="text/css" href="../css/message.css" />
	<link rel="stylesheet" type="text/css" href="../css/style.css" />
	 <script src="message.js"></script>
	<script src="message1.js"></script>
	<link rel="stylesheet" href="message2.css" />
    <script type="text/javascript">
        $(function() {
            var $items = $('#vtab>ul>li');
            $items.mouseover(function() {
                $items.removeClass('selected');
                $(this).addClass('selected');

                var index = $items.index($(this));
                $('#vtab>div').hide().eq(index).show();
            }).eq(1).mouseover();
        });
    </script>
     <script>
		$(document).ready(function () {
		//$("p").text("The DOM is now loaded and can be manipulated.");
			$("#email").keyup(function(){
					//$("#searchresult").html("kdmsfmsmfcmds");
					$.post('../controller/mainentrance.php',{'action':'get_friend'},function(data,status){

						if(status=="success")
						{
							$.post('../views/friendemail.php',function(data,status){
								$('#searchresult').html(data);
								
							});
						}
						});
					
				});
				$("#abc").keyup(function(){
					//$("#searchresult").html("kdmsfmsmfcmds");
					$.post('../controller/mainentrance.php',{'action':'get_friend'},function(data,status){

						if(status=="success")
						{
							$.post('../views/friendemail.php',function(data,status){
								$( "#abc" ).autocomplete({
								source: data
								});
							});
						}
						});
					
				});
			$("li.inbox").hover(function(){
// 				$.post('../controller/mainentrance.php',{'action':'get_message'},function(data,"){
// 					});
				$.post('../controller/mainentrance.php',{'action':'get_message'},function(data,status){

					if(status=="success")
					{
						$.post('../views/inbox.php',function(data,status){
							$('#messageinbox').html(data);
						});
					}
					});
// 		 		   $.ajax({ 
// 	 		     type: "POST",
// 	 		     url: '../controller/mainentrance.php?action=get_message',                  //the script to call to get data          

// 	 		       success: function(){    	   
// 	 		    	//   $('#messageinbox').html(data);
// 		 		    	  $.ajax({ 
// 			 		 		     type: "POST",
// 			 		 		     url: '../views/inbox.php',                  //the script to call to get data          
// 			 		 		       success: function(data){    	   
// 			 		 		    	   $('#messageinbox').html(data);

			 				    	   
// 			 		 		       },

// 			 		 		   });

			    	   
// 	 		       }
// 	//		        complete: function () {
			           
// 	//		        },
// 	//		        error: function(){
			           
// 	//		        }
// 	 		   });
			});
			$("li.outbox").hover(function(){
				$.post('../controller/mainentrance.php',{'action':'message_sent'},function(data,status){

					if(status=="success")
					{
						$.post('../views/outbox.php',function(data,status){
							$('#messageoutbox').html(data);
						});
					}
					});
// 		 		   $.ajax({ 
// 	 		     type: "POST",
// 	 		     url: '../controller/mainentrance.php?action=message_sent',                  //the script to call to get data          

// 	 		       success: function(){    	   
// 	 		    	//   $('#messageinbox').html(data);
// 		 		    	  $.ajax({ 
// 			 		 		     type: "POST",
// 			 		 		     url: '../views/outbox.php',                  //the script to call to get data          
// 			 		 		       success: function(data){    	   
// 			 		 		    	   $('#messageoutbox').html(data);

			 				    	   
// 			 		 		       },

// 			 		 		   });

			    	   
// 	 		       }
	//		        complete: function () {
			           
	//		        },
	//		        error: function(){
			           
	//		        }
// 	 		   });
			});
		});
		
			

	</script>
	 <script>
$(function() {
var availableTags = [
"ActionScript",
"AppleScript",
"Asp",
"BASIC",
"C",
"C++",
"Clojure",
"COBOL",
"ColdFusion",
"Erlang",
"Fortran",
"Groovy",
"Haskell",
"Java",
"JavaScript",
"Lisp",
"Perl",
"PHP",
"Python",
"Ruby",
"Scala",
"Scheme"
];
$.post('../controller/mainentrance.php',{'action':'get_friend'},function(data,status){

						if(status=="success")
						{
							$.post('../views/friendemail.php',function(data,status){
								$( "#abc" ).autocomplete({
								source: data
								});
							});
						}
						});
$( "#tags" ).autocomplete({
source: availableTags
});
});
</script>

    <div id="vtab">
        <ul>
            <li class="Inbox"></li>
            <li class="Compose"></li>
            <li class="Outbox"></li>
        </ul>
        <div>
            <h4>
                My Inbox</h4>
			  <div class="message_container">
			<section>
                <div id="container_buttons">
                	<div id="messageinbox">

						</div>
					</div>
			</section>
        </div>
        </div>
        <div>
            <h3>
                Compose Message</h3>
            <form id="SendForm" action="../controller/mainentrance.php?action=send_message" method="post">
            <br/>
            <fieldset>
                <legend>Add Message</legend>
                <div>
                    <label for="to">
                        To:</label>
                    <input type="text" name="uid" id="email"  />
                    <input id="tags"  />
					<input id="abc"  />
                    <div id="searchresult" ></div>
                </div>
                <div>
                    <label for="meassage">
                        message:</label>
						<textarea name="descripition" rows="8" cols="40"></textarea>
                </div>
                <div>
                    <input id="message" type="submit" value="Send" />
                </div>
            </fieldset>
            </form>
			<h3><?php if(isset($_REQUEST['c'])&&($_REQUEST['c']=="sent")) 
				echo"Your Message has been sent"; 
			     if(isset($_REQUEST['c'])&&($_REQUEST['c']=="invaild")) 
				echo "invaild email id";
			      if(isset($_REQUEST['c'])&&($_REQUEST['c']=="notfriend")) 
				echo "You can send message only to yor friend";  ?></h3>
        </div>
        <div>
            <h4>
               My Outbox</h4>
			  <div class="message_container">
			<section>
                <div id="container_buttons">
                  <div id="messageoutbox">

					</div>
				</div>
			</section>
        </div>
		   
        </div>
    </div>
