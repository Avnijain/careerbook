<?php
 
class validation
{
	public function validate($a)
	{
		foreach ($a as $key=>$value) {

			if(($key=="email_primary")||($key=="email_secondary"))
			{

				if(!filter_var($value, FILTER_SANITIZE_EMAIL))
				{

					header("location:../views/NewRegistration.php?err=3");
					exit;
				}
			}
			else if(($key=="percentage_GPA_10")||($key=="percentage_12")||($key=="graduation_percentage")||($key=="post_graduation_percentage")||($key=="percentage"))
			{
				if(!(var_dump(filter_var($value, FILTER_VALIDATE_FLOAT))))
				{
					header("location:../views/NewRegistration.php?err=2");
					exit;
				}
			}
			else if(($key=="date_of_birth")||($key=="startperiod"))
			{
				if(!(preg_match("/[0-9]{2}\/[0-9]{2}\/[0-9]{4}/", $value)))
				{
					header("location:../views/NewRegistration.php?err=4");
					exit;
				}
			}
			else 
			{
				if(!filter_var($value, FILTER_SANITIZE_FULL_SPECIAL_CHARS,FILTER_SANITIZE_MAGIC_QUOTES) && !isset($value))
				{

					header("location:../views/NewRegistration.php?err=1");
					exit;
				}
			}
		}
	}
	
}

//$validdob= new validation();




?>