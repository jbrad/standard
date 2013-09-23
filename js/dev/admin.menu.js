(function ($) {
	"use strict";
	$(function () {
	
		// Hide the 'Standard' item under the custom menu
		$('.wp-submenu-head:contains("Standard")')
			.next()
			.children(':first')
			.hide();
			
		// Mark the proper list item as active
		var aActiveTab, sActiveTab;
		
		aActiveTab = document.location.href.split('tab=');
		if(aActiveTab !== undefined && aActiveTab !== null && aActiveTab.length > 1) {
		
			sActiveTab = aActiveTab[1];

			// Global
			if(sActiveTab.indexOf('_global_') > 0) {
				$('a:contains("Global")').parent().addClass('current');
			} // end if
			
			// Presentation
			if(sActiveTab.indexOf('_presentation_') > 0) {
				$('a:contains("Presentation")').parent().addClass('current');
			} // end if
			
			// Social
			if(sActiveTab.indexOf('_social_') > 0) {
				$('a:contains("Social")').parent().addClass('current');
			} // end if
			
			// Presentation
			if(sActiveTab.indexOf('_publishing_') > 0) {
				$('a:contains("Publishing")').parent().addClass('current');
			} // end if
	
		} else {

			// If they click the top-level menu item, we'll default to Global
			/* Translators: This will need to be localized. */
			if($('a.wp-menu-open').text().toLowerCase() === 'standard') {
				$('a:contains("Global")').parent().addClass('current');
			} // end if

		} // end if
	
	});
}(jQuery));