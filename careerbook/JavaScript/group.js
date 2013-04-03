$(function(){
	$('#title').blur(
			function() {
				if ($(this).val().length == 0) {
					$('#title').addClass('error').after(
						'<span class="error">This field must not be empty </span>');
				}
				return false;
			});
		$('#title').focus(function() {
			$(this).removeClass('error').next('span').remove();
		});
		$('#description').blur(
				function() {
					if ($(this).val().length == 0) {
						$('#description').addClass('error').after(
							'<span class="error">This field must not be empty </span>');
					}
					return false;
				});
			$('#description').focus(function() {
				$(this).removeClass('error').next('span').remove();
			});
});
