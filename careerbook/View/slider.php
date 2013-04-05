<?php include_once("./classes/lang.php");?>
<link rel="stylesheet" href="css/sliderStyle.css" type="text/css"
	media="screen" />
<div id="slider_content">
	<a class="back" href=""></a>
	<div class="rotator">
		<ul id="rotmenu">
			<li><a href="rot1"><?php echo $lang->ABOUTUS;?></a>
				<div style="display: none;">
					<div class="info_image">../images/career.jpg</div>
					<div class="info_heading"><?php echo $lang->OURWORK;?></div>
					<div class="info_description">
						<ul>
							<li id="reconnect"><?php echo $lang->SLIDERMSG1;?></li>
							<li id="answers"><?php echo $lang->SLIDERMSG2;?></li>
							<li id="power"><?php echo $lang->SLIDERMSG3;?></li>
						</ul>
					</div>
				</div></li>
			<li><a href="rot2"><?php echo $lang->SERVICES;?></a>
				<div style="display: none;">
					<div class="info_image">../images/2.jpg</div>
					<div class="info_heading"><?php echo $lang->WESERVE;?></div>
					<div class="info_description">
						<ul>
							<li><?php echo $lang->SLIDERMSG4;?></li>
							<li><?php echo $lang->CAREERGUIDANCE;?></li>
							<li><?php echo $lang->COUNSULTANCY;?></li>
						</ul>
					</div>
				</div></li>
			<li><a href="rot3"><?php echo $lang->CONTACT;?></a>
				<div style="display: none;">
					<div class="info_image">../images/3.jpg</div>
					<div class="info_heading"><?php echo $lang->GETINTOUCH;?></div>
					<div class="info_description">
				    <?php require_once 'contactus.php'?>
				</div>
				</div></li>
		</ul>
		<div id="rot1">
			<img src="" width="800" height="300" class="bg" alt="" />
			<div class="heading">
				<h1></h1>
			</div>
			<div class="description">
				<p></p>
			</div>
		</div>
	</div>
</div>


