<?php
include_once("../classes/lang.php");
if (! isset ( $_GET ['code'] )) {
	?>
<style>

#myBox {
	margin: 15%;
	
}
.main{
background: url(../images/fpd.jpg) repeat-x 0px 0px;
}
.btn {
 display: inline-block;
 background: url(btn.bg.png) repeat-x 0px 0px;
 padding:5px 10px 6px 10px;
 font-weight:bold;
 text-shadow: 1px 1px 1px rgba(255,255,255,0.5);
 border:1px solid rgba(0,0,0,0.4);
 -moz-border-radius: 5px;
 -moz-box-shadow: 0px 0px 2px rgba(0,0,0,0.5);
 -webkit-border-radius: 5px;
 -webkit-box-shadow: 0px 0px 2px rgba(0,0,0,0.5);
 font-size: 14px;
  text-decoration: none;
  font-family: Arial, Helvetica, sans-serif;
}

.btn:hover {
 text-shadow: 1px 1px 1px rgba(0,0,0,0.5);
 cursor:pointer;
}

/* COLOR VARIATIONS */

.blue {background-color: #CCCCCC; color: #141414;}
.blue:hover {background-color: #00c0ff; color: #ffffff;}
</style>

	<div class="main">
	<div id="myBox">
		<p style="font-size:22px; color:#B7DEF2; font-weight:bold;"><?php echo $lang->FORGETPWDMSG1?></p>
		<form action="../controller/mainentrance.php?action=forgetPasswd" method="post">
		
			<?php
			include_once 'captcha.php';
			?>
            
	
			<br/>
			<table>
				<tr>
					<td style="font-size:14px; color:#7F929B;"><label class="text-label"><?php echo $lang->EMAILID?></label></td>
					<td><input id="text-feild" type="text" name=userid></td>
				</tr>
				<tr>
					<td><input id="submit-button" class="btn blue" type="submit" value="<?php echo $lang->SUBMIT?>"></td>
				</tr>
			</table>
		</form>
		<?php 
		if(isset($_GET['err']))
		{
			if($_GET['err']==1)
			{
				echo $lang->CAPTCHA;
			}
			else if($_GET['err']==2)
			{
				echo $lang->NOTFOUND;
			}
		}
		?>
	</div>
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
<div class="main">
<div id="myBox">
	<center><p style="font-size:24px; color:#7F929B;"><?php echo $lang->FORGETPWDMSG2?><a href="#" onclick='closeMe();'><?php echo $lang->FORGETPWDLOGIN?></a></p>
	</center>
	</div>
	</div>
<?php
}
?>