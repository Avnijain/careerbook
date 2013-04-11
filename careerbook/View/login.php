<?php 
include_once("/classes/lang.php");
?>
<section class="main">
	<form class="form-1"
		action="./controller/mainentrance.php?action=login" method="post">
		<p class="field">
			<input type="text" name="userid" placeholder="<?php echo $lang->EMAILID?>"> <i
				class="icon-user icon-large"></i>
		</p>
		<p class="field">
			<input type="password" name="password" placeholder="<?php echo $lang->PASSWORD?>"> <i
				class="icon-lock icon-large"></i>
		</p>
		<p class="submit">
			<button type="submit" name="submit">
				<i class="icon-arrow-right icon-large"></i>
			</button>
		</p>
		<div class="form-3">
			<p class="clearfix">
				<input type="button" name="forgetpassword" value="<?php echo $lang->FORGETPASSWORD?>"
					onclick="forgetPwdOverlay()"> <input type="button" name="signup"
					id="<?php echo $lang->SIGNUP?>" onclick="testoverlay()" value="Sign Up">
			</p>
		</div>
	</form>
</section>




