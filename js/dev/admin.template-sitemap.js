/**
 * Scans the JavaScript sources on the page to determine which page is using the sitemap template.
 * 
 * $		The jQuery function
 * returns	The ID of the page serving as the sitemap
 */
function sitemapPageID($) {
	"use strict";
	
	var i, l, iSiteMapID, aQueryVars, aKeyVal;
	iSiteMapID = -1;
	
	$('script').each(function() {

		if($(this).attr('src') && $(this).attr('src').indexOf('admin.min.js') > 0) {
			
			aQueryVars = $(this).attr('src').split('?');
			for(i = 0; i < aQueryVars.length; i++) {

				aKeyVal = aQueryVars[i].split('&');
				aKeyVal = aKeyVal[0].split('=');

				if(aKeyVal[1] !== undefined && aKeyVal[1].length > 0 && "using_sitemap" === aKeyVal[0]) {
					iSiteMapID = parseInt(aKeyVal[1], 10);
				} // end if
				
			} // end for

		} // end if
	});

	return iSiteMapID;

} // end findSitemapPageID

/**
 * Removes the post editor if the user selects the Sitemap template.
 * 
 * $		The jQuery function
 */
function togglePostBodyContent($) {
	"use strict";
	if($('#page_template').children(':selected').text().toLowerCase() === 'sitemap') {
					
		$('#post-body-content').children(':not(#titlediv)')
			.css('visibility', 'hidden');
			
	} else {
	
		$('#post-body-content').children(':not(#titlediv)')
			.css('visibility', 'visible');
		
	} // end if/else

} // end togglePostBodyContent

(function($) {
	"use strict";
	$(function () {

		// For 'All Pages'
		if($('select[name=page_template]').length > 0 && $('#page_template').length === 0) {

			// First, disable all of the options for the sitemap
			if(sitemapPageID($) > -1) {
				$('option[value="template-sitemap.php"]').attr('disabled', 'disabled');
			} // end if

			// Next, make sure that toggle ability based on the 'Quick Edit' options
			$('select[name=page_template]').change(function() {

				if($('option:selected[value="template-sitemap.php"]').length > 0) {
					$('option[value="template-sitemap.php"]').attr('disabled', 'disabled');	
				} else {
					$('option[value="template-sitemap.php"]').removeAttr('disabled');
				} // end if/else

			});

		} // end if
	
		// For 'Post Editor'
		if($('select[name="page_template"]').length > 0 && $('#page_template').length > 0 && sitemapPageID($) > -1) {

			// Disable the sitemap option there's already a sitemap
			$('#page_template').children('option')
				.each(function() {
					if($(this).val() === 'template-sitemap.php') {
						$(this).attr('disabled', 'disabled');
					} // end if
				});
				
			// Toggle Editor visibility if the sitemap is selected			
			togglePostBodyContent($);
			
			$('#page_template').change(function() {
				togglePostBodyContent($);
			});
			
		} // end if
		
	});
}(jQuery));