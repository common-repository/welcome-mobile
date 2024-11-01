(function( $ ) {
	'use strict';

	var cookieExpiration;
	var messageDuration;
	var Cookies2 = Cookies.noConflict();

	if($('.welcome-message').data('cookie') == '') {
		cookieExpiration = 20;
	} else {
		cookieExpiration = $('.welcome-message').data('cookie');
	}

	$('.welcome-message i.icon-cancel').click(function(){
		Cookies2.set("wm_cookie", 'true', { expires: cookieExpiration});
		$('.welcome-message').remove();
	});

	if ($('.welcome-message').data('duration')) {
		messageDuration = $('.welcome-message').data('duration');
		messageDuration = messageDuration * 1000;
		$(".welcome-message").delay(messageDuration).fadeOut("slow");
	}

})( jQuery );
