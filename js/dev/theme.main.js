/*global infiniteScroll */
/*global md5 */

/**
 * In mobile view with the left-sidebar layout, repositions the sidebar below the content.
 */
function moveSidebarInLeftSidebarLayout($) {
	"use strict";
	
	if($('#wrapper').width() < 768) {
		$('#sidebar').insertAfter('#main');
	} else {
		$('#sidebar').insertBefore('#main');
	} // end if

} // end moveSidebarInLeftSidebarLayout

/**
 * Resizes the videos on page load, when the browser is resized,
 * and when Infinite Scroll is activated.
 */
function resizeVideos($) {
	"use strict";
	
	// FitVid
	$('.entry-content, .comment-text').fitVids();
	
	// Look to see if there are any video wrappers from FitVid
	if(0 < $('.fluid-width-video-wrapper').length) { 

		// For each video wrapper, we only want to change the styles if the video is posted alone (without text)
		$('.fluid-width-video-wrapper').each(function() {
			
			// First, clear the margin on the video itself
			$(this).css('margin', 0);
			
			// Next, if the video is the only content, we can remove both margin and padding
			if(0 === $(this).parents('p').siblings().length) {
			
				$(this)
					.parents('p')
					.css({ margin: 0, padding: 0 });
					
			} // end if
			
		});
	
	} // end if
	
} // end resizeVideos

/* ---------------------------------------------------------------- *
 * Post-page load functionality
 * ---------------------------------------------------------------- */

(function($) {
	"use strict";
	$(function() {

		var iHeaderHeight, iWidgetHeight, iMargin, bCmdDown;
		
		// Properly position the header widget, but only do so after the window is loaded
		if( 1 === $('.header-widget').length && 1 === $('#logo').length ) {
		
			$(window).load(function() {
								
				// Get the header and the widget heights
				iHeaderHeight = parseInt($('#hgroup').height(), 10);
				iWidgetHeight = parseInt($('.header-widget').height(), 10);
				
				// Calculate the margins based on the size of the header and the widget
				if(iHeaderHeight > iWidgetHeight) {
					iMargin = ( iHeaderHeight / 2 ) - ( iWidgetHeight / 2 );
				} else {
					iMargin = ( iWidgetHeight / 2 ) - ( iHeaderHeight / 2 );
				} // end if/else
				
				$('.header-widget').css('margin-top', iMargin);
					
			});
			
		} // end if

		// If the Activity Widget is present, activate the first tab
		if($('.tabbed-widget').length > 0) { 
			
			$('.nav-tabs').children('li:first')
				.addClass('active');
				
			$('.tab-content').children('.tab-pane:first')
				.addClass('active');
			
		} // end if
		
		// Hide pagination controls if infiniteScroll is on
		if( 'object' === typeof infiniteScroll ) {
			$('#post-nav').hide();
		} // end if
		
		// Introduce responsive functionality but only if the CSS is loaded
		if($('link[id*="bootstrap-responsive-css"]').length > 0) {
		
			// Move sidebar below content on left sidebar layout
			if($('#sidebar').length > 0 && $('#wrapper > .container > .row').children(':first').attr('id') === 'sidebar') {
			
				moveSidebarInLeftSidebarLayout($);
				$(window).resize(function() {
					moveSidebarInLeftSidebarLayout($);
				});
			
			} // end if

			// Resize videos properly
			resizeVideos($);

			// If there is no content below the link container, then kill the margin
			if(0 === $('.format-link .entry-content').children('p').length) {
				$('.format-link .entry-content').css({
					marginTop: 0,
					paddingBottom: 0
				});
			} // end if

		} // end if
		
		// Bootstrap Multi-Level Menus
		$('.submenu').hover(function() {
	
			// Display the submenu on hover
			$(this).children('ul')
	        	.removeClass('submenu-hide')
	        	.addClass('submenu-show');
	
	    }, function() {
		
		    // Hide the submenu when not on hover
		    $(this).children('ul')	
				.removeClass('.submenu-show')
				.addClass('submenu-hide');
			
		});
		
		// Detect whether or not cmd or ctrl are being clicked so we can properly open tabs in new windows
		bCmdDown = false;
		$(document).on( 'keydown', function(evt) {
			bCmdDown = ( 91 === evt.keyCode || 93 === evt.keyCode || 62 === evt.keyCode ) ? true : false;
		}).on( 'keyup', function(evt) {
			bCmdDown = false;
		});
		
		$('.menu-item > a').click(function(evt) {
			
			evt.preventDefault();
			
			if( '_blank' === $(this).attr('target') || bCmdDown ) {
				window.open( $(this).attr('href') );
			} else {
				window.location = $(this).attr('href');
			} // end if/else
			
		});
		
	});
}(jQuery));