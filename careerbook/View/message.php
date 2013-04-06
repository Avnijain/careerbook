<?php
/*
 **************************** Creation Log *******************************
File Name                   -  message.php
Project Name                -  Careerbook
Description                 -  file for composing and Viewing inbox and outbox messages
Version                     -  1.0
Created by                  -  Avni Jain
Created on                  -  March 18, 2013
*/

include_once '../controller/message_controller.php'; $a="false";
include_once("../classes/lang.php");
?>   
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
<link rel="stylesheet" href="../css/message2.css" />
<script src="../JavaScript/message.js"></script>
<script src="../JavaScript/message1.js"></script>
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
		$("li.inbox").hover(function(){

			$.post('../controller/mainentrance.php',{'action':'get_message'},function(data,status){

				if(status=="success")
				{
					$.post('../View/inbox.php',function(data,status){
						$('#messageinbox').html(data);
					});
				}
				});

		});
		$("li.outbox").hover(function(){
			$.post('../controller/mainentrance.php',{'action':'message_sent'},function(data,status){

				if(status=="success")
				{
					$.post('../View/outbox.php',function(data,status){
						$('#messageoutbox').html(data);
					});
				}
				});

		});
	});
</script>
<script>
	$(function() {

	$.post('../controller/mainentrance.php',{'action':'get_friend'},function(data,status){

							if(status=="success")
							{
								$.post('../View/friendemail.php',function(data,status){

									var myEmail=data.substring(0,(data.length)-1);
									var myArr= myEmail.split(',');
									$( "#tags" ).autocomplete({
										source: myArr
										});
								});
							}
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
			<?php echo $lang->INBOX?></h4>
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
			<?php echo  $lang->COMPOSE?></h3>
		<form id="SendForm" action="../controller/mainentrance.php?action=send_message" method="post">
		<br/>
		<fieldset>
			<legend><?php echo  $lang->ADDMESSAGE?></legend>
			<div>
				<label for="to">
					<?php echo  $lang->TO?></label>
				<input id="tags"  name="uid" type="text"/>
				<div id="searchresult" ></div>
			</div>
			<div>
				<label for="meassage">
					<?php echo  $lang->MESSAGE?></label>
					<textarea name="descripition" rows="8" cols="40"></textarea>
			</div>
			<div>
				<input id="message" class="btn blue" type="submit" value="Send" />
			</div>
		</fieldset>
		</form>
		<h3><?php if(isset($_REQUEST['c'])&&($_REQUEST['c']=="sent")) 
			echo $lang->SUCESSMSG;
			 if(isset($_REQUEST['c'])&&($_REQUEST['c']=="invaild")) 
			echo $lang->INVAILDEMAILID;
			  if(isset($_REQUEST['c'])&&($_REQUEST['c']=="notfriend")) 
			echo $lang->ERRORMSG2;
			  if(isset($_REQUEST['c'])&&($_REQUEST['c']=="admin")) 
			echo $lang->ERRORMSG3;?></h3>
	</div>
	<div>
		<h4>
		   <?php echo $lang->OUTBOX?></h4>
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
