<?php
include_once("../lang/lang.php");
require_once '../controller/userpersnlinfo.php';

session_start();
$ip= $_SERVER['REMOTE_ADDR'];
echo IPADDRESS;
echo "<br> " . $ip;
echo "<br>";
echo $_SERVER['HTTP_USER_AGENT'];
    if(isset($_SESSION['userData']))
    {
        $obj = new user_info_controller();
        $obj = unserialize($_SESSION['userData']);
        print("<br/>");
	print("first_name =>".$obj->getuserinfo('first_name'));print("<br/>");
	print("middle_name =>".$obj->getuserinfo('middle_name'));print("<br/>");
	print("last_name =>".$obj->getuserinfo('last_name'));print("<br/>");
	print("date_of_birth =>".$obj->getuserinfo('date_of_birth'));print("<br/>");
//        echo "<pre>";
//        print_r($obj);
//        echo "</pre>";
    }
    else
    {
       header("location:../index.php");
	die;   
    }
?>

<script type='text/javascript'>
    
    $(document).ready(function(){
    var x = screen.width/2 - 700/2;
    var y = screen.height/2 - 450/2;
    window.open("views/registration.php", 'registration','height=485,width=700,left='+x+',top='+y);
});
    
</script>
