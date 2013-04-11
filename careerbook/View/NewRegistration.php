<?php
include_once ("../classes/lang.php");
?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $lang->USERREGISTRATIONFORM?></title>
<link rel="stylesheet" href="../css/NewRegistration.css" type="text/css"
	media="screen" />
<script type="text/javascript" src="../JavaScript/jquery.min.js"></script>
<script type="text/javascript" src="../JavaScript/sliding.form.js"></script>
<link rel="stylesheet" href="../css/jquery-ui.css" />
<script src="../JavaScript/jquery-1.9.1.min.js"></script>
<script src="../JavaScript/jquery-ui.js"></script>
<script src="../JavaScript/jquery.validate.min.js"></script>
<script src="../JavaScript/login-form.js"></script>
<script>
     $(function() {
	 $( "#datepicker" ).datepicker({
		 changeMonth: true,
		 dateFormat: 'yy/mm/dd',
		 changeYear: true
		 });
	});

</script>
</head>
<style>
span.reference {
	position: fixed;
	left: 5px;
	top: 5px;
	font-size: 10px;
	text-shadow: 1px 1px 1px #fff;
}

span.reference a {
	color: #555;
	text-decoration: none;
	text-transform: uppercase;
}

span.reference a:hover {
	color: #000;
}

h3 {
	color: #444;
}
</style>
<body>
                         
<?php
if (isset ( $_GET ['err'] )) {
    $value=substr($_GET['err'],1);
    $key=substr($_GET['err'],0,1);
    echo "<h3>$lang->REGISTRATIONERROR" . $key . "[" . $lang->getRegError ( $key ) . "] in ".$value."</h3>";
}
?> 
<div>
<span class="reference"> </span>
	</div>
	<div id="content">
    <div id="error_div1"></div>
		<div id="wrapper">
			<div id="steps">
				<form id="formElem" name="formElem" 
					action="../controller/mainentrance.php?action=Registration"
					method="post">
					<fieldset class="step">
						<legend><?php echo $lang->ACCOUNT?></legend>
						<p>
							<label><?php echo $lang->EMAIL;?></label> <input id="email"
								name="email_primary" placeholder="info@tympanus.net"
								type="email" size="25"  class="required email"
								value="<?php if (isset($_SESSION['registration'])) echo htmlentities($_SESSION['registration']['email_primary']);?>"
								AUTOCOMPLETE=OFF />					
						</p>
					</fieldset>
					<fieldset class="step">
						<legend><?php echo $lang->PERSONALDETAILS?></legend>
						<p>
						<label><?php echo $lang->FIRSTNAME;?></label> <input
								id="first_name" name="first_name"
								value="<?php if (isset($_SESSION['registration'])) echo htmlentities($_SESSION['registration']['first_name']);?>" />
						</p>
						<p>
							<label><?php echo $lang->MIDDLENAME;?></label> <input
								id="middle_name" name="middle_name"
								value="<?php if (isset($_SESSION['registration'])) echo htmlentities($_SESSION['registration']['middle_name']);?>" />
						</p>
						<p>
							<label><?php echo $lang->LASTNAME;?></label> <input
								id="last_name" name="last_name"
								value="<?php if (isset($_SESSION['registration'])) echo htmlentities($_SESSION['registration']['last_name']);?>" />
						</p>
						<p>
							<label><?php echo $lang->GENDER;?></label> <input type="radio"
								name="gender" checked="checked" value="male"><?php echo $lang->MALE;?> 
                                <input type="radio" name="gender"
								value="female"><?php echo $lang->FEMALE;?>
                            </p>
						<p>
							<label><?php echo $lang->DOB;?></label>
							<input type="text" id="date_of_birth" name="date_of_birth" value="<?php if (isset($_SESSION['registration'])) echo htmlentities($_SESSION['registration']['date_of_birth']);?>" readonly="readonly" />
						</p>
						<p>
							<label><?php echo $lang->PHONENUMBER;?></label> <input
								id="phone_no" name="phone_no"
								value="<?php if (isset($_SESSION['registration'])) echo htmlentities($_SESSION['registration']['phone_no']);?>" />
						</p>
					</fieldset>
					<fieldset class="step">
						<legend><?php echo $lang->CONFIRM?></legend>
                            
                            <?php include_once 'captcha.php'; ?>
                                                      
                            
							<p>
								<?php echo $lang->NEWREGISTRATIONMSG?>
								
							</p>

						<p class="submit">
							<button id="registerButton" type="submit"><?php echo $lang->REGISTAR?></button>
						</p>
					</fieldset>
				</form>
			</div>
			<div id="navigation" style="display: none;">
				<ul>
					<li class="selected"><a href="#"><?php echo $lang->ACCOUNT?></a></li>
					<li><a href="#"><?php echo $lang->PERSONALDETAILS?></a></li>

					<li><a href="#"><?php echo $lang->CONFIRM?></a></li>
					<?php unset($_SESSION['registration']);?>
				</ul>
			</div>
		</div>
	</div>
</body>
</html>
