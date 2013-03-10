<?php

?>


<link href="../css/captchastyle.css" rel="stylesheet" type="text/css">

<script>
$(document).ready(function() { 

 // refresh captcha
 $('img#captcha-refresh').click(function() {  
		
		change_captcha();
 });
 
 function change_captcha()
 {
	document.getElementById('captcha').src="get_captcha.php?rnd=" + Math.random();
 }
 
});
 	
</script>		 



<div align="center">
	
	
	
	<!-- Captcha HTML Code -->
	
	<div id="captcha-wrap">captcha
		<div class="captcha-box">
			<img src="get_captcha.php" alt="" id="captcha" />
		</div>
		<div class="text-box" style="height: 40px;">
			<label>Type the two words:</label>
			<input name="captcha-code" type="text" id="captcha-code" style="width: 120px; height: 10px; margin-left: 2% ">
		</div>
		<div class="captcha-action">
			<img src="../images/refresh.jpg"  alt="" id="captcha-refresh" width="20px"/>
		</div>
	</div>
	
	<!--  Copy and Paste above html in any form and include CSS, get_captcha.php files to show the captcha  -->
	
	
</div>


<?php echo (string)$_SESSION['random_number'];?>

