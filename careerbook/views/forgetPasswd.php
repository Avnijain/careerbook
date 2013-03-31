	
	
<?php 
if(!isset($_GET['code'])){
?>	

<b><a href="" onclick='closeMe();'>Login</a></b>
	   <script src="../JavaScript/jquery.tools.min.js"></script>
<script>
    
    function closeMe()
    {
        parent.$.fancybox.close();

    }
    
</script>

<div id="myBox">	
	<p>Please enter your primary email ID</p>
	<form action="forgetPasswd.php?code" method="post">
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
}
else{ 

	//*********************************************send mail here **********************************
	//
	//
	//set session variable 'userMailCode'
	//
	//
	//**************************************************END******************************************
	
	?>
<div id="myBox">
<p>We sent you </p>
		<form action="./controller/mainentrance.php?action=setPasswd" method="post">
            <table>
	        <tr>
	            <td><label class="text-label">Enter Code Here:</label></td>
	            <td><input id="text-feild" type="text" name=userid></td>
	        </tr>
                <tr>
                    <td></td>
                    <td><input id="submit-button" type="submit" value="Submit"></td>
                </tr>
            </table>
	</form>
</div>
	<?php 
	}
	?>
	
	
	
	
	
	