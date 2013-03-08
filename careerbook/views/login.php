<link rel="stylesheet" href="css/login-form.css" media="screen"></link>
<script src="../JavaScript/modernizr.custom.63321.js"></script>
		<!--[if lte IE 7]><style>.main{display:none;} .support-note .note-ie{display:block;}</style><![endif]-->
<script type="text/javascript">
	function openRegisterWindow()
	{
		
	}	
</script>

<!-- 	<h1>Login Form</h1> -->
<!-- 	<form action="./controller/mainentrance.php?action=login" method="post"> -->
<!-- 	<fieldset> -->
<!-- 		<label for="userid" >Username</label> -->
<!-- 		<input type="text" name="userid" placeholder="username" > -->
<!-- 		<label for="password" >Password</label> -->
<!-- 		<input type="password" name="password" placeholder="password"></br> -->
<!--     </fieldset> -->
<!--     <fieldset>		 -->
<!-- 		<span> -->
<!-- 			<input type="checkbox" name="checkbox"><br/> -->
<!-- 			<label for="checkbox">remember</label> -->
<!-- 		</span> -->
<!-- 	</fieldset> -->
<!-- 	<fieldset> -->
<!-- 		<button type="submit" value="Log in">Sign In</button> -->
<!-- 	</fieldset> -->
<!-- 	</form> -->
<!-- 	<br/><br/><br/> -->
<!-- 	<label>Forget Password</label></br></br> -->
<section class="main">
				<form class="form-1" action="./controller/mainentrance.php?action=login" method="post">
					<p class="field">
						<input type="text" name="userid" placeholder="Username or email">
						<i class="icon-user icon-large"></i>
					</p>
						<p class="field">
							<input type="password" name="password" placeholder="Password">
							<i class="icon-lock icon-large"></i>
					</p>
					<p class="submit">
						<button type="submit" name="submit"><i class="icon-arrow-right icon-large"></i></button>
					</p>
					<div class="form-3">
				    <p class="clearfix">
				        <input type="button" name="forgetpassword" value="Forget Password">
				        <input type="button" name="signup" value="Sign Up">
				    </p>				    
				    </div>			
				</form>
</section>



