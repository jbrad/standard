function sizeVideo() {
	"use strict";
	
	var $this;
	$this = jQuery($this);

	// Clear the current video player's style
	jQuery('.video-player').attr('style', '');

	// Update the placeholder's width so that it's 100% of the parent
	jQuery('.videopress-placeholder')
		.width('100%')
		.children(':first')
		.width('100%');

	// Update the poster size
	jQuery('.videopress-poster')
		.css('width', jQuery('.video-player').parent().width());

	// Update the actual video
	jQuery('.video-player').children()
		.css('width', jQuery('.video-player').parent().width())
		.css('margin-bottom', '0');

	// If the site is full-width, fix the float issue on the thumbnail
	if( jQuery('.fullwidth').length > 0 ) {
	
		jQuery('.videopress-poster')
			.height('100%');
			
	} // end if
	
	if( 0 < jQuery('.videopress-placeholder').length ) {
	
		jQuery('.videopress-placeholder')
			.css('margin-bottom', '0');
			
		jQuery('.videopress-placeholder')
			.children('div:last')
			.children('img')
			.css('margin-top', '-80px');
			
		jQuery('.video-player')
			.last()
			.css('margin-bottom', '0');
		
	} // end if
		
	jQuery('object')
		.attr('height', jQuery('.entry-content').height() + 'px')
		.attr('width', jQuery('.entry-content').width() + 'px');
	
	// After that, update the margins of the play button
	jQuery('.play-button')
		.next()
		.css({
			marginTop:		0,
			marginBottom:	0
		});

	// Unfortunately, there's a bug in IE8 with margins so we have update the entry content of the video player
	if(0 < jQuery('#ie8').length) {
	
		jQuery('.video-player')
			.parents('.entry-content')
			.css('margin-top', '20px');
		
	} // end if

	// If there's text after the video, set a margin
	if(0 < jQuery('.video-player').siblings().length) {
		jQuery('.video-player').css('margin-bottom', '20px');
	} // end if

} // end sizeVideo

(function($) {
	"use strict";
	$(function() {
		sizeVideo();
		$(window)
			.load(sizeVideo)
			.resize(sizeVideo);
	});
}(jQuery));