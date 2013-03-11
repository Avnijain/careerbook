<?php

include_once("../classes/lang.php");

?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>User Registration Form</title>



        
        <link rel="stylesheet" href="../css/NewRegistration.css" type="text/css" media="screen"/>
	<script type="text/javascript" src="../JavaScript/jquery.min.js"></script>
        <script type="text/javascript" src="../JavaScript/sliding.form.js"></script>
        
        

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

        
    </head>
     <body>
        <div>
            <span class="reference">
                
            </span>
        </div>
        <div id="content">
            
            <div id="wrapper">
                <div id="steps">
                    
                    
                    <?php //include_once("./regForm.html")?>
                    <form id="formElem" name="formElem" action="../controller/mainentrance.php?action=Registration" method="post">
                        <fieldset class="step">
                            <legend>Account</legend>
                            
                            <p>
                                <label ><?php echo $lang->EMAIL;?></label>
                                <input id="email" name="email_primary" placeholder="info@tympanus.net" type="email" AUTOCOMPLETE=OFF />
                            </p>

                        </fieldset>
                        <fieldset class="step">
                            <legend>Personal Details</legend>
                            <p>
                                <label ><?php echo $lang->FIRSTNAME;?></label>
                                <input id="username" name="first_name" />
                            </p>
                             <p>
                                <label ><?php echo $lang->MIDDLENAME;?></label>
                                <input id="username" name="middle_name" />
                            </p>
                            <p>
                                <label><?php echo $lang->LASTNAME;?></label>
                                <input id="username" name="last_name" />
                            </p>
                             <p>
                                <label ><?php echo $lang->GENDER;?></label>
                                <input type="radio" name="gender" checked="checked" value="male"><?php echo $lang->MALE;?> 
                                <input type="radio" name="gender" value="female"><?php echo $lang->FEMALE;?>
                            </p>
                             <p>
                                <label><?php echo $lang->DOB;?></label></td>
                                <input type="text" id="datepicker" name="date_of_birth"/>
                            </p>
                            <p>
                                <label><?php echo $lang->PHONENUMBER;?></label>
                                <input id="username" name="phone_no" />
                            </p>
                            </fieldset>

			<fieldset class="step">
                            <legend>Confirm</legend>
                            
                            <?php include_once 'captcha.php'; ?>
                                                      
                            
							<p>
								Everything in the form was correctly filled 
								if all the steps have a green checkmark icon.
								A red checkmark icon indicates that some field 
								is missing or filled out with invalid data. In this
								last step the user can confirm the submission of
								the form.
							</p>
                            
                            <p class="submit">
                                <button id="registerButton" type="submit">Register</button>
                            </p>
                            
                        </fieldset>
                    </form>
                    
                    
                    
                    
                </div>
                <div id="navigation" style="display:none;">
                    <ul>
                        <li class="selected">
                            <a href="#">Account</a>
                        </li>
                        <li>
                            <a href="#">Personal Details</a>
                        </li>

			<li>
                            <a href="#">Confirm</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
		

    </body>
</html>
