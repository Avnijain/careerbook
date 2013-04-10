<?php 

ini_set ( 'session.cookie_httponly', true );
ini_set ( 'session.use_only_cookies', true);
ini_set ( 'session.hash_function', "sha512");
ini_set ( 'session.hash_bits_per_character', 5);

include_once ("../classes/lang.php");
require_once '../controller/userInfo.php';
require_once "../classes/class.phpmailer.php";
require_once "../classes/class.smtp.php";
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
// if($token==$_COOKIE['userToken'])
// {
// 	$_SESSION['secureSessionHijack'] = rand(100000,999999);
// 	$token=md5($_SESSION['secureSessionHijack'].$SID.$userData['email_primary']);
// 	setcookie("userToken",$token , time()+3600*24,"/");
// }
// else											//session hijacking save
// {
// 	unlink($fileName);
// 	unset($_SESSION);
// 	session_destroy();
// 	header ( "location:../index.php" );
// 	die ();
// }
//************************************************************************************************************************
	
	$file=fopen('../temp/PHP_errors_temp.log',"a");					//mutiple login save
	$data="";
	$data1=file_get_contents('../logs/PHP_errors.log');
	$data2=file_get_contents('../temp/PHP_errors_temp.log');
	
	$data1Length = strlen($data1);
	$data2Length = strlen($data2);
	
	
	if($data1Length > $data2Length)
	{
		$data=substr($data1,$data2Length,$data1Length);
	
			fwrite($file,$data);
			fclose($file);
			//code to mail log file
			$mail = new PHPMailer();
			$mail->IsSMTP();
			$mail->SMTPAuth = true;
			$mail->Host = "ssl://smtp.gmail.com";
			$mail->Port = 465;
			$mail->Username = "careerbook2013@gmail.com";
			$mail->Password = "2013careerbook*";
			$mail->SMTPDebug = 1;
			$webmaster_email = "careerbook2013@gmail.com";
			
			$email="careerbook2013@gmail.com";
			$name="Error Log";
			
			
			$mail->From = $webmaster_email;
			$mail->FromName = "CareerBook";
			$mail->AddAddress($email,$name);
			$mail->AddReplyTo($webmaster_email,"Webmaster");
			$mail->WordWrap = 50; // set word wrap
			$mail->IsHTML(true); // send as HTML
			$mail->Subject = 'Error in careerbook';
			$mail->Body="<br>Dear Admin,an error has been occured at your site...<br>".
					$data."<br>";
			$mail->AltBody = "This is the body when user views in plain text format"; //Text Bod
			
			$mail->Send();
	}
		

	//}


?>