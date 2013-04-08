$(function() {


	$('#add_group_form')
		.submit(
			function() {
				if ($('#description').val().length == 0, $(
					'#description').val().length > 250) {
					$('#description')
						.addClass('error')
						.after(
						'<br/><span class="error"><br/>This field must not be empty or greater than 250 characters </span>');
						return false;
				}
				if ($('#title').val().length == 0,
					$('#title').val().length > 60) {
					$('#title')
						.addClass('error')
						.after(
						'<br/><span class="error"><br/>This field must not be empty </span>');
						return false;
				}
			}
		);

	$('#description').focus(function() {
		$(this).removeClass('error').next('span').remove();
	});

	$('#title').focus(function() {
		$(this).removeClass('error').next('span').remove();
	});

	$('#group_post_form')
		.submit(
			function() {
				if (($('#group_discussion_description').val().length > 100)) {
					$('#group_discussion_description')
						.addClass('error')
						.after(
						'<span class="error"><br/>This Comment must be less than 100 chars.</span>');
						return false;
				}
				if (($('#group_discussion_description').val().length == 0)) {
					$('#group_discussion_description')
						.addClass('error')
						.after(
						'<span class="error"><br/>This field must not be empty</span>');
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
				if (($('#group_discussion_comment').val().length > 100)) {
					$('#group_discussion_comment')
						.addClass('error')
						.after(
						'<span class="error"><br/>This Comment must be less than 100 chars.</span>');
						return false;
				}
				if (($('#group_discussion_comment').val().length == 0)) {
					$('#group_discussion_comment')
						.addClass('error')
						.after(
						'<span class="error"><br/>This field must not be empty</span>');
						return false;
				}

			}
		);
	
	$('#group_discussion_comment').focus(function() {
		$(this).removeClass('error').next('span').remove();
	});
});
