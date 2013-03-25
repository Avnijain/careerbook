<?php
include_once("../classes/lang.php");
require_once '../controller/userInfo.php';
require_once '../classes/dateManipulation.php';
$objUserInfo = unserialize($_SESSION['userData']);
$UserPersonalInfoDB = $objUserInfo->getUserPersonalInfoDB();
$UserAcademicInfoDB = $objUserInfo->getUserAcademicInfoDB();
$UserAddressInfoDB = $objUserInfo->getUserAddressInfoDB();
$UserProjectInfoDB = $objUserInfo->getUserProjectInfoDB();
?>

<title><?php echo $lang->USERINFOFORM;?></title>
<link
	rel="stylesheet" type="text/css" href="../css/global.css"></link>
<link
	rel="stylesheet" type="text/css" href="../css/topheader.css"></link>


<link
	rel="stylesheet" href="../css/styleUserInfoForm.css" type="text/css"
	media="screen" />
<script
	type="text/javascript" src="../JavaScript/jquery.min.js"></script>
<script
	type="text/javascript" src="../JavaScript/sliding.form.js"></script>


</script>
<link
	rel="stylesheet" href="../css/jquery-ui.css" />
<script
	src="../JavaScript/jquery-1.9.1.min.js"></script>
<script
	src="../JavaScript/jquery-ui.js"></script>
<script>
        $(function() {					//to display calendar
	 $( "#datepicker" ).datepicker({
		 changeMonth: true,
		 changeYear: true
		 });
	 $( "#start_period" ).datepicker({
		 changeMonth: true,
		 changeYear: true
		 });
	 $( "#startPeriod" ).datepicker({
		 changeMonth: true,
		 changeYear: true
		 });
	 $( "#endPeriod" ).datepicker({
		 changeMonth: true,
		 changeYear: true
		 });
		 $( "#datedat" ).datepicker({
			 changeMonth: true,
			 changeYear: true
			 });
		 });
        function addMoreDegree()
        {
            var $text1="<p><label ><?php echo $lang->TITLE;?> </label>";
            var $text2="<input id=\"title\" name=\"title[]\" type=\"text\" AUTOCOMPLETE=OFF />";
            var $text3="<label ><?php echo $lang->DESCRIPITION;?></label>";
            var $text4="<input id=\"descripition\" name=\"project_description[]\" type=\"text\" AUTOCOMPLETE=OFF />";
            var $text5="<label ><?php echo $lang->TECHNOLOGYUSED;?></label>";
            var $text6="<input id=\"technology\" name=\"technology_used[]\" type=\"text\" AUTOCOMPLETE=OFF />";
            var $text7="<label ><?php echo $lang->DURATION;?></label>";                                                  
            var $text8="<input id=\"duration\" name=\"duration[]\" type=\"number\" AUTOCOMPLETE=OFF /></p>";                  
            $("#otherDegree").append($text1+$text2+$text3+$text4+$text5+$text6+$text7+$text8);

        }
        function addMore()
        {
            var $text1="<p><label ><?php echo $lang->CERTIFICATENAME;?> </label>";
            var $text2="<input id=\"certificatename\" name=\"certificatename\" type=\"text\" AUTOCOMPLETE=OFF />";
            var $text3="<label ><?php echo $lang->DESCRIPITION;?></label>";
            var $text4="<input id=\"certificatedescription\" name=\"certificatedescription\" type=\"text\" AUTOCOMPLETE=OFF />";
            var $text5="<label ><?php echo $lang->DATEDAT;?></label>";
            var $text6="<input id=\"datedat\" name=\"datedat\" type=\"text\" AUTOCOMPLETE=OFF />";                  
            $("#other").append($text1+$text2+$text3+$text4+$text5+$text6);

        }
        
</script>



