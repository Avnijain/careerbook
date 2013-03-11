<?php
include_once("../classes/lang.php");
?>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" type="text/css" href="./css/mainpage.css" />
	<script type="text/javascript"></script>
    </head>
<body>
    <div id="main"><br/>
    <h2><label id="text-label">Login</label></h2><br/>
    <div id ='login'>
	<form action="./controller/mainentrance.php?action=login" method="post">
            <table>
	        <tr>
	            <td><label class="text-label">User Id</label></td>
	            <td><input id="text-feild" type="text" name=userid></td>
	        </tr>
	        <tr>
                    <td><label class="text-label">Password</label></td>
                    <td><input id="text-feild" type="password" name=password></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input id="submit-button" type="submit" value=Login></td>
                </tr>
            </table>
	</form>
	<a id="hyperlink" href="#"><?php echo $lang->FORGETPASSWORD; ?></a><br/><br/>
        <label class="text-label"><?php echo $lang->STILLNOTREG; ?></label><br/><br/>
        <button id="signup_button" onclick=""><?php echo $lang->SIGNUP; ?></button>
    </div>
</body>
</html>
