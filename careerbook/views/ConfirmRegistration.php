<?php 
include_once("../classes/lang.php");

 
echo $lang->CONFIRMATIONMSG ;?>
<b><a href='#' onclick='closeMe();'>Login</a></b>
<script>
    
    function closeMe()
    {
       parent.closeIFrame();
    }
    
</script>