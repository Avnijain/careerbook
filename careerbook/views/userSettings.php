<?php

?>

<script type="text/javascript" src="../JavaScript/jquery1.min.js"></script>
<script type="text/javascript" src="../JavaScript/userSetting.js"></script>

<p id="SettingHead">Settings</p>

<div id="options">
  <ul>
        <li onclick='chngPwd();'>Change Password</li>
        <li onclick='chngEmailID();'>Change Login ID</li>
        <li onclick='delUser();'>Delete Account</li>
  </ul>      
</div>

<div id="perform">
    


    
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
		font-size: 15px;
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
		font-size: 16px;
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