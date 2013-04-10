<?php
    //include_once("../classes/lang.php");
    //require_once '../controller/userInfo.php';
    require_once '../classes/dateManipulation.php';
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
?>
<link rel="stylesheet" href="../css/styleUserInfoForm.css"
	type="text/css" media="screen" />


<link rel="stylesheet" href="../css/styleUserInfoForm.css"
	type="text/css" media="screen" />

<script type="text/javascript" src="../JavaScript/sliding.form.js"></script>


<link rel="stylesheet" href="../css/jquery-ui.css" />

<script src="../JavaScript/jquery-ui.js"></script>
<script>
 $(function() {					//to display calendar

	 $( "#start_periodPREVJOB" ).datepicker({
	  	   changeYear: true,
	  	   changeMonth: true,
	  	   dateFormat: 'yy-mm-dd',
	  	   minDate: new Date('1975/01/01'),
	  	   maxDate: '-1d'
		 });
	 $( "#end_periodPREVJOB" ).datepicker({
	  	   changeYear: true,
	  	   changeMonth: true,
	  	   dateFormat: 'yy-mm-dd',
	  	   minDate: new Date('1975/01/01'),
	  	   maxDate: '-1d'
		});
	 <?php foreach($UserCertificateInfoDB as $key => $value){ ?>
         $("#<?php if(!empty($value['id']))
         { echo $value['id']; }else{echo 0;} ?>").datepicker({
         changeYear: true,
    	   changeMonth: true,
    	   dateFormat: 'yy-mm-dd',
    	   minDate: new Date('1975/01/01'),
    	   maxDate: '-1d'
  		});

     <?php }?>
     $("#dateOfBirth").datepicker({
  	   changeYear: true,
  	   changeMonth: true,
  	   dateFormat: 'yy-mm-dd',
  	   minDate: new Date('1975/01/01'),
  	   maxDate: '-1d'
  	});     
	 $( "#start_period" ).datepicker({
	  	   changeYear: true,
	  	   changeMonth: true,
	  	   dateFormat: 'yy-mm-dd',
	  	   minDate: new Date('1975/01/01'),
	  	   maxDate: '-1d'
		 });
	$(".selectProject").click(function(){
     	id = $(this).attr('id');
         //alert("hieee" + $(this).attr('name') );
        $.post("../controller/mainentrance.php",{"action":"deleteMessage","projectID":id},function(data,status){                
            location.reload();
     	});
	});
	$(".selectCertificate").click(function(){
     	id = $(this).attr('id');
         //alert("hieee" + $(this).attr('name') );
        $.post("../controller/mainentrance.php",{"action":"deleteCertificate","certificateID":id},function(data,status){                
            location.reload();
     	});
	});
	$(".selectExtracurricular").click(function(){
     	id = $(this).attr('id');
         //alert("hieee" + $(this).attr('name') );
        $.post("../controller/mainentrance.php",{"action":"deleteExtraCurricular","ExtraCurricularID":id},function(data,status){                
            location.reload();
     	});
	});
    function split( val ) {
        return val.split( /,\s*/ );
      }
      function extractLast( term ) {
        return split( term ).pop();
      }
      $( "#language" )
        // don't navigate away from the field on tab when selecting an item
        .bind( "keydown", function( event ) {
          if ( event.keyCode === $.ui.keyCode.TAB &&
              $( this ).data( "ui-autocomplete" ).menu.active ) {
            event.preventDefault();
          }
        })
        .autocomplete({
          source: function( request, response ) {
        	 var temp = new Array();
            $.getJSON( "../Model/fetchLanguage.php", {
              term: extractLast( request.term )
            }, function( data, status, xhr ) {
                $.each(data, function(i, field){
                    temp[i] = field['name']; 
                  });
                response( temp );
            });
          },
          search: function() {
            // custom minLength
            var term = extractLast( this.value );
            if ( term.length < 1 ) {
              return false;
            }
          },
          focus: function() {
            // prevent value inserted on focus
            return false;
          },
          select: function( event, ui ) {
            var terms = split( this.value );
            // remove the current input
            terms.pop();
            // add the selected item
            terms.push( ui.item.value );
            // add placeholder to get the comma-and-space at the end
            terms.push( "" );
            this.value = terms.join( ", " );
            return false;
          }
        });
	 $( "#country" ).ready(function(){
		 var countrySelected = '';
		 if($("#countrySelected").val()){
			 var countrySelected = $("#countrySelected").val();
		 }
		 $("#country").html("");
    	 $.getJSON( "../Model/fetchCountry.php", {"term":""}, function( data, status, xhr ) {
    		 $("#country").append("<option value=\"default\" selected>Select...</option>");
             $.each(data, function(i, field){
                 if(field['name'] != countrySelected){
                     $("#country").append("<option value=\""+field['name']+"\">"+field['name']+"</option>");                     
                 }
                 else{
                	 $("#country").append("<option value=\""+field['name']+"\" selected>"+field['name']+"</option>");
                	 $( "#country" ).trigger("change");
                 }
               });             
    	 });		 
	 });
	 $( "#country" ).on({
		 change:function(){
		 var stateSelected = '';
		 if($("#stateSelected").val()){
			 stateSelected = $("#stateSelected").val();
		 }		 
    	 $.getJSON( "../Model/fetchState.php", {"term":$(this).val()}, function( data, status, xhr ) {
    		 $("#state").html("");
    		 $("#state").append("<option value=\"default\" selected>Select...</option>");    		 
             $.each(data, function(i, field){
            	 if(field['name'] != stateSelected){
            		 $("#state").append("<option value=\""+field['name']+"\">"+field['name']+"</option>");
            	 }
            	 else{
                	 $("#state").append("<option value=\""+field['name']+"\" selected>"+field['name']+"</option>");
            	 }
               });
             $("#state").trigger("change");
    	 });
		 }  
	 });
	 $( "#state" ).on({
		change:function(){
		 var citySelected = '';
		 if($("#citySelected").val()){
			 citySelected = $("#citySelected").val();
		 }			
		 $("#city").html("");
		 $("#city").append("<option value=\"none\" selected>none</option>");
		 $.getJSON( "../Model/fetchCity.php", {"term":$(this).val()}, function( data, status, xhr ) {
			 $("#city").html("");
			 $("#city").append("<option value=\"default\" selected>Select...</option>");
	         $.each(data, function(i, field){
            	 if(field['name'] != citySelected){
            		 $("#city").append("<option value=\""+field['name']+"\">"+field['name']+"</option>");
            	 }
            	 else{            		 
                	 $("#city").append("<option value=\""+field['name']+"\" selected>"+field['name']+"</option>");                	 
            	 }
	           });
		 });
	 	}  
	 });
	 
	var tooltips = $( "[title]" ).tooltip();

   
      $( "#skill_id" )      
        // don't navigate away from the field on tab when selecting an item
        .bind( "keydown", function( event ) {
          if ( event.keyCode === $.ui.keyCode.TAB &&
              $( this ).data( "ui-autocomplete" ).menu.active ) {
            event.preventDefault();
          }
        })
        .autocomplete({
          source: function( request, response ) {
        	 var temp = new Array();
            $.getJSON( "../Model/fetchSkillSet.php", {
              term: extractLast( request.term )
            }, function( data, status, xhr ) {                
                $.each(data, function(i, field){                	
                    temp[i] = field['skill']; 
                  });
                response( temp );
            });
          },
          search: function() {
            // custom minLength
            var term = extractLast( this.value );
            if ( term.length < 1 ) {
              return false;
            }
          },
          focus: function() {
            // prevent value inserted on focus
            return false;
          },
          select: function( event, ui ) {
            var terms = split( this.value );
            // remove the current input
            terms.pop();
            // add the selected item
            terms.push( ui.item.value );
            // add placeholder to get the comma-and-space at the end
            terms.push( "" );
            this.value = terms.join( ", " );
            return false;
          }
        });
      $("#formElem").submit(function(){
    	  if($("#start_periodPREVJOB").val() < $("#end_periodPREVJOB").val()){
        	  alert("okeee");        	  
    	  }
      });
 });
    function addMoreProject()
    {
        var $text1="<p><label ><?php echo $lang->TITLE;?> </label>";
        var $text2="<input id=\"title\" name=\"title[]\" type=\"text\" AUTOCOMPLETE=OFF />";
        var $text3="<label ><?php echo $lang->DESCRIPITION;?></label>";
        var $text4="<input id=\"descripition\" name=\"project_description[]\" type=\"text\" AUTOCOMPLETE=OFF />";
        var $text5="<label ><?php echo $lang->TECHNOLOGYUSED;?></label>";
        var $text6="<input id=\"technology\" name=\"technology_used[]\" type=\"text\" AUTOCOMPLETE=OFF />";
        var $text7="<label ><?php echo $lang->DURATION;?></label>";                                                  
        var $text8="<input id=\"duration\" name=\"duration[]\" type=\"number\" AUTOCOMPLETE=OFF /></p>";                  
        $("#ExtraProject").append($text1+$text2+$text3+$text4+$text5+$text6+$text7+$text8);
    }
    function addMoreCertificate()
    {
        var $text1="<p><label ><?php echo $lang->CERTIFICATENAME;?> </label>";
        var $text2="<input id=\"certificatename\" name=\"certificate_name[]\" type=\"text\" AUTOCOMPLETE=OFF />";
        var $text3="<label ><?php echo $lang->DESCRIPITION;?></label>";
        var $text4="<input id=\"certificatedescription\" name=\"certificate_description[]\" type=\"text\" AUTOCOMPLETE=OFF />";
        var $text5="<label ><?php echo $lang->DATEDAT;?></label>";        
        var $lastId = $("[class^=certificate]:last").attr("id");
        $lastId++;        
        var $text6="<input id="+$lastId+" name=\"certificate_duration[]\" class=\"certificate\" type=\"text\" AUTOCOMPLETE=OFF />";                          
        $("#ExtraCertificate").append($text1+$text2+$text3+$text4+$text5+$text6);        
        $("#runtimeScript").after("<script>$(\" #"+$lastId+"\").datepicker({changeYear: true,changeMonth: true,dateFormat: 'yy/mm/dd',minDate: new Date('1975/01/01'),maxDate: '-1d'});<\/script>");
    }
    function addMoreExtraCurricular()
    {
        var $text1="<p><label ><?php echo $lang->EXTRACURRICULAR;?> </label>";
        var $text2="<input id=\"extracurricular\" name=\"extracurricular_activity[]\" type=\"text\" AUTOCOMPLETE=OFF />";
        $("#ExtraCertificate").append($text1+$text2);
    }
