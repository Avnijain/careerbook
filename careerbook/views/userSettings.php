<?php

?>
<script type="text/javascript" src="../JavaScript/jquery1.min.js"></script>
<script>
    function chngPwd()
    {
    var text= '<table>\
              <tr>\
            <td><lable class="seting">Current Password</lable></td>\
            <td><input type="password" name="currPwd" id="currentPwd" /></td>\
    </tr>\
         <tr>  <p class="seting">Please Enter your Current Password</p> </tr>\
    <tr>\
            <td><lable class="seting">New Password</lable></td>\
            <td><input type="password" name="newPwd" id="newPwd" /></td>\
    </tr>\
    <tr>\
            <td><lable class="seting">Confirm Password</lable></td>\
            <td><input type="password" name="confirmPwd" id="confirmPwd" /></td>\
    </tr>\
    <tr>\
            <td><input type="button" value="Submit" onclick="performChngPwd();" />\
            <input type="button" value="Cancel" onclick="funCancel();" /></td>\
    </tr>\
    </table>';
    $("#perform").html(text);
    }
    
    
    function funCancel()
    {
        $("#perform").html("");
    }
    
    
    function performChngPwd(){
        $("#perform").append("<p class='seting'>Password Change Successfully</p>");
        $("#perform input[type='button']").attr("disabled",true);
    }
    
    
</script>
<p id="SettingHead">Settings</p>

<div id="options">
  <ul>
        <li onclick='chngPwd();'>Change Password</li>
        <li>Change Login ID</li>
  </ul>      
</div>
<div id="perform">
   <table id="emailTlb">
    <tr>
            <td><lable class="seting">Current Email ID</lable></td>
            <td><input type="text" name="currEmail" id="currEmail" /></td>
    </tr>
    <tr>
            <td><lable class="seting">New Email ID</lable></td>
            <td><input type="text" name="newEmail" id="newEmail" /></td>
    </tr>
    <tr>
            <td><lable class="seting">Confirm Email ID</lable></td>
            <td><input type="text" name="confrmEmail" id="confrmEmail" /></td>
    </tr>

         <tr>  <p class="seting">Please Enter your Current Email Id</p> </tr>
    <tr>
            <td><input type="button" value="Submit" onclick="" />
             <input type="button" value="Cancel" onclick="funCancel();" /></td>
    </tr>
</table>
    <p class="seting">Password Change Successfully</p>

</div>

<style>
    #SettingHead{
   

                font-family: times, Times New Roman, times-roman, georgia, serif;
		font-size: 48px;
	        line-height: 40px;
	        letter-spacing: -1px;
		color: #444;
		margin: 0 0 0 0;
		padding: 0 0 0 0;
                font-weight: 100;
                text-align: center;
   
    }
    #options{
        float: left;
        margin-top: 19px;
    }
    #perform{
        float: left;
        margin-top: 20px;
       border: 3px black  double;
    }
    #options > ul > li{
                border: groove 2px black;
                background-color: #239CC5;
                list-style-type: none;
                font-family: times, Times New Roman, times-roman, georgia, serif;
		font-size: 18px;
	        line-height: 20px;
	        letter-spacing: 0px;
		color: #444;
                width: 97%;
                height: 5%;
		margin: 3 0 0 1;
		padding: 15 0 0 0;
                cursor: pointer;
                font-weight: 100;
    }
        .seting{
               
                
                
               font-family: times, Times New Roman, times-roman, georgia, serif;
		font-size: 20px;
	        line-height: 20px;
	        letter-spacing: 0px;
		color: #444;
		margin: 0 5 0 9;
		padding: 2 0 0 0;
                font-weight: 100;
    }

        #options ul li:hover{
               
                background-color: #23922D;
  
    }
    
</style>