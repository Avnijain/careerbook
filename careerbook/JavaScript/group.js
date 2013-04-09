$(function() {

	$('#add_group_form')
		.submit(
			function() {
				if ($('#title').val().length == 0 ||
						$('#title').val().length > 60) {
						$('#title')
							.addClass('error')
							.after(
							'<br/><span class="error"><br/>This title must not be empty or greater than 60 characters </span>');
							return false;
					}
				if ($('#description').val().length == 0 ||
						$('#description').val().length > 250) {
					$('#description')
						.addClass('error')
						.after(
						'<br/><span class="error"><br/>This description must not be empty or greater than 250 characters </span>');
						return false;
				}
			}	
		);
	
	$('#edit_group_form')
	.submit(
			function() {
				if ($('#title').val().length == 0 ||
						$('#title').val().length > 60) {
						$('#title')
							.addClass('error')
							.after(
							'<br/><span class="error"><br/>This title must not be empty or greater than 60 characters </span>');
							return false;
					}
				if ($('#description').val().length == 0 ||
						$('#description').val().length > 250) {
					$('#description')
						.addClass('error')
						.after(
						'<br/><span class="error"><br/>This description must not be empty or greater than 250 characters </span>');
						return false;
				}
			}		
	);

	$('#title').focus(function() {
		$(this).removeClass('error').next('span').remove();
	});
	
	$('#description').focus(function() {
		$(this).removeClass('error').next('span').remove();
	});

	$('#group_post_form')
		.submit(
			function() {
				if (($('#group_discussion_description').val().length > 100) || ($('#group_discussion_description').val().length == 0)) {
					$('#group_discussion_description')
						.addClass('error')
						.after(
						'<span class="error"><br/>This Comment must not empty and less than 100 chars.</span>');
						return false;
				}
			}
		);
	
	$('#group_discussion_description').focus(function() {
		$(this).removeClass('error').next('span').remove();
	});

	$('#groupDiscussionComment_form')
		.submit(
			function() {
				if (($('#group_discussion_comment').val().length > 100) || ($('#group_discussion_comment').val().length == 0)) {
					$('#group_discussion_comment')
						.addClass('error')
						.after(
						'<span class="error"><br/>This Comment must not empty and less than 100 chars.</span>');
						return false;
				}
			}
		);
	
	$('#group_discussion_comment').focus(function() {
		$(this).removeClass('error').next('span').remove();
	});
	
	$('#editPost_form')
	.submit(
		function() {
			if (($('#group_discussion_description').val().length > 100) || ($('#group_discussion_description').val().length == 0)) {
				$('#group_discussion_description')
					.addClass('error')
					.after(
					'<span class="error"><br/>This Comment must not empty and less than 100 chars.</span>');
					return false;
			}
		}
	);

});


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

