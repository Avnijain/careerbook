<?php
include_once("../lang/lang.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>User Information Form</title>

        <link rel="stylesheet" href="../css/styleUserInfoForm.css" type="text/css" media="screen"/>
	<script type="text/javascript" src="../JavaScript/jquery.min.js"></script>
        <script type="text/javascript" src="../JavaScript/sliding.form.js"></script>
        
        
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
        function addMoreDegree()
        {
            var $text1="<p><label ><?php echo $lang->DEGREE;?></label>";
            var $text2="<input id=\"board_10\" name=\"degree\" type=\"text\" AUTOCOMPLETE=OFF />";
            var $text3="<label ><?php echo $lang->SPECIALIZATION;?></label>";
            var $text4="<input id=\"school_10\" name=\"specialization\" type=\"text\" AUTOCOMPLETE=OFF />";
            var $text5="<label ><?php echo $lang->COLLEGE;?></label>";
            var $text6="<input id=\"school_10\" name=\"college\" type=\"text\" AUTOCOMPLETE=OFF />";
            var $text7="<label ><?php echo $lang->PERCENTAGE;?></label>";                                                  
            var $text8="<input id=\"10percentage\" name=\"percentage\" type=\"number\" AUTOCOMPLETE=OFF /></p>";                  
            $("#otherDegree").append($text1+$text2+$text3+$text4+$text5+$text6+$text7+$text8);

        }
</script>
        
    </head>
    <style>
        span.reference{
            position:fixed;
            left:5px;
            top:5px;
            font-size:10px;
            text-shadow:1px 1px 1px #fff;
        }
        span.reference a{
            color:#555;
            text-decoration:none;
			text-transform:uppercase;
        }
        span.reference a:hover{
            color:#000;
            
        }

    </style>
     <body>
        <div>
            <span class="reference">
                
            </span>
        </div>
        <div id="content">
            
            <div id="wrapper">
                <div id="steps">
                    <form id="formElem" name="formElem" action="../controller/controller.php?action=login" method="get">
                        <fieldset class="step">
                            <legend>Account</legend>
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
                                <input type="radio" name="gender" value="male"><?php echo $lang->MALE;?> 
                                <input type="radio" name="gender" value="female"><?php echo $lang->FEMALE;?>
                            </p>
                             <p>
                                <label><?php echo $lang->DOB;?></label></td>
                                <input type="text" id="datepicker" name="date_of_birth"/>
                            </p>
                            <p>
                                <label ><?php echo $lang->EMAIL;?></label>
                                <input id="email" name="email_primary" placeholder="info@tympanus.net" type="email" AUTOCOMPLETE=OFF />
                            </p>
                            <p>
                                <label ><?php echo $lang->SEC_EMAIL;?></label>
                                <input id="email" name="email_secondary" placeholder="info@tympanus.net" type="email"  />
                            </p>
                        </fieldset>
                        <fieldset class="step">
                            <legend>Personal Details</legend>
                            <p>
                                <label ><?php echo $lang->ADDRESS;?></label>
                                <input id="adress" name="adress" type="text" AUTOCOMPLETE=OFF />
                            </p>
                            <p>
                                <label for="country"><?php echo $lang->CITY;?></label>
                                <input id="city" name="city_name" type="text" AUTOCOMPLETE=OFF />
                            </p>
                             <p>
                                <label ><?php echo $lang->STATE;?></label>
                                <input id="state" name="state_name" type="text" AUTOCOMPLETE=OFF />
                            </p>

                            <p>
                                <label ><?php echo $lang->IMAGE;?></label>

                            </p>
                        </fieldset>
                        <fieldset class="step">
                            <legend>Payment</legend>
                            <p>
                                <label ><?php echo $lang->BOARD10;?></label>
                                <input id="board_10" name="board_10" type="text" AUTOCOMPLETE=OFF />
                                <label ><?php echo $lang->SCHOOL10;?></label>
                                <input id="school_10" name="school_10" type="text" AUTOCOMPLETE=OFF />
                                <label ><?php echo $lang->PERCENTAGE;?></label>
                                <input id="10percentage" name="percentage_GPA_10" type="number" AUTOCOMPLETE=OFF />
                            </p>
                            <p>
                                <label ><?php echo $lang->BOARD12;?></label>
                                <input id="board_10" name="board_12" type="text" AUTOCOMPLETE=OFF />
                                <label ><?php echo $lang->SCHOOL12;?></label>
                                <input id="school_10" name="school_12" type="text" AUTOCOMPLETE=OFF />
                                <label ><?php echo $lang->PERCENTAGE;?></label>
                                <input id="10percentage" name="percentage_12" type="number" AUTOCOMPLETE=OFF />
                            </p>
                            <p>
                                <label ><?php echo $lang->DEGREE;?></label>
                                <input id="board_10" name="graduation_degree" type="text" AUTOCOMPLETE=OFF />
                                <label ><?php echo $lang->SPECIALIZATION;?></label>
                                <input id="school_10" name="graduation_specialization" type="text" AUTOCOMPLETE=OFF />
                                <label ><?php echo $lang->COLLEGE;?></label>
                                <input id="school_10" name="graduation_college" type="text" AUTOCOMPLETE=OFF />                                
                                <label ><?php echo $lang->PERCENTAGE;?></label>
                                <input id="10percentage" name="graduation_percentage" type="number" AUTOCOMPLETE=OFF />
                            </p>
                            <p>
                                <label ><?php echo $lang->POST_DEGREE;?></label>
                                <input id="board_10" name="post_graduation_degree" type="text" AUTOCOMPLETE=OFF />
                                <label ><?php echo $lang->SPECIALIZATION;?></label>
                                <input id="school_10" name="post_graduation_specialization" type="text" AUTOCOMPLETE=OFF />
                                <label ><?php echo $lang->COLLEGE;?></label>
                                <input id="school_10" name="post_graduation_college" type="text" AUTOCOMPLETE=OFF />                                
                                <label ><?php echo $lang->PERCENTAGE;?></label>
                                <input id="10percentage" name="post_graduation_percentage" type="number" AUTOCOMPLETE=OFF />
                            </p>
                        </fieldset>
                        <fieldset class="step" id="otherDegree">
                            <legend>Settings</legend>
                            <p>
                                <label ><?php echo $lang->DEGREE;?></label>
                                <input id="board_10" name="degree" type="text" AUTOCOMPLETE=OFF />
                                <label ><?php echo $lang->SPECIALIZATION;?></label>
                                <input id="school_10" name="specialization" type="text" AUTOCOMPLETE=OFF />
                                <label ><?php echo $lang->COLLEGE;?></label>
                                <input id="school_10" name="college" type="text" AUTOCOMPLETE=OFF />                                
                                <label ><?php echo $lang->PERCENTAGE;?></label>
                                <input id="10percentage" name="percentage" type="number" AUTOCOMPLETE=OFF />
                            </p>
                            <p>
                                <input type="button" value="<?php echo $lang->ADDMORE;?>" onclick="addMoreDegree();">
                            </p>
                        </fieldset>
                        <fieldset class="step" id="otherDegree">
                            <legend>Job</legend>
                            <p>
				<label ><?php echo $lang->SKILLSET;?></label>
                                <input id="skill_id" name="skill" type="text" AUTOCOMPLETE=OFF />
				<label ><?php echo $lang->CURRENTPOSITION;?></label>
                                <input id="current_position" name="currentposition" type="text" AUTOCOMPLETE=OFF />
				<label ><?php echo $lang->CURRENTCOMPANY;?></label>
                                <input id="current_company" name="currentcompany" type="text" AUTOCOMPLETE=OFF />
				<label ><?php echo $lang->STARTPERIOD;?></label>
                                <input id="start_period" name="startperiod" type="text" AUTOCOMPLETE=OFF />
                            </p>
                        </fieldset>
                        <fieldset class="step" id="otherDegree">
                            <legend>Previous Job Experience</legend>
                            <p>
                                <label ><?php echo $lang->POSITION;?></label>
                                <input id="board_10" name="degree" type="text" AUTOCOMPLETE=OFF />
                                <label ><?php echo $lang->COMPANY;?></label>
                                <input id="school_10" name="specialization" type="text" AUTOCOMPLETE=OFF />
                                <label ><?php echo $lang->STARTPERIOD;?></label>
                                <input id="school_10" name="college" type="text" AUTOCOMPLETE=OFF />                                
                                <label ><?php echo $lang->ENDPERIOD;?></label>
                                <input id="10percentage" name="percentage" type="number" AUTOCOMPLETE=OFF />
                            </p>
                           
                        </fieldset>
			<fieldset class="step">
                            <legend>Confirm</legend>
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
                            <a href="#">Payment</a>
                        </li>
                        <li>
                            <a href="#">Settings</a>
                        </li>
                       <li>
                            <a href="#">Job</a>
                        </li>
                         <li>
                            <a href="#">JobOther</a>
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
