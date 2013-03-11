<?php
include_once("./classes/lang.php");
?>
<html>
    <head>
        <title>Career Book : Home</title>
        <link rel="stylesheet" type="text/css" href="./css/mainpage.css" />
        <style type="text/css">
        div {
         /*border : 1px solid red;*/
        
        }

        
        </style>
    </head>
    <body id="mainBody">
        
        <div id="main">
            <div id="mainHeaderContainer">
                <?php require_once './views/header.php'; ?>
            </div>
            <div id="left">
                <?php require_once './views/slider.php'; ?>
            </div>
            <div id="right">
                <?php require_once './views/login.php'; ?>
            </div>
            <div id="googleAdds"></div>
            <div id="footer">
                    <center><?php echo $lang->FOOTER; ?></center>
            </div>
        </div>
    </body>
</html>
