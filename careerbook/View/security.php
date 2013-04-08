<?php 

ini_set ( 'session.cookie_httponly', true );
ini_set ( 'session.use_only_cookies', true);
ini_set ( 'session.hash_function', "sha512");
ini_set ( 'session.hash_bits_per_character', 5);

include_once ("../classes/lang.php");
require_once '../controller/userInfo.php';

//********************************************************************************************************************
$objUserInfo = unserialize ( $_SESSION ['userData'] );
$userData = $objUserInfo->getUserPersonalInfo ();

$SID=$_COOKIE['PHPSESSID'];
$fileName="../temp/".$userData['email_primary'].".txt";
if($data=file_get_contents($fileName))
{
	if($data != md5($SID))
	{
		unset($_SESSION);
		session_destroy();
		header ( "location:../index.php" );						//multiple login save
		die ();
	}
}
else
{
	unset($_SESSION);
	session_destroy();
	header ( "location:../index.php" );
	die ();
}
//***********************************************************************************************************************
$token=md5($_SESSION['secureSessionHijack'].$SID.$userData['email_primary']);
if($token==$_COOKIE['userToken'])
{
	$_SESSION['secureSessionHijack'] = rand(100000,999999);
	$token=md5($_SESSION['secureSessionHijack'].$SID.$userData['email_primary']);
	setcookie("userToken",$token , time()+3600*24,"/");
}
else											//session hijacking save
{
	unlink($fileName);
	unset($_SESSION);
	session_destroy();
	header ( "location:../index.php" );
	die ();
}
//************************************************************************************************************************



?>

