<?php include_once("../classes/lang.php");?>

<html lang="en">
    <head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="./css/login-form.css" media="screen">
        <script src="./js/login-form.js"></script>
	<style>
            body{background:url(img/bg.png) center;margin: 0 auto;width: 960px;padding-top: 50px}
            .footer{margin-top:50px;text-align:center;color:#666;font:bold 14px Arial}
            .footer a{color:#999;text-decoration:none}.login-form{margin: 50px auto;}
        </style>
    </head>
    <body>
        <div class="login-form">
            <h1><?php echo $lang->LOGIN?></h1>
            <form action="#">
                <input type="text" name="username" placeholder="username">   
                <input type="password" name="password" placeholder="password">  
                <span>
                    <input type="checkbox" name="checkbox">
                    <label for="checkbox"><?php echo $lang->REMEMBER?></label>
                </span>
                <input type="submit" value="log in">
            </form>
        </div>
    </body>
</html>