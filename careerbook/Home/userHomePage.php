<?php
ini_set ( 'session.cookie_httponly', true );
ini_set ( 'session.use_only_cookies', true);
ini_set ( 'session.hash_function', "sha512");
ini_set ( 'session.hash_bits_per_character', 5);

include_once ("../classes/lang.php");
include_once("../classes/dateManipulation.php");
include_once('../classes/friendsClass.php');
include_once('../classes/groupClass.php');



include_once '../controller/message_controller.php';
require_once '../controller/userInfo.php';
include_once "../controller/friends_controller.php";
require_once '../controller/profile_controller.php';
require_once '../controller/mainentrance.php';




if (! isset ( $_SESSION ['userData'] )) {
	header ( "location:../index.php" );
	die ();
}

$objUserInfo = unserialize ( $_SESSION ['userData'] );
$userData = $objUserInfo->getUserPersonalInfo ();
$fileName="../temp/".$userData['email_primary'].".txt";

if (isset ( $_GET ['profile'] )) {
    include_once '../View/homeInterface.php';
    if(isset($_GET ['close'])) {
        echo '<script type="text/javascript">'
            , 'closeME();'
                , '</script>';
    }
    include_once '../View/menu.php';  
    $objUserInfo = unserialize($_SESSION['userData']);
    $UserPersonalInfoDB = $objUserInfo->getUserPersonalInfoDB();
    $UserAcademicInfoDB = $objUserInfo->getUserAcademicInfoDB();
    $UserAddressInfoDB = $objUserInfo->getUserAddressInfoDB();
    $UserProjectInfoDB = $objUserInfo->getUserProjectInfoDB();
    $UserCertificateInfoDB =  $objUserInfo->getUserCertificateInfoDB();
    $UserProfessionalInfoDB = $objUserInfo->getUserProfessionalInfoDB();
    $UserPreviousJobInfoDB =  $objUserInfo->getUserPreviousJobInfoDB();
    $UserExtraCurricularInfoDB =  $objUserInfo->getUserExtraCurricularInfoDB();
    $_SESSION['userData'] = serialize($objUserInfo);    
	include_once '../View/UserInfoForm.php';
	include_once '../View/footer.php';
} else if (isset ( $_GET ['resume'] )) {
  include_once '../View/homeInterface.php';
    if(isset($_GET ['close'])) {
        echo '<script type="text/javascript">'
            , 'closeME();'
                , '</script>';
    }
    include_once '../View/menu.php';
	include '../View/resume.php';
	include_once '../View/footer.php';

} else if (isset ( $_GET ['logOut'] )) {
	unlink($fileName);
	unset($_SESSION);
	session_destroy();
	header ( "location:../index.php" );
	die ();
} else if (isset ( $_GET ['message'] )) {
    include_once '../View/homeInterface.php';
    if(isset($_GET ['close'])) {
        echo '<script type="text/javascript">'
            , 'closeME();'
                , '</script>';
    }
    include_once '../View/menu.php';
	include '../View/message.php';
	include_once '../View/footer.php';	
	
} else if (isset ( $_GET ['information'] )) {
    include_once '../View/homeInterface.php';
    if(isset($_GET ['close'])) {
        echo '<script type="text/javascript">'
            , 'closeME();'
                , '</script>';
    }
    include_once '../View/menu.php';
    
    if(isset($_SESSION['userData']))
    {
        $ob1 = new user_info_controller();
        $ob1 = unserialize($_SESSION['userData']);
        $userid = $ob1->getUserIdInfo();
        $idd = $userid['id'];
    }
    if (isset($_REQUEST['user_id']) && isset($_REQUEST['hash'])) //if viewing friend's profile
    {
    
        $str= date('ymd');
        $time=strtotime($str);
        $hash=md5($time.$lang->KEY.$_REQUEST['user_id']);
    
        if($_REQUEST['hash']==$hash) {
    
            $id=$_GET['user_id'];	//getting the friend's user id
        }
        else {
            $id=$idd;
        }
    }
    else {							//viewing own profile
    
        $id=$idd;
    }
    
    $obj->setId($id);				 //setting the id of the user in profile class through profile controller function
    
    /***********Getting All user information from profile model class through profile controller functions******************/
    $acdemicInfo=$obj->handleAcademicInfo();
    $personalInfo=$obj->handlePersonalInfo();
    $projectInfo=$obj->handleProjectInfo();
    $jobInfo=$obj->handlePreviousJobInfo();
    $professionalInfo=$obj->handleProfessionalInfo();
    $certificateInfo=$obj->handleCertificateInfo();
    if(!empty($personalInfo['0']['date_of_birth'])) {             // to get the age in years of the user
        $age=$objdate->getAge($personalInfo['0']['date_of_birth']);
        $year=explode(" ",$age);
        $onlyYear=$year[0];
        $userAge=explode("-",$onlyYear);
    }
    
	include '../View/information.php';
	include_once '../View/footer.php';
}else if(isset ( $_GET ['contactUs'] )){
if(isset($_SESSION['userData']))   					//to get current user login information
{
    $ob1 = new user_info_controller();
    $ob1 = unserialize($_SESSION['userData']);
    $userid = $ob1->getUserIdInfo();
    $id = $userid['id'];
}
$obj->setId($id);
$UserPersonalInfoDB = $objUserInfo->getUserPersonalInfo();
$personalInfo=$obj->handlePersonalInfo();
require_once '../View/contactform.php';
} 
else{
include_once '../View/homeInterface.php';
if(isset($_GET ['close'])) {
    echo '<script type="text/javascript">'
        , 'closeME();'
            , '</script>';
}
include_once '../View/menu.php';
   include '../Home/userHomeContent.php';
   include_once '../View/footer.php';
}
?>