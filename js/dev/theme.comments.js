(function($) {
	"use strict";
	$(function () {
		
		var $gravatar, sDefaultImageUrl, sUrl;
		
		// Grab a reference to the gravatar container and its default image
		$gravatar = $('#comment-form-avatar').children('img');
		sDefaultImageUrl = $gravatar.attr('src');
		
		// When the focus blurs from the field, update the gravatar
		$('#email').blur(function() {
			
			if( '' === $(this).val() ) {
			
				$gravatar.attr('src', sDefaultImageUrl);
				
			} else {

				sUrl = 'http://www.gravatar.com/avatar/' + md5( $(this).val() ) + '?d=' + sDefaultImageUrl;		
				$gravatar.attr('src', sUrl);
			
			} // end if/else
			
		});
		
		// Toggles acceptable HTML tags
		if($('#allowed-tags-trigger').length > 0) {

			$('#allowed-tags-trigger').click(function(evt) {
				evt.preventDefault();
				$('#allowed-tags').fadeToggle('fast');
			});
				
		} // end if
		
	});
}(jQuery));