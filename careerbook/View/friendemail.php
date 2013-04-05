<?php
session_start();
$friendemail=($_SESSION['emailid']);
//print_r($friendemail);
$i=0;
foreach ($friendemail as $keys=>$values){
	echo $friendemail[$i]['email_primary'];
	echo ","; 
	$i++;
}
?>
