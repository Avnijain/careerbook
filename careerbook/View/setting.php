<?php
include_once("../classes/lang.php");
?>
<link href="../css/setting.css" rel="stylesheet" />

 
<script type="text/javascript" src="../JavaScript/friends.js"></script>
<script language="javascript">
$(document).ready(function() {
	
	$('#nav-bar').fadeIn();
	
	$('#Changepassword').click(function() {
		
		$('#login').hide().css({'left' : '0px','top':'210px'});
		$('#delete').css('background-color', '#000000');		
		$('#SignupForm').hide().css({'top' : '0px'});
		$('#submit').hide();
		$('#login').show().animate({
		
			left   : '55%',
			
		},400,function(){
			
			$('#login').css({'-webkit-transform' : 'rotate(-0deg)','-moz-transform' : 'rotate(-0deg)' });
		
		});
		///
		$('#Login_form').show().animate({
	
			top   : '210px',
			
		},700,function(){
			
			//$('#image').css({'-webkit-transform' : 'rotate(-90deg)','-moz-transform' : 'rotate(-90deg)' });
		});
	});
	
	$('#delete').click(function() {
		
		$('#signUp').css('background-color', '#006699');
		$('#Log-in').css('background-color', '#000000');
		$('#submit').hide().css({'left' : '0px','top':'210px'});
		$('#login').hide().css({'left' : '0px','top':'210px'});
		$('#Login_form').hide().css({'top' : '0px'});
		
		$('#submit').show().animate({
		
			left   : '55%',
			
		},400,function(){
			
			$('#submit').css({'-webkit-transform' : 'rotate(-0deg)','-moz-transform' : 'rotate(-0deg)' });
		
		});
		///
		$('#SignupForm').show().animate({
	
			top   : '210px',
			
		},700,function(){
			
			//$('#image').css({'-webkit-transform' : 'rotate(-90deg)','-moz-transform' : 'rotate(-90deg)' });
		});
	});
	
});
</script>
	<img src="../images/changepwd.jpg" id="login" />
	<img src="../images/delete.jpg" id="submit" width=200 height=60/>
	<div id="settingdiv">
	<div class="settingform" id="Login_form">
		
        <form action="../controller/mainentrance.php?action=chngPwd" method="post" name="cngPWD">
		
			
			
			<div class="form-item">
			<tr>
			 <label for="edit-name"><?php echo $lang->CURRENTPASSWORD?></label>
			 <input type="password" name="currPwd" id="currentPwd" />
			 </tr>
			</div>
			
			<div class="form-item">
			
			 <label for="edit-pass"><?php echo $lang->NEWPASSWORD?></label>&nbsp;&nbsp;&nbsp;
			 <input type="password" name="newPwd" id="newPwd" />
			</div>
			
			
			<div class="form-item">
			
			 <label for="edit-pass"><?php echo $lang->CONFIRMPASSWORD?></label>
			 <input type="password" name="confirmPwd" id="confirmPwd" />
			</div>
			<input type="submit" class="btn blue" value="Submit"  />
						<input type="button" class="btn blue" value="Cancel" onclick="cancle();" />
				<br/>
				<?Php if(isset($_REQUEST['err'])&&($_REQUEST['err']=="4")) {
				?><center><?PHP echo $lang->SETTINGMSG1; ?></center><?php }?>
				<?Php if(isset($_REQUEST['err'])&&($_REQUEST['err']=="5")) {
				?><center><?PHP echo  $lang->SETTINGMSG2; ?></center><?php }?>
				<?Php if(isset($_REQUEST['err'])&&($_REQUEST['err']=="2")) {
				?><center><?PHP echo  $lang->SETTINGMSG3; ?></center><?php }?>
				<?Php if(isset($_REQUEST['Success'])) {
				?><center><?PHP echo  $lang->SETTINGMSG4; ?></center><?php }?>
			</div>
		</form>
		</div>
	</div>
	
	<div class="settingform" id="SignupForm">
		
        <form action="../controller/mainentrance.php?action=delUser" method="post" name="cngPWD">
		
			<div>
			<div class="form-item">
			
			 <label for="edit-name"><?php echo $lang->CONFIRMDELETION?></label></br>
			<input type="submit" class="btn blue" value="Yes" name='yes' />
			 <input type="button" class="btn blue" value="No" name='no' onclick="cancle();" />
			</div>
			
			</div>
		</form>
		
	</div>
	<div id="nav-bar">
	
		<div class="module-bg">
			<a href="#" class="TopButtons" id="Changepassword"><?php echo $lang->CHANGEPASSWORD?></a>
			<a href="#" class="TopButtons" id="delete"><?php echo $lang->DELETEACCOUNT?></a>
		</div>
		
	</div>
	
	<!--<img src="reg.png" id="register" />-->