	
	
<?php
if (! isset ( $_GET ['code'] )) {
	?>





<style>

#myBox {
	margin: 19%;
}
</style>


	<div id="myBox">
		<p>Please enter your primary email ID</p>
		<form action="../controller/mainentrance.php?action=forgetPasswd" method="post">
		
			<?php
			include_once 'captcha.php';
			?>
            
	
			<br/>
			<table>
				<tr>
					<td><label class="text-label">Email ID</label></td>
					<td><input id="text-feild" type="text" name=userid></td>
				</tr>
				<tr>
					<td><input id="submit-button" type="submit" value="Submit"></td>
				</tr>
			</table>
		</form>
	</div>

<?php
} else {
	
	// *********************************************send mail here
	// **********************************
	//
	//
	// set session variable 'userMailCode'
	//
	//
	// **************************************************END******************************************
	
	?>
	
<script src="../JavaScript/jquery.tools.min.js"></script>	
	
<script>
    
    function closeMe()
    {
       parent.$.fancybox.close();
    }
    
</script>

<div id="myBox">
	<p>We sent you a change password link to your mail <br>please change your password and <a href="#" onclick='closeMe();'>Login</a></p>
	</div>
<?php
}
?>
	
	
	
	
	
	