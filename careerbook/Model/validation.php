<?php
 
class validation
{
	public function validate($a)
	{  echo "validation fun";
		foreach ($a as $key=>$value) {

			if(($key=="email_primary")||($key=="email_secondary"))
			{

				if(!filter_var($value, FILTER_SANITIZE_EMAIL))
				{
					if($_REQUEST['action']=="registration")
					{
					header("location:../views/UserInfoForm.php?err=3");
					exit;
					}
					else
					{
						header("location:../views/NewRegistration.php?err=3");
						exit;
					}
				}
			}
			else if(($key=="percentage_GPA_10")||($key=="percentage_12")||($key=="graduation_percentage")||($key=="post_graduation_percentage")||($key=="percentage"))
			{
				if(!(var_dump(filter_var($value, FILTER_VALIDATE_FLOAT))))
				{
					if($_REQUEST['action']=="registration")
						{
						header("location:../views/UserInfoForm.php?err=3");
						exit;
						}
						else
						{
							header("location:../views/NewRegistration.php?err=3");
							exit;
						}
				}
			}
			else if(($key=="date_of_birth")||($key=="startperiod"))
			{
				if(!(preg_match("/[0-9]{2}\/[0-9]{2}\/[0-9]{4}/", $value)))
				{
					if($_REQUEST['action']=="registration")
						{
						header("location:../views/UserInfoForm.php?err=3");
						exit;
						}
						else
						{
							header("location:../views/NewRegistration.php?err=3");
							exit;
						}
				}
			}
			else if(($key=="image"))
			{
				$allowedExts = array("jpg", "jpeg", "gif", "png");
				$extension = end(explode(".", $_FILES["file"]["name"]));
				if ((($_FILES["file"]["type"] == "image/gif")
						|| ($_FILES["file"]["type"] == "image/jpeg")
						|| ($_FILES["file"]["type"] == "image/png")
						|| ($_FILES["file"]["type"] == "image/pjpeg"))
						&& ($_FILES["file"]["size"] < 800)
						&& in_array($extension, $allowedExts))
				{
					if ($_FILES["file"]["error"] > 0)
					{
						echo "Error: " . $_FILES["file"]["error"] . "<br>";
					}
					
				}
				else
				{
					header("location:../views/UserInfoForm.php?err=image");
					exit;
				}
			}
			else 
			{
				if(!filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS,FILTER_SANITIZE_MAGIC_QUOTES) && !isset($value))
				{

				if($_REQUEST['action']=="registration")
					{
					header("location:../views/UserInfoForm.php?err=3");
					exit;
					}
					else
					{
						header("location:../views/NewRegistration.php?err=3");
						exit;
					}
				}
			}
		}
	}
	
}

//$validdob= new validation();




?>