</script>
<div id="mainWrapper">
<div><span class="reference"> </span></div>
    <div id="content">
    <div id="formErrors">
    <?php 
                    if (isset ( $_GET ['err'] )) {
                        $value=substr($_GET['err'],1);
                        $key=substr($_GET['err'],0,1);
                        echo "<h3>$lang->REGISTRATIONERROR" . $key . "[" . $lang->getRegError ( $key ) . "] in ".$value."</h3>";
                    }
    ?> 
    </div>
		<div id="wrapper" style="width: 780px">
			<div id="steps" style="width: 700px">
				<form id="formElem" name="formElem"	action="../controller/mainentrance.php?action=profileinfo"
				method="post" enctype="multipart/form-data">
                <fieldset class="step">
                	<legend> <?php echo $lang->ACCOUNT; ?> </legend>
                    <p><label><?php echo $lang->FIRSTNAME;?> </label> 
                    <input id="username" name="first_name" title="Please provide your first name."
                    <?php if(!empty($UserPersonalInfoDB['first_name'])){?> value="<?php echo $UserPersonalInfoDB['first_name']; } ?>"/></p>
                    <p><label><?php echo $lang->MIDDLENAME;?> </label>
                    <input id="username" name="middle_name" title="Please provide your middle name."
                    <?php if(!empty($UserPersonalInfoDB['middle_name'])){?> value="<?php echo $UserPersonalInfoDB['middle_name']; } ?>"/></p>
                    <p><label><?php echo $lang->LASTNAME;?> </label> 
                    <input	id="username" name="last_name" title="Please provide your last name."
                    <?php if(!empty($UserPersonalInfoDB['last_name'])){?> value="<?php echo $UserPersonalInfoDB['last_name']; } ?>"/></p>
                    <p><label><?php echo $lang->GENDER;?></label> 
                    <?php if (!empty($UserPersonalInfoDB['gender'])){
                        if($UserPersonalInfoDB['gender'] == "male"){
                            $select = "male";
                        }else{
                            $select = "female";
                        }
                    } ?> 
                    <input type="radio" name="gender" 
                    <?php if($select =="male"){?> checked="checked" <?php } ?> value="male"> <?php echo $lang->MALE;?>
                    <input type="radio" name="gender"
                    <?php if($select =="female"){?> checked="checked" <?php } ?> value="female"> <?php echo $lang->FEMALE;?></p>
                    <p><label><?php echo $lang->DOB;?></label>
                    <input type="text"	id="dateOfBirth" name="date_of_birth" readonly="true"
                    <?php if(!empty($UserPersonalInfoDB['date_of_birth'])){ //echo
                    $UserPersonalInfoDB['date_of_birth']; ?> 
                    value="<?php echo $UserPersonalInfoDB['date_of_birth'];} ?>" 
                    /></p>
                                        
                    <p><label><?php echo $lang->EMAIL;?></label> 
                    <input id="email" name="email_primary" placeholder="info@tympanus.net" type="email"	disabled="disabled" AUTOCOMPLETE="OFF"
                    <?php if(!empty($UserPersonalInfoDB['email_primary'])){?> value="<?php echo $UserPersonalInfoDB['email_primary']; } ?>" /></p>
                                                            
                    <p><label><?php echo $lang->SEC_EMAIL;?></label> 
                    <input id="email" name="email_secondary" placeholder="info@tympanus.net" type="email"
                    <?php if (!empty($UserPersonalInfoDB['email_secondary'])){?> value="<?php echo $UserPersonalInfoDB['email_secondary']; } ?>" /></p>
 	                <p><label><?php echo $lang->PHONENUMBER;?></label>
 	                <input id="phoneno" name="phone_no" placeholder="XXXXXXXXXX" type="text" AUTOCOMPLETE="OFF"
                    <?php if(!empty($UserPersonalInfoDB['phone_no'])){?> value="<?php echo $UserPersonalInfoDB['phone_no']; } ?>" /></p>
                     
                </fieldset>
                
                <fieldset class="step">
                	<legend><?php echo $lang->PERSONALINFO; ?></legend>
                    <p><label><?php echo $lang->ADDRESS;?> </label> 
                    <input id="address" name="address" type="text" AUTOCOMPLETE="OFF" 
                    <?php if (!empty($UserAddressInfoDB['address'])){?> value="<?php echo $UserAddressInfoDB['address']; } ?>" /></p>
                    <p><label><?php echo $lang->NATIONALITY;?> </label> 
                    <input id="nationality" name="nationality" type="text" AUTOCOMPLETE="OFF" 
                    <?php if (!empty($UserAddressInfoDB['nationality'])){?> value="<?php echo $UserAddressInfoDB['nationality']; } ?>" /></p>                    
                    
                    <p><label><?php echo $lang->COUNTRY;?> </label>
                     <select id="country" name="country_name">
                     <?php if (!empty($UserAddressInfoDB['country_name'])){?> 
                     <option id="countrySelected" value="<?php echo $UserAddressInfoDB['country_name']; } ?>">"<?php echo $UserAddressInfoDB['country_name']; ?>"</option>
                     </select>
                    </p>
                    <p><label><?php echo $lang->STATE;?> </label>
                     <select id="state" name="state_name">
                     <?php if (!empty($UserAddressInfoDB['state_name'])){?> 
                     <option id="stateSelected" value="<?php echo $UserAddressInfoDB['state_name']; } ?>">"<?php echo $UserAddressInfoDB['state_name']; ?>"</option>
                     </select>
                    </p>
                    <p><label><?php echo $lang->CITY;?></label>
                     <select id="city" name="city_name">
                     <?php if (!empty($UserAddressInfoDB['city_name'])){?> 
                     <option id="citySelected" value="<?php echo $UserAddressInfoDB['city_name']; } ?>">"<?php echo $UserAddressInfoDB['city_name']; ?>"</option>
                     </select>
                    </p>
                    <p><label><?php echo $lang->LANGUAGE;?></label>
                        <input id="language" name="language" type="text" AUTOCOMPLETE="OFF"
                        <?php if(!empty($UserAddressInfoDB['language'])){?> value="<?php echo $UserAddressInfoDB['language']; } ?>"/>
                    </p>                    
                    <p><label><?php echo $lang->IMAGE;?> </label>
                        <input id="image" name="user_image" type="file" 
                        AUTOCOMPLETE="OFF" />
                        <?php if (!empty($UserPersonalInfoDB['profile_image']))
                        {
                        	$uri = 'data:image/png;base64,'
                        	.base64_encode($userData['profile_image']);
                        ?>
                        <img id="userProfilePic" alt="user"
                        src="<?php echo $uri;?>" width="50" height="50">
                        <?php }?>
                    </p>
                </fieldset>
                <fieldset class="step">
                    <legend> <?php echo $lang->EDUCATION; ?></legend>
                    <p>
                        <label><?php echo $lang->BOARD10;?> </label>
                        <input id="board_10" name="board_10" type="text"
                        AUTOCOMPLETE="OFF"
                        <?php if(!empty($UserAcademicInfoDB['board_10'])){?>
                        value="<?php echo $UserAcademicInfoDB['board_10']; } ?>"/>
                        
                        <label><?php echo $lang->SCHOOL10;?> </label> 
                        <input id="school_10" name="school_10" type="text" 
                        AUTOCOMPLETE="OFF"
                        <?php if(!empty($UserAcademicInfoDB['school_10'])){?>
                        value="<?php echo $UserAcademicInfoDB['school_10']; } ?>" />
                        
                        <label><?php echo $lang->PERCENTAGE;?> </label> 
                        <input id="10percentage" name="percentage_GPA_10" 
                        AUTOCOMPLETE="OFF"
                        <?php if (!empty($UserAcademicInfoDB['percentage_GPA_10']))
                        {?> value="<?php echo 
                        floatval($UserAcademicInfoDB['percentage_GPA_10']); } ?>" />
                    </p>
                    <p>
                        <label><?php echo $lang->BOARD12;?> </label>
                        <input id="board_10" name="board_12" type="text" 
                        AUTOCOMPLETE="OFF"
                        <?php if (!empty($UserAcademicInfoDB['board_12'])){?>
                        value="<?php echo $UserAcademicInfoDB['board_12']; } 
                        ?>" />
                        
                        <label><?php echo $lang->SCHOOL12;?></label>
                        <input id="school_10" name="school_12" type="text" 
                        AUTOCOMPLETE="OFF"
                        <?php if(!empty($UserAcademicInfoDB['school_12'])){?>
                        value="<?php echo $UserAcademicInfoDB['school_12']; } ?>" />
                        
                        <label><?php echo $lang->PERCENTAGE;?> </label> 
                        <input id="10percentage" name="percentage_12" 
                        AUTOCOMPLETE="OFF"
                        <?php if(!empty($UserAcademicInfoDB['percentage_12']))
                        {?> 
                        value="<?php echo floatval($UserAcademicInfoDB['percentage_12']);
                        } ?>" />
                    </p>
                    <p>
                        <label><?php echo $lang->DEGREE;?> </label> 
                        <input id="board_10" name="graduation_degree" type="text" AUTOCOMPLETE="OFF"
                        <?php if (!empty($UserAcademicInfoDB['graduation_degree'])){?> 
                        value="<?php echo $UserAcademicInfoDB['graduation_degree']; } ?>" /> 
                        <label><?php echo $lang->SPECIALIZATION;?></label>
                        <input id="school_10" name="graduation_specialization" type="text" AUTOCOMPLETE="OFF"
                        <?php if (!empty($UserAcademicInfoDB['graduation_specialization'])){?> 
                        value="<?php echo $UserAcademicInfoDB['graduation_specialization']; } ?>" /> 
                        <label><?php echo $lang->SCHOOLCOLLEGE;?></label>
                        <input id="school_10" name="graduation_college" type="text" AUTOCOMPLETE="OFF"
                        <?php if(!empty($UserAcademicInfoDB['graduation_college'])){?> 
                        value="<?php echo $UserAcademicInfoDB['graduation_college']; } ?>" /> 
                        <label><?php echo $lang->PERCENTAGE;?></label> 
                        <input id="10percentage" name="graduation_percentage" AUTOCOMPLETE="OFF"
                        <?php if(!empty($UserAcademicInfoDB['graduation_percentage'])){?> 
                        value="<?php echo floatval($UserAcademicInfoDB['graduation_percentage']); } ?>"/>
                    </p>
                    <p>
                        <label><?php echo $lang->POST_DEGREE;?> </label>
                        <input id="board_10" name="post_graduation_degree" type="text" AUTOCOMPLETE=OFF
                        <?php if (!empty($UserAcademicInfoDB['post_graduation_degree'])){?> 
                        value="<?php echo $UserAcademicInfoDB['post_graduation_degree']; } ?>"/>
                        <label><?php echo $lang->SPECIALIZATION;?> </label>
                        <input id="school_10" name="post_graduation_specialization" type="text" AUTOCOMPLETE="OFF" 
                        <?php if (!empty($UserAcademicInfoDB['post_graduation_specialization'])){?> 
                        value="<?php echo $UserAcademicInfoDB['post_graduation_specialization']; } ?>"/>
                        <label><?php echo $lang->SCHOOLCOLLEGE;?></label> 
                        <input id="school_10" name="post_graduation_college" type="text" AUTOCOMPLETE="OFF" 
                        <?php if(!empty($UserAcademicInfoDB['post_graduation_college'])){?> 
                        value="<?php echo $UserAcademicInfoDB['post_graduation_college']; } ?>" />
                        <label><?php echo $lang->PERCENTAGE;?></label> 
                        <input id="10percentage" name="post_graduation_percentage" AUTOCOMPLETE="OFF"
                        <?php if(!empty($UserAcademicInfoDB['post_graduation_percentage'])){?> 
                        value="<?php echo floatval($UserAcademicInfoDB['post_graduation_percentage']); } ?>"/>
                    </p>
                </fieldset>
                <fieldset id="ExtraProject" class="step" id="projects">
                    <legend> <?php echo $lang->PROJECT; ?></legend> 
                    <?php foreach($UserProjectInfoDB as $key => $value){ ?>
                        <p>
                            <label><?php echo $lang->TITLE;?> </label>
                            <input id="title" name="title[]" type="text" AUTOCOMPLETE="OFF" 
                            <?php if (!empty($value['title'])){?> 
                            value="<?php echo $value['title']; } ?>" />
                            <label><?php echo $lang->DESCRIPITION;?></label>
                            <input id="descripition" name="project_description[]" type="text" AUTOCOMPLETE="OFF"
                            <?php if (!empty($value['project_description'])){?> 
                            value="<?php echo $value['project_description']; } ?>" /> 
                            <label><?php echo $lang->TECHNOLOGYUSED;?> </label>
                            <input id="technology" name="technology_used[]" type="text"	AUTOCOMPLETE="OFF"
                            <?php if(!empty($value['technology_used'])){?> 
                            value="<?php echo $value['technology_used']; } ?>"/> 
                            <label><?php echo $lang->DURATION;?> </label> 
                            <input id="duration" name="duration[]" type="number" AUTOCOMPLETE="OFF"
                            <?php if(!empty($value['duration'])){?> 
                            value="<?php echo $value['duration']; } ?>"/>
                            <?php if (!empty($value['title'])){?>
                                <input type="button" class="selectProject" 
                                id="<?php if(!empty($value['id'])){ echo $value['id']; } ?>" 
                                value="Delete Project" /> 
                            <?php }?>
                        </p>
                    <?php } ?>
                    <p>
                    	<input type="button" value="<?php echo $lang->ADDMORE;?>" onclick="addMoreProject();">
                    </p>
                </fieldset>
                <fieldset class="step" id="currentJob">
                    <legend> <?php echo $lang->JOB; ?></legend>
                    <p>
                        <label><?php echo $lang->SKILLSET;?> </label> 
                        <input id="skill_id" name="skill_set"
                        <?php if(!empty($UserProfessionalInfoDB['skill_set'])){?> value="<?php echo $UserProfessionalInfoDB['skill_set']; } ?>"/> 
                        <label><?php echo $lang->CURRENTPOSITION;?></label>
                        <input id="current_position" name="current_position" type="text" AUTOCOMPLETE="OFF"
                        <?php if(!empty($UserProfessionalInfoDB['current_position'])){?> value="<?php echo $UserProfessionalInfoDB['current_position']; } ?>"/> 
                        <label><?php echo $lang->CURRENTCOMPANY;?></label>
                        <input id="current_company" name="current_company" type="text" AUTOCOMPLETE="OFF"
                        <?php if(!empty($UserProfessionalInfoDB['current_company'])){?> value="<?php echo $UserProfessionalInfoDB['current_company']; } ?>"/>
                        <label><?php echo $lang->STARTPERIOD;?> </label> 
                        <input id="start_period" class="date" name="start_period" type="text" AUTOCOMPLETE="OFF" readonly="true"
                        <?php if(!empty($UserProfessionalInfoDB['start_period'])){?> value="<?php echo $UserProfessionalInfoDB['start_period']; } ?>"/>
                    </p>
                </fieldset>
                <fieldset class="step" id="previousJob">
                	<legend><?php echo $lang->PREVJOB; ?></legend>
                    <p>
                        <label><?php echo $lang->POSITION;?> </label> 
                        <input id="position" name="PreviousJob_position" type="text" AUTOCOMPLETE="OFF"
                        <?php if(!empty($UserPreviousJobInfoDB['position'])){?> value="<?php echo $UserPreviousJobInfoDB['position']; } ?>"/> 
                        <label><?php echo $lang->COMPANY;?></label>
                        <input id="company" name="PreviousJob_company" type="text" AUTOCOMPLETE="OFF"
                        <?php if(!empty($UserPreviousJobInfoDB['company'])){?> value="<?php echo $UserPreviousJobInfoDB['company']; } ?>"/> 
                        <label><?php echo $lang->STARTPERIOD;?> </label> 
                        <input id="start_periodPREVJOB" name="PreviousJob_start_period" type="text" AUTOCOMPLETE="OFF" readonly="true"
                        <?php if(!empty($UserPreviousJobInfoDB['start_period'])){?> value="<?php echo $UserPreviousJobInfoDB['start_period']; } ?>"/>
                        <label><?php echo $lang->ENDPERIOD;?></label> 
                        <input id="end_periodPREVJOB" name="PreviousJob_end_period" type="text" AUTOCOMPLETE="OFF" readonly="true"
                        <?php if(!empty($UserPreviousJobInfoDB['end_period'])){?> value="<?php echo $UserPreviousJobInfoDB['end_period']; } ?>"/>
                    </p>
                </fieldset>
                <fieldset id="ExtraCertificate" class="step" id="otherCertificate">
                    <legend> <?php echo $lang->OTHER; ?></legend>
                    <?php foreach($UserCertificateInfoDB as $key => $value){ ?>
                        <p>
                            <label><?php echo $lang->CERTIFICATENAME;?> </label>
                            <input id="certificatename" name="certificate_name[]" type="text" AUTOCOMPLETE="OFF"
                            <?php if (!empty($value['name'])){?> value="<?php echo $value['name']; } ?>" />
                            <label><?php echo $lang->DESCRIPITION;?></label>
                            <input id="certificatedescription" name="certificate_description[]" type="text" AUTOCOMPLETE="OFF"
                            <?php if (!empty($value['description'])){?> value="<?php echo $value['description']; } ?>" /> 
                            <label><?php echo $lang->DATEDAT;?></label>
                            <input id="<?php if(!empty($value['id']))
                            { echo $value['id']; }else{echo 0;} ?>"
                            class="certificate" name="certificate_duration[]"
                            type="text" AUTOCOMPLETE="OFF" readonly="true"
                            <?php if(!empty($value['duration'])){
                            ?> value="<?php echo $value['duration']; } 
                            ?>"/>
                            <?php if (!empty($value['name'])){?>
                                <input type="button" class="selectCertificate" id="<?php if(!empty($value['id'])){ echo $value['id']; } ?>" value="Delete Certificate" />
                            <?php }?>
                        </p>
                    <?php } ?>
                    <?php foreach($UserExtraCurricularInfoDB as $key => $value){ ?>
                        <p>
                            <label><?php echo $lang->EXTRACURRICULAR?> </label>
                            <input id="extracurricular" name="extracurricular_activity[]" type="text" AUTOCOMPLETE="OFF"
                            <?php if(!empty($value['activity'])){?> value="<?php echo $value['activity']; } ?>"/>
                            <?php if (!empty($value['activity'])){?>
                                <input type="button" class="selectExtracurricular" id="<?php if(!empty($value['id'])){ echo $value['id']; } ?>" value="Delete Extra Curricular" />
                            <?php }?>                            
                        </p>
                    <?php } ?>
                    <p>
                    	<input type="button" value="<?php echo $lang->ADDMORE . " Certificate";?>" onclick="addMoreCertificate();">
                    	<input type="button" value="<?php echo $lang->ADDMORE . " Extra Curricular";?>" onclick="addMoreExtraCurricular();">
                    </p>                    
                </fieldset>
                <fieldset class="step">
                    <legend> <?php echo $lang->CONFIRM; ?></legend>
                    <p>
                        <?php echo $lang->CONFIRMMSG; ?>
                    </p>
                	<p class="submit">
                	<button id="registerButton" type="submit"><?php echo $lang->REGISTER?></button>
                	</p>
                </fieldset>
			</form>
		</div>
	<div id="navigation" style="display: none;">
		<ul>
			<li class="selected"><a href="#"><?php echo $lang->ACCOUNT; ?></a></li>
			<li><a href="#"><?php echo $lang->PERSONALINFO; ?> </a></li>
			<li><a href="#"><?php echo $lang->EDUCATION; ?> </a></li>
        	<li><a href="#"><?php echo $lang->PROJECT; ?> </a></li>
        	<li><a href="#"><?php echo $lang->JOB; ?> </a></li>
        	<li><a href="#"><?php echo $lang->PREVJOB; ?> </a></li>
        	<li><a href="#"><?php echo $lang->OTHER; ?> </a></li>
        	<li><a href="#"><?php echo $lang->CONFIRM; ?> </a></li>
		</ul>
	</div>
</div>
</div>
</div>
<div id="runtimeScript" style="display: none;"></div>