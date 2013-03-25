<?php include_once '../Model/message_controller.php';?>

   
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
        body {
            background: #fff;
            font-family: verdana;
            padding-top: 50px;
        }
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
        #vtab > ul > li.home {
            background: url('../images/inbox.jpg') no-repeat center center;
        }
        #vtab > ul > li.login {
            background: url('../images/compose.jpg') no-repeat center center;
        }
        #vtab > ul > li.support {
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
        #vtab > div > h4 {
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
    </style>
	<link rel="stylesheet" type="text/css" href="../css/style.css" />
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

    <div id="vtab">
        <ul>
            <li class="home selected"></li>
            <li class="login"></li>
            <li class="support"></li>
        </ul>
        <div>
            <h4>
                My Inbox</h4>
			  <div class="container">
			<section>
                <div id="container_buttons">
					  <a href="../controller/mainentrance.php?action=get_message">click here to see</a>
							<?php session_start(); 
							if(isset($_SESSION['myinbox']))
								{ print_r($_SESSION['myinbox']);
									 $a=$_SESSION['myinbox'];
								$n=count($a);
								?><ul>
							<?php for($i=0;$i<$n;$i++)
							{?>
								<li class="toggle">
									<a href="#inbox<?php echo $i?>"><?php echo $a[$i]['user_from'];?></a>
									<p id="inbox<?php echo $i?>">
									<?php echo $a[$i]['description'];?> <a href=" ">details....</a>
								</p>
							</li>
							<?php } }?></ul>
					</div>
			</section>
        </div>
        </div>
        <div>
            <h4>
                Compose Message</h4>
            <form id="SendForm" action="../controller/mainentrance.php?action=send_message" method="post">
            <fieldset>
                <legend>Add Message</legend>
                <div>
                    <label for="to">
                        To:</label>
                    <input type="text" name="uid" id="email" />
                </div>
                <div>
                    <label for="meassage">
                        message:</label>
						<textarea name="descripition"></textarea>
                </div>
                <div>
                    <input id="message" type="submit" value="Send" />
                </div>
            </fieldset>
            </form>
			<h3><?php if(isset($_REQUEST['c'])&&($_REQUEST['c']=="sent")) echo"Your Message has been sent"?></h3>
        </div>
        <div>
            <h4>
                Outbox</h4>
			  <div class="container">
			<section>
                <div id="container_buttons">
					<a href="../controller/mainentrance.php?action=message_sent">click here to see</a>
							<?php //session_start(); 
							if(isset($_SESSION['outbox']))
								{ print_r($_SESSION['inbox']); $a=$_SESSION['outbox'];
								$n=count($a);
								?><ul>
							<?php for($i=0;$i<$n;$i++)
							{?>
								<li class="toggle">
									<a href="#six<?php echo $i?>"><?php echo $a[$i]['user_to'];?></a>
									<p id="six<?php echo $i?>">
									<?php echo $a[$i]['description'];?> <a href=" ">details....</a>
								</p>
							</li>
							<?php } }?></ul>
				</div>
			</section>
        </div>
		   
        </div>
    </div>
