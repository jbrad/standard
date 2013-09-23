(function($) {
	"use strict";
	$(function() {

		// If we're on the search results page editor screen...
		if( $('#postdivrich').length > 0 && $('#editable-post-name').text().toLowerCase() === 'search-results') {

			// Hide the editor
			$('#postdivrich').hide();

			// Hide the editor and meta boxes
			$('.postbox-container:last').hide();

			// Hide everything but the publish area
			$('.postbox:not(:first)').hide();

		} // end if

	});
}(jQuery));