<div id="mainWrapper">
	<div>
		<span class="reference"> </span>
	</div>
	<div id="content">

		<div id="wrapper" style="width: 780px">
			<div id="steps" width="700px">
				<form id="formElem" name="formElem"
					action="../controller/mainentrance.php?action=profileinfo"
					method="post" enctype="multipart/form-data" >
					<fieldset class="step">
						<legend>
							<?php echo $lang->ACCOUNT; ?>
						</legend>
						<p>
							<label><?php echo $lang->FIRSTNAME;?> </label> <input
								id="username" name="first_name" <?php if (!empty($UserPersonalInfoDB['first_name'])){?>value=<?php echo $UserPersonalInfoDB['first_name']; } ?> />
						</p>
						<p>
							<label><?php echo $lang->MIDDLENAME;?> </label> <input
								id="username" name="middle_name" <?php if (!empty($UserPersonalInfoDB['middle_name'])){?>value=<?php echo $UserPersonalInfoDB['middle_name']; } ?> />
						</p>
						<p>
							<label><?php echo $lang->LASTNAME;?> </label> <input
								id="username" name="last_name" <?php if (!empty($UserPersonalInfoDB['last_name'])){?>value=<?php echo $UserPersonalInfoDB['last_name']; } ?> />
						</p>
						<p>
							<label><?php echo $lang->GENDER;?> </label> <input type="radio"
								name="gender" value="male">
							<?php echo $lang->MALE;?>
							<input type="radio" name="gender" value="female">
							<?php echo $lang->FEMALE;?>
						</p>
						<p>
							<label><?php echo $lang->DOB;?> </label>
							</td> <input type="text" id="datepicker" name="date_of_birth" <?php if (!empty($UserPersonalInfoDB['date_of_birth'])){
							    //echo $UserPersonalInfoDB['date_of_birth'];
							    ?>
							    value=<?php echo $objdate->formatDate($UserPersonalInfoDB['date_of_birth'],"d/m/Y");
							     
							} ?> />							
						</p>
						<p>
							<label><?php echo $lang->EMAIL;?> </label> <input id="email"
								name="email_primary" placeholder="info@tympanus.net"
								type="email" disabled="disabled" AUTOCOMPLETE=OFF <?php if (!empty($UserPersonalInfoDB['email_primary'])){?> value=<?php echo $UserPersonalInfoDB['email_primary']; } ?> />
						</p>
						<p>
							<label><?php echo $lang->SEC_EMAIL;?> </label> <input id="email"
								name="email_secondary" placeholder="info@tympanus.net"
								type="email" <?php if (!empty($UserPersonalInfoDB['email_secondary'])){?> value= <?php echo $UserPersonalInfoDB['email_secondary']; } ?> />
						</p>
					</fieldset>
					<fieldset class="step">
						<legend>
							<?php echo $lang->PERSONALINFO; ?>
						</legend>
						<p>
							<label><?php echo $lang->ADDRESS;?> </label> <input id="adress"
							<?php if (!empty($UserAddressInfoDB['address'])){?>value=<?php echo $UserAddressInfoDB['address']; } ?>
								name="address" type="text" AUTOCOMPLETE=OFF />
						
						
						<p>
							<label for="country"><?php echo $lang->CITY;?> </label> <input
								id="city" name="city_name" type="text"
								<?php if (!empty($UserAddressInfoDB['city_name'])){?>value=<?php echo $UserAddressInfoDB['city_name']; } ?> 
								AUTOCOMPLETE=OFF />
						</p>
						<p>
							<label><?php echo $lang->STATE;?> </label> <input id="state"
							<?php if (!empty($UserAddressInfoDB['state_name'])){?>value=<?php echo $UserAddressInfoDB['state_name']; } ?>
								name="state_name" type="text" AUTOCOMPLETE=OFF />
						</p>

						<p>
							<label><?php echo $lang->IMAGE;?> </label> <input id="image"														
								name="user_image" type="file" AUTOCOMPLETE=OFF />
						</p>
					</fieldset>
					<fieldset class="step">
						<legend>
							<?php echo $lang->EDUCATION; ?>
						</legend>
						<p>
							<label><?php echo $lang->BOARD10;?> </label> <input id="board_10"
								name="board_10" type="text" AUTOCOMPLETE=OFF
								<?php if (!empty($UserAcademicInfoDB['board_10'])){?>value=<?php echo $UserAcademicInfoDB['board_10']; } ?>
								 /> <label><?php echo $lang->SCHOOL10;?>
							</label> <input id="school_10" name="school_10" type="text"
							<?php if (!empty($UserAcademicInfoDB['school_10'])){?>value=<?php echo $UserAcademicInfoDB['school_10']; } ?>
								AUTOCOMPLETE=OFF /> <label><?php echo $lang->PERCENTAGE;?> </label>
							<input id="10percentage" name="percentage_GPA_10" type="number"
							<?php if (!empty($UserAcademicInfoDB['percentage_GPA_10'])){?>value=<?php echo $UserAcademicInfoDB['percentage_GPA_10']; } ?>
								AUTOCOMPLETE=OFF />
						</p>
						<p>
							<label><?php echo $lang->BOARD12;?> </label> <input id="board_10"
							<?php if (!empty($UserAcademicInfoDB['board_12'])){?>value=<?php echo $UserAcademicInfoDB['board_12']; } ?>
								name="board_12" type="text" AUTOCOMPLETE=OFF /> <label><?php echo $lang->SCHOOL12;?>
							</label> <input id="school_10" name="school_12" type="text"
							<?php if (!empty($UserAcademicInfoDB['school_12'])){?>value=<?php echo $UserAcademicInfoDB['school_12']; } ?>
								AUTOCOMPLETE=OFF /> <label><?php echo $lang->PERCENTAGE;?> </label>
							<input id="10percentage" name="percentage_12" type="number"
							<?php if (!empty($UserAcademicInfoDB['percentage_12'])){?>value=<?php echo $UserAcademicInfoDB['percentage_12']; } ?>
								AUTOCOMPLETE=OFF />
						</p>
						<p>
							<label><?php echo $lang->DEGREE;?> </label> <input id="board_10"
							<?php if (!empty($UserAcademicInfoDB['graduation_degree'])){?>value=<?php echo $UserAcademicInfoDB['graduation_degree']; } ?>
								name="graduation_degree" type="text" AUTOCOMPLETE=OFF /> <label><?php echo $lang->SPECIALIZATION;?>
							</label> <input id="school_10" name="graduation_specialization"
							<?php if (!empty($UserAcademicInfoDB['graduation_specialization'])){?>value=<?php echo $UserAcademicInfoDB['graduation_specialization']; } ?>
								type="text" AUTOCOMPLETE=OFF /> <label><?php echo $lang->COLLEGE;?>
							</label> <input id="school_10" name="graduation_college"
							<?php if (!empty($UserAcademicInfoDB['graduation_college'])){?>value=<?php echo $UserAcademicInfoDB['graduation_college']; } ?>
								type="text" AUTOCOMPLETE=OFF /> <label><?php echo $lang->PERCENTAGE;?>
							</label> <input id="10percentage" name="graduation_percentage"
							<?php if (!empty($UserAcademicInfoDB['graduation_percentage'])){?>value=<?php echo $UserAcademicInfoDB['graduation_percentage']; } ?>
								type="number" AUTOCOMPLETE=OFF />
						</p>
						<p>
							<label><?php echo $lang->POST_DEGREE;?> </label> <input
								id="board_10" name="post_graduation_degree" type="text"
								<?php if (!empty($UserAcademicInfoDB['post_graduation_degree'])){?>value=<?php echo $UserAcademicInfoDB['post_graduation_degree']; } ?>
								AUTOCOMPLETE=OFF /> <label><?php echo $lang->SPECIALIZATION;?> </label>
							<input id="school_10" name="post_graduation_specialization"
							<?php if (!empty($UserAcademicInfoDB['post_graduation_specialization'])){?>value=<?php echo $UserAcademicInfoDB['post_graduation_specialization']; } ?>
								type="text" AUTOCOMPLETE=OFF /> <label><?php echo $lang->COLLEGE;?>
							</label> <input id="school_10" name="post_graduation_college"
							<?php if (!empty($UserAcademicInfoDB['post_graduation_college'])){?>value=<?php echo $UserAcademicInfoDB['post_graduation_college']; } ?>
								type="text" AUTOCOMPLETE=OFF /> <label><?php echo $lang->PERCENTAGE;?>
							</label> <input id="10percentage"
							<?php if (!empty($UserAcademicInfoDB['post_graduation_percentage'])){?>value=<?php echo $UserAcademicInfoDB['post_graduation_percentage']; } ?>
								name="post_graduation_percentage" type="number" AUTOCOMPLETE=OFF />
						</p>
					</fieldset>
					<fieldset class="step" id="otherDegree">
						<legend>
							<?php echo $lang->PROJECT; ?>
						</legend>
						<?php 
						foreach($UserProjectInfoDB as $key => $value){						
						?>
						<p>
							<label><?php echo $lang->TITLE;?> </label> <input id="title"
							<?php if (!empty($value['title'])){?>value=<?php echo $value['title']; } ?>
								name="title[]" type="text" AUTOCOMPLETE=OFF /> <label><?php echo $lang->DESCRIPITION;?>
							</label> <input id="descripition" name="project_description[]" type="text"
							<?php if (!empty($value['project_description'])){?>value=<?php echo $value['project_description']; } ?>
								AUTOCOMPLETE=OFF /> <label><?php echo $lang->TECHNOLOGYUSED;?> </label>
							<input id="technology" name="technology_used[]" type="text" AUTOCOMPLETE=OFF
							<?php if (!empty($value['technology_used'])){?>value=<?php echo $value['technology_used']; } ?>
							 />
							<label><?php echo $lang->DURATION;?> </label> <input
								id="duration" name="duration[]" type="number"
								<?php if (!empty($value['duration'])){?>value=<?php echo $value['duration']; } ?>
								AUTOCOMPLETE=OFF />
						</p>
						<?php
						}
						?>
						<p>
							<input type="button" value="<?php echo $lang->ADDMORE;?>"
								onclick="addMoreDegree();">
						</p>
					</fieldset>
					<fieldset class="step" id="otherDegree">
						<legend>
							<?php echo $lang->JOB; ?>
						</legend>
						<p>
							<label><?php echo $lang->SKILLSET;?> </label> <input
								id="skill_id" name="skill_set" type="text" AUTOCOMPLETE=OFF /> <label><?php echo $lang->CURRENTPOSITION;?>
							</label> <input id="current_position" name="current_position"
								type="text" AUTOCOMPLETE=OFF /> <label><?php echo $lang->CURRENTCOMPANY;?>
							</label> <input id="current_company" name="current_company"
								type="text" AUTOCOMPLETE=OFF /> <label><?php echo $lang->STARTPERIOD;?>
							</label> <input id="start_period" name="start_period" type="text"
								AUTOCOMPLETE=OFF />
						</p>
					</fieldset>
					<fieldset class="step" id="otherDegree">
						<legend>
							<?php echo $lang->PREVJOB; ?>
						</legend>
						<p>
							<label><?php echo $lang->POSITION;?> </label> <input
								id="board_10" name="degree" type="text" AUTOCOMPLETE=OFF /> <label><?php echo $lang->COMPANY;?>
							</label> <input id="school_10" name="specialization" type="text"
								AUTOCOMPLETE=OFF /> <label><?php echo $lang->STARTPERIOD;?> </label>
							<input id="startPeriod" name="college" type="text" AUTOCOMPLETE=OFF />
							<label><?php echo $lang->ENDPERIOD;?> </label> <input
								id="endPeriod" name="percentage" type="number"
								AUTOCOMPLETE=OFF />
						</p>

					</fieldset>
					<fieldset class="step" id="other">
						<legend>
							<?php echo $lang->OTHER; ?>
						</legend>
						<p>
							<label><?php echo $lang->CERTIFICATENAME;?> </label> <input
								id="certificatename" name="certificatename" type="text" AUTOCOMPLETE=OFF /> <label><?php echo $lang->DESCRIPITION;?>
							</label> <input id="certificatedescription" name="certificatedescription" type="text"
								AUTOCOMPLETE=OFF /> <label><?php echo $lang->DATEDAT;?> </label>
							<input id="datedat" name="datedat" type="text" AUTOCOMPLETE=OFF />
							</p>
						<p>
							<label><?php echo $lang->EXTRACIRCULAR;?> </label> <input
								id="extracircular" name="extracircular" type="number"
								AUTOCOMPLETE=OFF />
						</p>
							<p>
							<input type="button" value="<?php echo $lang->ADDMORE;?>"
								onclick="addMore();">
						</p>


					</fieldset>
					<fieldset class="step">
						<legend>
							<?php echo $lang->CONFIRM; ?>
						</legend>
						<p>
							<?php echo $lang->CONFIRMMSG; ?>

						</p>
						<p class="submit">
							<button id="registerButton" type="submit">Register</button>
						</p>
					</fieldset>
				</form>
			</div>
			<div id="navigation" style="display: none;">
				<ul>
					<li class="selected"><a href="#"><?php echo $lang->ACCOUNT; ?> </a>
					</li>
					<li><a href="#"><?php echo $lang->PERSONALINFO; ?> </a>
					</li>
					<li><a href="#"><?php echo $lang->EDUCATION; ?> </a>
					</li>
					<li><a href="#"><?php echo $lang->PROJECT; ?> </a>
					</li>
					<li><a href="#"><?php echo $lang->JOB; ?> </a>
					</li>
					<li><a href="#"><?php echo $lang->PREVJOB; ?> </a>
					</li>
					<li><a href="#"><?php echo $lang->OTHER; ?> </a>
					</li>
					<li><a href="#"><?php echo $lang->CONFIRM; ?> </a>
					</li>
				</ul>
			</div>
		</div>
	</div>

</div>
