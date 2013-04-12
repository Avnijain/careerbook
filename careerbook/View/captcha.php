<link href="../css/captchastyle.css" rel="stylesheet" type="text/css">

<script>
$(document).ready(function() {
 $('img#captcha-refresh').click(function() {  
		
		change_captcha();
 }); 
 function change_captcha()				// refresh captcha
 {
	document.getElementById('captcha').src="get_captcha.php?rnd=" + Math.random();
 }
});
</script>
<div align="center">	
	<div id="captcha-wrap"><?php echo $lang->CAPTCHA ?>
		<div class="captcha-box">
			<img src="get_captcha.php" alt="" id="captcha" />
		</div>
		<div class="text-box" style="height: 40px;">
			<label><?php echo $lang->CAPTCHAMSG ?></label>
			<input name="captcha-code" type="text" id="captcha-code" style="width: 80%; height: 50%; margin-left: 2% ">
		</div>
		<div class="captcha-action">
			<img src="../images/refresh.jpg"  alt="" id="captcha-refresh" width="20px"/>
		</div>
	</div>
</div>