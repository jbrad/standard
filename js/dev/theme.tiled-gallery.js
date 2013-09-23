function sizeGallery( $ ) {
	"use strict";
	
	// If the browser is IE and tiled galleries exist
	if( $.browser.msie && 0 < $('.tiled-gallery-item').length ) {
	
		$('.tiled-gallery-item > a > img').css({
		
			float:	'left',
			width:	'auto'
			
		});
		
	} // end if
	
} // end sizeGallery

(function($) {
	"use strict";
	
	// First, set margins under the tiled gallery as soon as the DOM is ready
	$(function() {
	
		if( 0 < $('.gallery-row').length ) {
		
			$('.gallery-row')
				.parent()
				.css('margin-bottom', '20px');
				
		} // end if
		
		sizeGallery( $ );
		
	});

	// Next, wait for the window to load, then apply CSS to the tiled galleries for IE8
	$(window)
		.load(function() {
			sizeGallery($);
		})
		.scroll(function() { 
			sizeGallery( $ ); 
		})
		.resize(function() { 
			sizeGallery( $ ); 
		});
	
}(jQuery));