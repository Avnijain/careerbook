
$('add_group_form').submit(
	function() {
		alert("aa");
		if ($(this).val().length == 0) {
			$(this).addClass('error').after(
				'<span class="error">This field must … </span>');
		}
	});
$(':input').focus(function() {
	$(this).removeClass('error').next('span').remove();
});