(function($) {
	"use strict";
	$(function () {
		
		if($('#standard-hide-seo-message').length > 0) {
		
			$('#standard-hide-seo-message').click(function(evt) {

				evt.preventDefault();
				
				$.post(ajaxurl, {
				
					action: 'standard_save_wordpress_seo_message_setting',
					nonce: $.trim($('#standard-hide-seo-message-nonce').text()),
					hideSeoNotification: 'true'
					
				}, function(response) {

					if(parseInt(response, 10) === 0) {
						$('#standard-hide-seo-message-notification').hide();
					} // end if
					
				});
				
			});
		
		} // end if
		
	});
}(jQuery));