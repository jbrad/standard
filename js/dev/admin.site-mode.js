(function($) {
	"use strict";
	$(function () {
	
		// hide the table row if offline mode is disabled
		if($('#site_mode').val() === 'online') {
			$('#offline_message').parent()
				.parent()
				.hide();
		} // end if
		
		// toggle the offline message when the label or checkbox is clicked
		$('#site_mode').change(function() {
		
			var $parent;
			$parent = $('#offline_message').parent().parent();
			
			if($('#site_mode').val() === 'online') {
				$parent.hide();
			} else {
				$parent.show();
			} // end if/else
			
		});
		
	});
}(jQuery));