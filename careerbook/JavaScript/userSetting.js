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
    
    function chngEmailID(){
        var text=' <table id="emailTlb">\
                <tr>  <p class="seting">Please Enter your New Email ID</p> </tr>\
                <tr>\
                <td><lable class="seting">New Email ID</lable></td>\
                <td><input type="text" name="newEmail" id="newEmail" /></td>\
                </tr>\
                <tr>\
                <td><lable class="seting">Confirm Email ID</lable></td>\
                <td><input type="text" name="confrmEmail" id="confrmEmail" /></td>\
                </tr>\
                <tr>\
                 <td><input type="button" value="Submit" onclick="EmailChng();" />\
                 <input type="button" value="Cancel" onclick="funCancel();" /></td>\
                </tr>\
                </table>';
           $("#perform").html(text);
        
        
    }
    
    function EmailChng()
    {
        var text='   <table>\
                  <p class="seting">We sent You a code to your new Email ID\
                  <p class="seting">Pelase enter the code here</p>\
                  <tr>\
                  <td><p class="seting">Code:</p></td>\
                    <td><input type="text" name="code" /><td>\
                    </tr>\
                    <tr>\
                    <td><input type="button" value="submit" onclick="performEmailChng();">\
                    <input type="button" value="Cancel" onclick="funCancel();"></td>\
                </tr>\
                </table>';
        $("#perform").html(text);
    }
    
    function delUser()
    {
        var text='<p class="seting">Are You sure to delete your account </p>\
    <input type="button" value="Yes" onclick="performDelUser();"/>\
    <input type="button" value="No" onclick="funCancel();"/>';
        $("#perform").html(text); 
    }
    
    
    function funCancel()
    {
        $("#perform").html("");
    }
    
    function performDelUser(){
        $.post('');
        $("#perform").append("<p class='seting'>Account Deleted</p>");
        $("#perform input[type='button']").attr("disabled",true);
    }
    
    function performEmailChng()
    {
        $("#perform").append("<p class='seting'>Email Change Successfully</p>");
        $("#perform input[type='button']").attr("disabled",true);
    }
    
    
    function performChngPwd(){
        $("#perform").append("<p class='seting'>Password Change Successfully</p>");
        $("#perform input[type='button']").attr("disabled",true);
    }
    