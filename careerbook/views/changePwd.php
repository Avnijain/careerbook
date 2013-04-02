<?php 


ini_set("display_errors", "1");
include_once '../classes/lang.php';


// $str= date('ymd')+1;
// $time=strtotime($str);
// $hash=md5($time.$lang->KEY.$_GET['id']);
// $link=$_SERVER["DOCUMENT_ROOT"]."/careerbook/views/changePwd?id=".$_GET['id']."&time=".$time."&hash=".$hash;
// echo $link;
/*echo date('ymd')+1;
$str= date('ymd')+1;
echo "<br>";
echo strtotime($str);
$mystr=strtotime($str);
echo "<br>";
echo md5($mystr.$lang->KEY.$_GET['id']);
echo "<br>";

echo date('ymd')+1;
$str= date('ymd')+1;
echo "<br>";
echo strtotime($str);*/

ini_set("display_errors", "1");
include_once '../classes/lang.php';
if(isset($_GET['id']) && isset($_GET['time']) && isset($_GET['hash']))
{
	if(md5($_GET['time'].$lang->KEY.$_GET['id'])==$_GET['hash'])
	{
		if(strtotime(date('ymd'))>$_GET['time'])
		{
			echo "link expired";
		}
		else 
		{
			//echo "wow";
			?>
			
			<form action="../controller/mainentrance.php?action=forgetChngPwd" method="post" name="cngPWD">
			<p class="seting">Please Enter your New Password</p>
			<table>
				<tr>
					<td><input type="hidden" name="userId" id="userId" value="<?php echo $_GET['id'];?>" /></td>
				</tr>
				<tr>
					<td><lable class="seting">New Password</lable></td>
					<td><input type="password" name="newPwd" id="newPwd" /></td>
				</tr>
				<tr>
					<td><lable class="seting">Confirm Password</lable></td>
					<td><input type="password" name="confirmPwd" id="confirmPwd" /></td>
				</tr>
				<tr>
					<td><input type="submit" value="Submit"  />
						<input type="button" value="Cancel" href="#" />
						</td>
				</tr>
			</table>
		</form>
			
			
			<?php 
		}
	}
	else 
	{
		echo "Error 404" ;
	}
}



?>