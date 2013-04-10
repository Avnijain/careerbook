/* *********************************************************************************************

Login form tutorial (CSS3 + jQuery) [Tutorial]
"Login form tutorial (CSS3 + jQuery)" that was specially made for DesignModo by our friend Valeriu Timbuc. 

Links:
http://vtimbuc.net/
https://twitter.com/vtimbuc
http://designmodo.com/futurico
http://vladimirkudinov.com
http://rockablethemes.com

********************************************************************************************* */

$(document).ready(function() {

	// Check if JavaScript is enabled
	$('body').addClass('js');

	// Make the checkbox checked on load
	$('.login-form span').addClass('checked').children('input').attr('checked', true);

	// Click function
	$('.login-form span').on('click', function() {

		if ($(this).children('input').attr('checked')) {
			$(this).children('input').attr('checked', false);
			$(this).removeClass('checked');
		}

		else {
			$(this).children('input').attr('checked', true);
			$(this).addClass('checked');
		}
	
	});
	
	$('#email').blur(function() {
		
        var sEmail = $('#email').val();

        if (validateEmail(sEmail)) { 
        }
        else {
            $('#error_div1').text("Not a Valid Email id");
            return false;
        }
    });
	
	$('#email').focus(function() {
		$('#error_div1').text("");
	});
	
	$("#first_name").blur(function() {
		var sName = $('#first_name').val();
		if (validateName(sName) ) {
	        
	    } else {
	    	 $('#error_div1').text("First Name must not be blank and must be 3-14 chars long");
	            return false;
	    }

	  });
	
	$('#first_name').focus(function() {
		$('#error_div1').text("");
	});
	
	$("#middle_name").blur(function() {
		var sName = $('#middle_name').val();
		if (Number == "") {
	        
	    } else if (validateName(sName)){
	    } else {
	    	 $('#error_div1').text("Middle Name must not be blank and must be 3-14 chars long");
	            return false;
	    }
	  });
	
	$('#middle_name').focus(function() {
		$('#error_div1').text("");
	});
	
	$("#last_name").blur(function() {
		var sName = $('#last_name').val();
		if (validateName(sName) ) {
	        
	    } else {
	    	 $('#error_div1').text("Last Name must not be blank and must be 3-14 chars long");
	            return false;
	    }

	  });
	
	$('#last_name').focus(function() {
		$('#error_div1').text("");
	});
	
	$("#phone_no").blur(function() {
		var Number = $('#phone_no').val();
		if (Number == "") {
	        
	    } else if (validateName(Number)){
	    	$('#error_div1').text("Phone No. should only contain 0-9");
            return false;
	    }
	  });
	
	$('#phone_no').focus(function() {
		$('#error_div1').text("");
	});
});
	
//function to allow only numbers
function numericsonly(ob) 
{
    //var invalidChars = /^[0-9-+]+$/;
	var invalidChars = /^[0-9]$/;
    if(invalidChars.test(ob.value)) 
    {
        ob.value = ob.value.replace(invalidChars,"");
        return false;
    } else {
    	return true;
    }
} //function to allow only numbers ends here

function validateName(sName) {
	var filter = /^[a-zA-Z]{3,16}$/;
    if (filter.test(sName)) {
        return true;
    }
    else {
        return false;
    }
}

function validateEmail(sEmail) {
    var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    if (filter.test(sEmail)) {
        return true;
    }
    else {
        return false;
    }
}