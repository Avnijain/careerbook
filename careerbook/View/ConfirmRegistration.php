<?php 
    include_once("../classes/lang.php");
    echo $lang->CONFIRMATIONMSG ;
?>

<b><a href='#' onclick='closeMe();'><?php echo $lang->LOGIN;?></a></b>

<script>    
    function closeMe()
    {
       parent.$.fancybox.close();
    }    
</script>