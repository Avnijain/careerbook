(function($, W, D) {

$(document).ready(function() {
	
	$("#description").click(function(){
		$("#description").width("360");
		$("#description").height("70");
	});
	
	$("#group_discussion_description").click(function(){
		$("#group_discussion_description").width("360");
		$("#group_discussion_description").height("70");
	});
	
	$("#group_discussion_comment").click(function(){
		$("#group_discussion_comment").width("360");
		$("#group_discussion_comment").height("70");
	});
	
	$("#group_discussion_description").click(function(){
		$("#group_discussion_description").width("360");
		$("#group_discussion_description").height("70");
	});
	
	$.validator.addMethod("groupRegex", function(value,
			element) {
		return this.optional(element)
				|| /^[a-z' ']+$/i.test(value);
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
		
	$("#add_group_form")
	.validate(
			{
				rules : {

					title : {
						groupRegex : true,
						required : true,
						url : true,
						script : true,
						minlength : 3,
						maxlength : 60,

					},
					description : {
						groupRegex : true,
						required : true,
						url : true,
						script : true,
						minlength : 10,
						maxlength : 100,
					},
					
				},
				messages : {
					title : {
						required : "Please enter your group  title",
						groupRegex : "Group title must contain only letters.",
						minlength : "Your Group title must be at least 3 characters long",
						maxlength : "Your Group title Not more than 60 characters",
						url : "Url not allowed",
						script : "Dont use script here",
					},
					
					description : {
						required : "Please enter your group  description",
						groupRegex : "Group description must contain only letters.",
						minlength : "Your Group description must be at least 10 characters long",
						maxlength : "Your Group description must Not more than 100 characters",
						url : "Url not allowed",
						script : "Dont use script here",
					},

				},
				submitHandler : function(form) {
					form.submit();
				}
		});
	
	$("#edit_group_form")
	.validate(
			{
				rules : {

					title : {
						groupRegex : true,
						required : true,
						url : true,
						script : true,
						minlength : 3,
						maxlength : 60,

					},
					description : {
						groupRegex : true,
						required : true,
						url : true,
						script : true,
						minlength : 10,
						maxlength : 100,
					},
					
				},
				messages : {
					title : {
						required : "Please enter your group  title",
						groupRegex : "Group title must contain only letters.",
						minlength : "Your Group title must be at least 3 characters long",
						maxlength : "Your Group title Not more than 60 characters",
						url : "Url not allowed",
						script : "Dont use script here",
					},
					
					description : {
						required : "Please enter your group  description",
						groupRegex : "Group description must contain only letters.",
						minlength : "Your Group description must be at least 10 characters long",
						maxlength : "Your Group description must Not more than 100 characters",
						url : "Url not allowed",
						script : "Dont use script here",					},

				},
				submitHandler : function(form) {
					form.submit();
				}
		});
	
	$("#group_post_form")
	.validate(
			{
				rules : {
					group_discussion_description : {
						required : true,
						groupRegex : true,
						minlength : 3,
						maxlength : 250,
					},
					
				},
				messages : {
					group_discussion_description : {
						required : "Please enter your group  title",
						groupRegex : "Post must contain only letters.",
						minlength : "Your Post must be at least 3 characters long",
						maxlength : "Your Post must Not more than 250 characters",
					},

				},
				submitHandler : function(form) {
					form.submit();
				}
		});
	
	$("#editPost_form")
	.validate(
			{
				rules : {
					group_discussion_description : {
						required : true,
						groupRegex : true,
						minlength : 3,
						maxlength : 250,
					},
					
				},
				messages : {
					group_discussion_description : {
						required : "Please enter your Post",
						groupRegex : "Post must contain only letters.",
						minlength : "Your Post must be at least 3 characters long",
						maxlength : "Your Post must Not more than 250 characters",
					},

				},
				submitHandler : function(form) {
					form.submit();
				}
		});
	
	$("#groupDiscussionComment_form")
	.validate(
			{
				rules : {
					group_discussion_comment : {
						required : true,
						groupRegex : true,
						minlength : 3,
						maxlength : 250,
					},
					
				},
				messages : {
					group_discussion_comment : {
						required : "Please enter your comment",
						groupRegex : "Comment must contain only letters.",
						minlength : "Your Comment must be at least 3 characters long",
						maxlength : "Your Comment must Not more than 250 characters",
					},

				},
				submitHandler : function(form) {
					form.submit();
				}
		});
	
	});
})(jQuery, window, document);;
	

function addGroup() {
	url = "../View/add_group.php";
	$("#selectorLogin").attr("href",url);
    $("#selectorLogin").trigger("click");
    
}

function editGroup() {
	url = "../View/edit_group.php";
	$("#selectorLogin").attr("href",url);
    $("#selectorLogin").trigger("click");
    
}

function groupList() {
	$.post('../controller/mainentrance.php',{'action':'Group'},function(){        
		window.location="userHomePage.php?getGroup";
    });
}

function viewGroup(groupId) {
	$.post('../controller/mainentrance.php',{'action':'getPost','groupId':groupId},function(){        
		window.location="userHomePage.php?groupPost";
    });
}

function viewComment(postId) {
	$.post('../controller/mainentrance.php',{'action':'getComment','groupDiscussionId':postId},function(){        
		window.location="userHomePage.php?groupComment";
    });
}

function deleteGroup(groupId) {
	var chk=window.confirm("Are You Sure...want to delete this group");
    if(chk==true) {
    	$.post('../controller/mainentrance.php',{'action':'delete_group','groupId':groupId},function(){        
    		window.location="userHomePage.php?Group";
        });
    } else {

    }
}

function deleteComment(commentId,groupDisscussionId) {
	var chk=window.confirm("Are You Sure...want to delete this comment");
    if(chk==true) {
    	$.post('../controller/mainentrance.php',{'action':'delete_comment','commentId':commentId},function(){        
    		viewComment(groupDisscussionId);
        });
    } else {
    		
    }
}

function unlinkGroup(groupId) {
	var chk=window.confirm("Are You Sure...want to leave this group");
    if(chk==true) {
    	$.post('../controller/mainentrance.php',{'action':'unjoinGroup','groupId':groupId},function(){        
    		window.location="userHomePage.php?Group";
        });
    } else {

    }
}

function cancelAddGroup() {
	window.location="userHomePage.php?Group";
}

