<?php 
include_once("../lang/lang.php");
?>
<html>
<head>
<script type="text/javascript">
$(document).ready(function(){
	$("#myform").validator();
});
</script>
<link rel="stylesheet" href="../css/jquery-ui.css" />
<script src="../JavaScript/jquery-1.9.1.min.js"></script>
<script src="../JavaScript/jquery-ui.js"></script>

<script>
$(function() {
	 $( "#datepicker" ).datepicker({
		 changeMonth: true,
		 changeYear: true
		 });
		 });
</script>

<style>
form {
	background-color: white; 
}
body {
background-color: #add8e6; 
}

</style>
</head>
<body>
<form id="myform" action="../controller/controller.php?action=Registration" method="post">
  <fieldset>
    <h3><?php echo REGISTARTION;?></h3>
	<table>
    <tr>
      <td><label><?php echo FIRSTNAME;?></label></td>
      <td><input type="text" name="firstname" pattern="[a-zA-Z ]{3,}" maxlength="30" required="required" /></td>
    </tr>
	<tr>
      <td><label><?php echo MIDDLENAME;?></label></td>
      <td><input type="text" name="middlename" pattern="[a-zA-Z ]{1,}" maxlength="30" /></td>
    </tr>
    <tr>
      <td><label><?php echo LASTNAME;?></label></td>
      <td><input type="text" name="lastname" pattern="[a-zA-Z ]{3,}" maxlength="30" required="required" /></td>
    </tr>

    <tr>
      <td><label><?php echo DOB;?></label></td>
      <td><input type="text" id="datepicker" name="date_of_birth"/></td>
    </tr>
	<tr>
	<td><label><?php echo GENDER;?></label></td>
	<td><input type="radio" name="gender" value="male"><?php echo MALE;?> 
	<input type="radio" name="gender" value="female"><?php echo FEMALE;?></td>
	</tr>
	<tr>
      <td><label><?php echo EMAIL;?></label></td>
      <td><input type="email" name="email" required="required" /></td>
    </tr>
	<tr>
      <td><label><?php echo PHONENUMBER;?></label></td>
      <td><input type="number" name="phonenumber" size="10" /></td>
    </tr>
	</table>
    <p id="terms">
      <label><?php echo ACCEPTTERMS;?></label>
      <input type="checkbox" required="required" />
    </p>
    <?php
    if(isset($_GET['err']))
    if($_GET['err']=="1")
    {
      echo "ERRORMSG1</br>";
    
    }
    ?>
	<a href="#"></a>
    <button type="submit"><?php echo SUBMIT;?></button>
    <button type="reset"><?php echo RESET;?></button>
  </fieldset>
</form>
</body>