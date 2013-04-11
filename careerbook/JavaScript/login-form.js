/*
 * *************************** Creation Log ******************************* 
 * File Name 	- 	login-form.php 
 * Project Name - 	Careerbook 
 * Description 	-	JavaScript file for start Version - 1.0 
 * Created by	- 	Manish Ranjan 
 * Created on 	- 	March 30, 2013 
 * **************************** Update Log ******************************** 
 * Sr.NO.		Version		Updated by Updated on Description 
 * ------------------------------------------------------------------------- 
 * ------------------------------------------------------------------------- 
 * ************************************************************************
 */

(function($, W, D) {

	var JQUERY4U = {};

$(document).ready(function() {
	
	$.validator.addMethod("loginRegex", function(value,
			element) {
		return this.optional(element)
				|| /^[a-z]+$/i.test(value);
	});

	$.validator
		.addMethod(
			"url",
			function(value, element) {
				return this.optional(element)
					|| !(/^(([\w]+:)?\/\/)?(([\d\w]|%[a-fA-f\d]{2,2})+(:([\d\w]|%[a-fA-f\d]{2,2})+)?@)?([\d\w][-\d\w]{0,253}[\d\w]\.)+[\w]{2,4}(:[\d]+)?(\/([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)*(\?(&?([-+_~.\d\w]|%[a-fA-f\d]{2,2})=?)*)?(#([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)?$/i
					.test(value));
	});

	$.validator.addMethod("script",
		function(value, element) {
			return this.optional(element)
				|| !(/(<([^>]+)>)/i.test(value));
	});
	
	$("#formElem")
	.validate(
			{
				rules : {

					first_name : {
						loginRegex : true,
						required : true,
						url : true,
						script : true,

					},
					middle_name : {
						loginRegex : true,
						url : true,
						script : true,

					},
					last_name : {
						loginRegex : true,
						required : true,
						url : true,
						script : true,

					},

				
					email : {
						required : true,
						email : true,
						script : true,

					},

					phone_no : {
						url : true,
						script : true,
						number : true,
						minlength : 10,
						maxlength : 10,
					},
					
//					date_of_birth : {
//						script : true,
//						url : true,
//						date : true
//					},

				},
				messages : {
					first_name : {
						required : "Please enter your firstname",
						loginRegex : "Firstname must contain only letters.",
						url : "Url not allowed",
						script : "Dont use script here",
					},
					
					middle_name : {
						loginRegex : "Middlename must contain only letters.",
						url : "Url not allowed",
						script : "Dont use script here",
					},

					last_name : {
						required : "Please enter your lastname",
						loginRegex : "Lastname must contain only letters.",
						url : "Url not allowed",
						script : "Dont use script here",
					},
					
//					date_of_birth : {
//						url : "Url not allowed",
//						script : "Dont use script here",
//						date : "Date format not correct"
//					},
					
					phone_no : {
						required : "Please provide a phoneno",
						minlength : "Your phone must be at least 10 characters long",
						maxlength : "Not more than 10 characters",
						url : "Url not allowed",
						number : "Only numbers allowed",
						script : "Dont use script here",
					},

					email : {
						email : "Please enter a valid email address",
						script : "Dont use script here",
					}

				},
				submitHandler : function(form) {
					form.submit();
				}
	});
});

})(jQuery, window, document);
