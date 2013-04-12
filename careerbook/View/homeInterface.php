<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title><?php echo $lang->USERINFOFORM;?></title>
<link rel="stylesheet" type="text/css" href="../css/style.css"></link>
<script type="text/javascript">
        function closeME() {
            parent.$.fancybox.close(); 
        }
        function changeToken() {
       	 $.post("../View/security.php",function(data){});
       	}
       	var id = setInterval('changeToken();', 10000);
</script>
<script src="../JavaScript/jquery-1.7.1.js"></script>
<script type="text/javascript" src="../JavaScript/fancybox/jquery.fancybox-1.3.4.js"></script>
<script type="text/javascript" src="../JavaScript/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="../JavaScript/fancybox/jquery.fancybox-1.3.4.css" ></link>
<script src="../JavaScript/jquery.validate.min.js"></script>
<script type="text/javascript" src="../JavaScript/group.js"> </script>