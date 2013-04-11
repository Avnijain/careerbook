<?php
include_once("../classes/lang.php");
?>
<!--
<script type="text/javascript" src="../JavaScript/jquery1.min.js"></script>
-->

<script type="text/javascript" src="../JavaScript/friends.js"></script>
<script type="text/javascript" src="../JavaScript/jquery.idTabs.min.js"></script>
<heading><h1><?php echo $lang->SETTINGS?></h1></heading>


<div id='options'>
	<ul class="idTabs">
		<li><a href="#jquery"><?php echo $lang->CHANGEPASSWORD?></a></li>
		<li><a href="#official"><?php echo $lang->DELETEACCOUNT?></a></li>
	</ul>
</div>

<div id="perform">
	<div id="jquery">
		<form action="../controller/mainentrance.php?action=chngPwd" method="post" name="cngPWD">
			<table>
				<tr>
					<td><lable class="seting"><?php echo $lang->CURRENTPASSWORD?></lable></td>
					<td><input type="password" name="currPwd" id="currentPwd" /></td>
				</tr>
				<tr>
					<p class="seting"><?php echo $lang->ENTERPASSWORDMSG?></p>
				</tr>
				<tr>
					<td><lable class="seting"><?php echo $lang->NEWPASSWORD?></lable></td>
					<td><input type="password" name="newPwd" id="newPwd" /></td>
				</tr>
				<tr>
					<td><lable class="seting"><?php echo $lang->CONFIRMPASSWORD?></lable></td>
					<td><input type="password" name="confirmPwd" id="confirmPwd" /></td>
				</tr>
				<tr>
					<td><center><input type="submit" class="btn blue" value="<?php echo $lang->SUBMIT; ?>"/>
						<input type="button" class="btn blue" value="<?php echo $lang->CANCEL; ?>" onclick="cancle();" /></center>
						</td>
				</tr>
			</table>
		</form>

	</div>

	<div id="official">
		<form action="../controller/mainentrance.php?action=delUser" method="post" name="cngPWD">
			<p class="seting"><?php echo $lang->CONFIRMDELETION?></p>
			<input type="submit" class="btn blue" value="Yes" name='yes' />
			 <input type="button" class="btn blue" value="No" name='no' onclick="cancle();" />
		</form>
	</div>
<?php 
if(isset($_GET['err']))
{
	echo "<p class='seting'>$lang->SEETINGERROR".$_GET['err']."<p>";
}
if(isset($_GET['Success']))
{
	echo "<p class='seting'>$lang->SUCESSMSG<p>";
}
?>
</div>

<style>
#SettingHead {
	font-family: times, Times New Roman, times-roman, georgia, serif;
	font-size: 48px;
	line-height: 40px;
	letter-spacing: -1px;
	color: #444;
	margin: 0 0 0 0;
	padding: 0 0 0 0;
	font-weight: 100;
	text-align: center;
}

#options a {
	font-family: times, Times New Roman, times-roman, georgia, serif;
	font-size: 20px;
	line-height: 20px;
	letter-spacing: 0px;
	color: #444;
	margin: 3 0 0 1;
	padding: 15 0 0 0;
	cursor: pointer;
	font-weight: 100;
}

#options {
	float: left;
	margin-top: 19px;
}



#perform {
	float: left;
	margin-top: 20px;
	border: 3px black double;
}

#options>ul {
	margin: 10 0 0 1;
}

#options>ul>li {
	border: groove 2px black;
	display: inline;
	background-color: #239CC5;
	list-style-type: none;
	width: 97%;
	height: 5%;
	margin: 3 0 0 1;
	padding: 15 0 0 0;
	cursor: pointer;
	font-weight: 100;
}

.seting {
	font-family: times, Times New Roman, times-roman, georgia, serif;
	font-size: 16px;
	line-height: 20px;
	letter-spacing: 0px;
	color: #444;
	margin: 0 5 0 9;
	padding: 2 0 0 0;
	font-weight: 100;
}

#options ul li:hover {
	background-color: #23922D;
}
heading { float:left; background:url(../images/content-heading.gif) right top no-repeat; color: #FFFFFF; padding:10px 85px 60px 85; }
</style>