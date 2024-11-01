(function( $ ) {
	'use strict';

	var $this;

	function default_welcome_message() {
		$this = $("input[name=welcome_mobile_use_default]:checked");
		if ($("input[name=welcome_mobile_use_default]:checked").val() == 'yes') {
			$($this).parents('tr').next('tr').show();
			$($this).parents('tr').siblings().eq($($this).parents('tr').index()+1).hide();
			$($this).parents('tr').siblings().eq($($this).parents('tr').index()+2).hide();
		} else {
			$($this).parents('tr').next('tr').hide();
			$($this).parents('tr').siblings().eq($($this).parents('tr').index()+1).show();
			$($this).parents('tr').siblings().eq($($this).parents('tr').index()+2).show();
		}
	}

	default_welcome_message();

	$("input[name=welcome_mobile_use_default]").on('change', function(){
		default_welcome_message();
	});

	function close_button() {
		$this = $("input[name=welcome_mobile_close_button]:checked");
		if ($("input[name=welcome_mobile_close_button]:checked").val() == 'yes') {
			$($this).parents('tr').next('tr').hide();
		} else {
			$($this).parents('tr').next('tr').show();
		}
	}

	close_button();

	$("input[name=welcome_mobile_close_button]").on('change', function(){
		close_button();
	});

})( jQuery );
