<?php
include_once("../classes/lang.php");
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title><?php echo $lang->USERINFOFORM;?></title>
        <link rel="stylesheet" type="text/css" href="../css/global.css" ></link>
        <link rel="stylesheet" type="text/css" href="../css/topheader.css" ></link>
        
        
        <link rel="stylesheet" href="../css/styleUserInfoForm.css" type="text/css" media="screen"/>
	<script type="text/javascript" src="../JavaScript/jquery.min.js"></script>
        <script type="text/javascript" src="../JavaScript/sliding.form.js"></script>
        
        
        </script>
            <link rel="stylesheet" href="../css/jquery-ui.css" />
            <script src="../JavaScript/jquery-1.9.1.min.js"></script>
            <script src="../JavaScript/jquery-ui.js"></script>
        <script>
        $(function() {					//to display calendar
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
       

    </style>
     <body>
     <div id="mainWrapper">
<div id="headerWrapper">
<div id="top">
		<div class="cl">&nbsp;</div>
		<h1 id="logo"><a href="#">CareerBook</a></h1>
		<form action="" method="post" id="search">
			<div class="field-holder">
				<input type="text" class="field" value="Search" title="Search">
			</div>
			<input type="submit" class="button" value="Search">
			<div class="cl">&nbsp;</div>
		</form>
</div>
<nav class="top-nav">
			<div class="shell">
			<a href="#" class="nav-btn">HOMEPAGE<span></span></a>			
				<span class="top-nav-shadow"></span>
				<ul>
					<li class="active first"><span><a href="#">home</a></span></li>
					<li><span><a href="#">group</a></span></li>
					<li><span><a href="#">users</a></span></li>
					<li><span><a href="#">messages</a></span></li>
					<li><span><a href="#">help</a></span></li>					
					<li class="last"><span><a href="#">profile</a></span></li>
				</ul>
			</div>
</nav>
</div>     
        <div>
            <span class="reference">
                
            </span>
        </div>
        <div id="content">
            
            <div id="wrapper" style="width: 780px">
                <div id="steps" width="700px">
                    <form id="formElem" name="formElem" action="../controller/mainentrance.php?action=profileinfo" method="post" ">
                        <fieldset class="step">
                            <legend><?php echo $lang->ACCOUNT; ?></legend>
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
                            <legend><?php echo $lang->PERSONALINFO; ?></legend>
                            <p>
                                <label ><?php echo $lang->ADDRESS;?></label>
                                <input id="adress" name="address" type="text" AUTOCOMPLETE=OFF />
                            <p>
                                <label for="country"><?php echo $lang->CITY;?></label>
                                <input id="city" name="city_id" type="text" AUTOCOMPLETE=OFF />
                            </p>
                             <p>
                                <label ><?php echo $lang->STATE;?></label>
                                <input id="state" name="state_id" type="text" AUTOCOMPLETE=OFF />
                            </p>

                            <p>
                                <label ><?php echo $lang->IMAGE;?></label>
                                <input id="image" name="image" type="file" AUTOCOMPLETE=OFF />
                             </p>
                        </fieldset>
                        <fieldset class="step">
                            <legend><?php echo $lang->EDUCATION; ?></legend>
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
                            <legend><?php echo $lang->SETTINGS; ?></legend>
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
                            <legend><?php echo $lang->JOB; ?></legend>
                            <p>
				<label ><?php echo $lang->SKILLSET;?></label>
                                <input id="skill_id" name="skill_set" type="text" AUTOCOMPLETE=OFF />
				<label ><?php echo $lang->CURRENTPOSITION;?></label>
                                <input id="current_position" name="current_position" type="text" AUTOCOMPLETE=OFF />
				<label ><?php echo $lang->CURRENTCOMPANY;?></label>
                                <input id="current_company" name="current_company" type="text" AUTOCOMPLETE=OFF />
				<label ><?php echo $lang->STARTPERIOD;?></label>
                                <input id="start_period" name="start_period" type="text" AUTOCOMPLETE=OFF />
                            </p>
                        </fieldset>
                        <fieldset class="step" id="otherDegree">
                            <legend><?php echo $lang->PREVJOB; ?></legend>
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
                            <legend><?php echo $lang->CONFIRM; ?></legend>
							<p>
							 <?php echo $lang->CONFIRMMSG; ?>
								
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
                            <a href="#"><?php echo $lang->ACCOUNT; ?></a>
                        </li>
                        <li>
                            <a href="#"><?php echo $lang->PERSONALINFO; ?></a>
                        </li>
                        <li>
                            <a href="#"><?php echo $lang->EDUCATION; ?></a>
                        </li>
                        <li>
                            <a href="#"><?php echo $lang->SETTINGS; ?></a>
                        </li>
                       <li>
                            <a href="#"><?php echo $lang->JOB; ?></a>
                        </li>
                         <li>
                            <a href="#"><?php echo $lang->PREVJOB; ?></a>
                        </li>
			<li>
                            <a href="#"><?php echo $lang->CONFIRM; ?></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
		
</div>
    </body>
</html>

