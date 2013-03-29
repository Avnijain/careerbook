<?php
/*
 **************************** Creation Log *******************************
File Name                   -  resume.php
Project Name                -  Careerbook
Description                 -  selection of template for the resume of user
Version                     -  1.0
Created by                  -  Avni Jain
Created on                  -  March 07, 2013
*/
include_once("../classes/lang.php");
?>
<script	type="text/javascript" src="../JavaScript/jquery-1.9.1.min.js"></script>
<script	type="text/javascript" src="../JavaScript/jquery.tools.min.js"></script>
<link rel="stylesheet" type="text/css" href="../css/resume.css" ></link>
<script>
$(function() {			//for producing the overlay effect
  $("img[rel]").overlay({mask: 'black'});
});
</script>
<style>
			body {
				background: #D5DED9;
				font-family: Arial, Helvetica, sans-serif;
			}
			h1, h2, h3, h4, h5, h6 {
				font-family: Georgia, serif;
			}
			h1{
				font-size:330%;
				text-shadow:2px 2px 1px white;
			}
			p {
				line-height: 140%;
				font-size: 90%;
			}
			#accordion {
				margin: 100px;
			}
			#accordion article {
				-webkit-transform: perspective(900px) rotateY(60deg);
				-webkit-transition: all 0.7s ease-in-out;
				background: #fff;
				border: 1px solid #f3f3f3;
				box-shadow: 0px 5px 15px gray;
				float: left;
				height: 420px;
				margin-left: -180px;
				padding: 20px;
				width: 250px;
			}
			#accordion article:first-child {
				margin-left: 0px;
			}
			#accordion article img {
				float: left;
				padding: 0 10px 5px 0;
			}
			#accordion article:hover {
				-webkit-transform: perspective(0) rotateY(-10deg);
				margin: 0 140px 0 -60px;
			}
		</style>
<div id="resume_wrapper">
<h1>
	<br/>
	<?php echo $lang->RESUMEBUILDER; ?>
</h1>
<h3>
	<?php echo $lang->CHOOSETEMPLATE; ?>
</h3>
<div id="main">
<div id="accordion">
	<article>
		<p><h3>Template 1</h3></p>
	    <img border=1 px red src="../images/resume1.jpg"
		rel="#mies2" width=200px height=400px/>
	</article>
	<article> 
		<p><h3>Template 2</h3></p>
		<img border=1 px #cccc src="../images/resume3.jpg"
		 rel="#mies1" width=200px height=400px /> 
	</article>
	<article>
		<p><h3>Template 3</h3></p>
		<img border=1 px #cccc src="../images/resume2.jpg" 
		 rel="#mies3" width=200px height=400px />
	</article>
	<form action="word.php" method=post>
		<div class="simple_overlay" id="mies1">
			<!-- large image -->
			<img src="../images/resume3.jpg" />

			<!-- image details -->
			<div class="details">
				<h3>
					<?php echo $lang->TEMPLATE2; ?>
				</h3>
				<h4>
					<?php echo $lang->WITHSNAPSHOT; ?>
				</h4>
				<p>					
				<ol>
					<li><?php echo $lang->OBJECTIVE; ?></li>
					<li><?php echo $lang->SNAPSHOT; ?></li>
					<li><?php echo $lang->EDUCATION; ?></li>
					<?php echo $lang->OTHERCOURSE; ?>
					<li><?php echo $lang->TECHNICALSKILL; ?></li>
					<li><?php echo $lang->PROJECT; ?></li>
				</ol>
				</p>
				<br /> <Input Type=Submit value="use this template" name="template2" />
			</div>
		</div>
		<div class="simple_overlay" id="mies2">
			<!-- large image -->
			<img src="../images/resume1.jpg" />

			<!-- image details -->
			<div class="details">
				<h3>
					<?php echo $lang->TEMPLATE1 ?>
				</h3>
				<h4>
					<?php echo $lang->WITHPHOTO; ?>
				</h4>
				<h3>
					<ol>
						<li><?php echo $lang->CONTACTINFO; ?></li>
						<li><?php echo $lang->PERSONALINFO; ?></li>
						<li><?php echo $lang->EDUCATION; ?></li>
						<li><?php echo $lang->STRENGHT; ?></li>
						<li><?php echo $lang->EMPLOYMENTINFO; ?></li>
					</ol>
				</h3>
				<br /> <Input Type=Submit value="use this template" name="template1" />
			</div>
		</div>
		<div class="simple_overlay" id="mies3">
			<!-- large image -->
			<img src="../images/resume2.jpg" />
			<!-- image details -->
			<div class="details">
				<h3>
					<?php echo $lang->TEMPLATE3; ?>
				</h3>
				<h4>
					<?php echo $lang->WITHEXPER; ?>
				</h4>
				<h3>
					<ol>
						<li><?php echo $lang->OBJECTIVE; ?></li>
						<li><?php echo $lang->EDUCATION; ?></li>
						<li><?php echo $lang->STRENGHT; ?></li>
						<li><?php echo $lang->CAREERGRAPH; ?></li>
						<li><?php echo $lang->CURRENTCOMPANY; ?></li>
						<li><?php echo $lang->WORKEXPERIENCE; ?></li>
					</ol>
				</h3>
				<br /> <Input Type=Submit value="use this template" name="template3" />
			</div>
		</div>
		<br />
	</form>
	</div>
</div>	
</div>