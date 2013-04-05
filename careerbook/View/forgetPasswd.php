	
	
<?php
include_once("../classes/lang.php");
if (! isset ( $_GET ['code'] )) {
	?>
<style>

#myBox {
	margin: 15%;
}
</style>


	<div id="myBox">
		<p><?php echo $lang->FORGETPWDMSG1?></p>
		<form action="../controller/mainentrance.php?action=forgetPasswd" method="post">
		
			<?php
			include_once 'captcha.php';
			?>
            
	
			<br/>
			<table>
				<tr>
					<td><label class="text-label"><?php echo $lang->EMAILID?></label></td>
					<td><input id="text-feild" type="text" name=userid></td>
				</tr>
				<tr>
					<td><input id="submit-button" type="submit" value="Submit"></td>
				</tr>
			</table>
		</form>
		<?php 
		if(isset($_GET['err']))
		{
		echo "You have error no:".$_GET['err'];
		}
		?>
	</div>

<?php
} else {
		
	?>
	
<script src="../JavaScript/jquery.tools.min.js"></script>	
	
<script>
    
    function closeMe()
    {
       parent.$.fancybox.close();
    }
    
</script>

<div id="myBox">
	<p><?php echo $lang->FORGETPWDMSG2?><a href="#" onclick='closeMe();'><?php echo $lang->FORGETPWDLOGIN?></a></p>
	</div>
<?php
}
?>
	
	
	
	
	
	