/**
 * Checks to see if the recommended number of icons are active. If so, displays a warning message.
 */
function checkForMaxIcons() {
	"use strict";
	
	// If the user has seven icons, we need to disable sorting.
	if(jQuery('#active-icon-list').children().length >= 7) {		
		jQuery('#social-icon-max').removeClass('hidden');	
	} else {
		jQuery('#social-icon-max').addClass('hidden');
	} // end if
	
} // end checkForMaxIcons 

/**
 * Updates the input field of active icons.
 *
 * @params	$	A reference to the jQuery function
 */
function updateActiveIcons($) {
	"use strict";
	
	var sActiveIcons = '';
	$('#active-icons ul').children('li')
		.each(function() {
			if($(this).children().length > 0) {
			
				// Set the image's src and url
				if($(this).children('img').attr('src').length > 0) {
				
					sActiveIcons += $(this).children('img').attr('src');
					
					if($(this).attr('data-url') !== undefined && $(this).attr('data-url') !== null) {
						sActiveIcons += '|' + $(this).attr('data-url');
					} // end if
					
					sActiveIcons += ';';
					
				} // end if
				
			} // end if
		});
		
	$('#active-social-icons').val(sActiveIcons);

} // end updateActiveIcons

/**
 * Updates the list of active icons and available icons. Fired when sorting has been completed.
 */
function updateIconValues(evt) {
	"use strict";
	
	// Only cancel the icon setting URL if this function was triggered by an element
	if(evt !== undefined && !jQuery('#active-icon-url').hasClass('hidden')) {
		cancelSettingIconURL(jQuery);
	} // end if

	// Update the inputs to track the active icon arrangement.	
	updateActiveIcons(jQuery);
	
	// Update the inputs to track the available icon arrangement.
	updateAvailableIcons(jQuery);

	// Clear the drag and drop border
	jQuery(this).css('border', '0');
	
	jQuery.post(ajaxurl, {
	
		action: 'standard_save_social_icons',
		nonce: jQuery('#standard-save-social-icons-nonce').text(),
		availableSocialIcons: jQuery('#available-social-icons').val(),
		activeSocialIcons: jQuery('#active-social-icons').val(),
		updateSocialIcons: 'true'
		
	}, function(response) {
	
		if( parseInt(response, 10) === 0 ) {

			jQuery('#active-icon-list > li').each(function() {
				
				var bIsNowActive = evt === undefined ? false : jQuery(evt.srcElement).parents('ul').attr('id') === 'active-icon-list';
				setupIconClickHander(jQuery, jQuery(this), bIsNowActive);
				
			});
			
		} // end if
		
	});
	
	checkForMaxIcons();

} // end updateIconValues

/**
 * Resets the social media icon URL form, hides it, and unselects the active icon.
 * 
 * @params	$		The jQuery function
 */
function cancelSettingIconURL($) {
	"use strict";
	
	// Empty the URL field and hide the container
	$('#social-icon-url').siblings('input[type=text]:first').val('');
	$('#active-icon-url').addClass('hidden');
	
	// Remove the active status from the selected social icon
	$('.active-icon').removeClass('active-icon');
	
	updateIconValues();
	
} // end cancelSettingIconValues


/**
 * Helper function that's fired when the user clicks 'Done' or hits 'Enter'
 * when working to save their social icons.
 *
 * @params	$	A reference to the jQuery functioin
 * @params	evt	The source event of this handler
 */
function saveIconUrl($, evt) {
	"use strict";
	
	evt.preventDefault();

	if( $.trim($('#social-icon-url').val()).length > 0 ) {
	
		// Set the list item's URL
		var sUrl = $('#social-icon-url').val();	
		$('li.active-icon').attr('data-url', sUrl);
		
		// Clear out the input
		$('#social-icon-url').val('');
		
		// Hide the container
		$('#active-icon-url').addClass('hidden');
		
		// Remove active icons
		$('.active-icon').removeClass('active-icon');
		
		// Update the data
		updateIconValues();
		
		// Update the icons
		updateActiveIcons($);
	
	} else {
	
		// Hide the container
		$('#active-icon-url').addClass('hidden');
		
		// Remove active icons
		$('.active-icon').removeClass('active-icon');
		
	} // end if
	
	$('.icon-url').val('');
	
} // end if

/**
 * Sets up the icon media uploader to render with limited fields when the upload button
 * has been clicked.
 *
 * @params	$	A reference to the jQuery function
 */
function prepareIconMediaUploader($) {
	"use strict";
	
	// Setup the media uploader for this button
	$('#upload-social-icon').click(function(evt) {
		
		evt.preventDefault();
		
		socialIconsShowMediaUploader($);
		$('#TB_iframeContent').load(function() {
	
			// if the user is uplaoding a new icon, we need to poll until we see the form fields
			var mediaPoll = setInterval(function() {
				if($('#TB_iframeContent').contents().find('#media-items').children().length > 0) {
					socialOptionsHideUnusedFields($, mediaPoll);
				}  // end if
			}, 500);
	
			// if they aren't uplaoding, we'll clear the fields on load
			socialOptionsHideUnusedFields($);
			
		});
	
	});

} // end prepareIconMediaUploader

/**
 * Sets up the icon media uploader to render with limited fields when the upload button
 * has been clicked.
 *
 * @params		$				A reference to the jQuery function
 * @params		sInputId		A reference to the input field that contains the icons to display
 * @params		sWrapperId		A reference to the container that will contain the list of icons.
 */
function displayIcons($, sInputId, sWrapperId) {
	"use strict";
	
	var aIconSrc, aIconUrl, sUrl, sSrc, $listItem, $socialIcon;
	
	if($('#' + sInputId).length > 0) {

		// Clear out the existing list
		$('#' + sWrapperId + ' > ul').children('li').remove();
	
		// Rebuild the list based on the available icons
		aIconSrc = $('#' + sInputId).val().split(';');
		$(aIconSrc).each(function() {
		
			if( this.length > 0) {
	
				// Look to see if there are URL's
				aIconUrl = this.split('|');
				sUrl = null;
				sSrc = null;
				if(aIconUrl.length === 1) {
					sSrc = aIconUrl[0];
				} else {
					sSrc = aIconUrl[0];
					sUrl = aIconUrl[1];
				} // end if
	
				// Create the image
				$socialIcon = $('<img />').attr('src', sSrc);
				
				// Create a list item from the image
				$listItem = $('<li />').attr('data-url', sUrl).append($socialIcon);
				
				// If we're active icons, let's setup click handlers
				if(sWrapperId === 'active-icons') {
					setupIconClickHander($, $listItem);
				} // end if 
				
				// Append it to the list of available icons
				$('#' + sWrapperId)
					.children('ul')
					.append($listItem);
				
			} // end if 
			
		});
	
	} // end if 

} // end displayIcons

/**
 * Adds a border around an element that is about to receive an icon.
 */
function overHandler() {
	"use strict";

	jQuery(this).css('border', '1px dashed #ccc');

} // end overHandler

/**
 * Enables sorting for the social icon containers.
 *
 * @params		$				A reference to the jQuery function
 * @params		sActiveId		A reference to the container of the active icons
 * @params		sWrapperId		A reference to the container of the available icons
 */
function makeSortable($, sActiveId, sAvailableId) {
	"use strict";
	
	$(sActiveId).children('ul').sortable({
		connectWith: sAvailableId + ' > ul',
		update: updateIconValues,
		over: overHandler
	});
	
	$(sAvailableId).children('ul').sortable({
		connectWith: sActiveId + ' > ul',
		update: updateIconValues,
		over: overHandler
	});

} // end makeSortable

/**
 * Attachs a click handler to the incoming element.
 * 
 * @params	$		The jQuery function
 * @params	$this	The element on which to attach the handler
 */
function setupIconClickHander($, $this, bIsNowActive) {
	"use strict";
	
	$this.click(function(evt) {
		
		var sRssUrl = '';
		if($(evt.srcElement).attr('src') !== '' && $(evt.srcElement).attr('src') !== undefined) {
			if($(evt.srcElement).attr('src').toString().indexOf('rss.png') > 0) {
				sRssUrl = $('#standard-wordpress-rss-url').text();
			} // end if
		} // end if
			
		// if the input is visible, clear it out; otherwise, show it.
		if($('#active-icon-url').is(':visible')) {
		
			$(this).parent()
				.siblings('#active-icon-url')
				.children('input[type=text]')
				.val('');
		
		} else {
		
			$(this).parent()
				.siblings('#active-icon-url')
				.removeClass('hidden');

		} // end if/else
		
		$(this).parent()
			.siblings('#active-icon-url')
			.children('input[type=text]')
			.val($(this).attr('data-url'));
		
		// Update the active icon that we're editing
		$('.active-icon').removeClass('active-icon');
		$(this).addClass('active-icon');
		
		updateIconValues();
		makeSortable($, '#active-icons', '#available-icons');
		
		// If we're looking at the RSS feed icon, disable the input
		// and link the user to the Global options for where to set it.
		if('' !== sRssUrl) {
		
			$('#social-icon-url').val(sRssUrl).attr('disabled', 'disabled');
			$('#social-rss-icon-controls').removeClass('hidden');
			$('#social-icon-controls').addClass('hidden');
			
		} else {
		
			$('#social-icon-url').removeAttr('disabled');
			$('#social-icon-controls').removeClass('hidden');
			$('#social-rss-icon-controls').addClass('hidden');
			
		} // end if
				
	});

} // end setupIconClickHander

/**
 * Updates the input field of available icons.
 *
 * @params	$	A reference to the jQuery function
 */
function updateAvailableIcons($) {
	"use strict";
	
	var sAvailableIcons = '';
	$('#available-icons ul').children('li').each(function() {
		if($(this).children('img').length > 0 && $(this).children('img').attr('src').length > 0) {
			sAvailableIcons += $(this).children('img').attr('src') + ';';
		} // end if
	});
	$('#available-social-icons').val(sAvailableIcons);

} // end updateAvailableIcons

/**
 * Makes it possible to delete icons via shortcuts or dragging to the appropropriate area.
 *
 * @params	$	A reference to the jQuery function
 */
function makeIconsRemoveable($) {
	"use strict";
	
	// Drag and drop delete ala widgets
	$('#delete-icons').droppable({
		
		over: overHandler, 
		
		drop: function(evt, ui) {
		
			// Set the srcElement based on which browser (ui.draggable is for Firefox)
			evt.srcElement = evt.srcElement || ui.draggable.children(':first');

			// Don't let users delete the core set of icons
			if(isStandardIcon($(evt.srcElement))) { 
			
				$.post(ajaxurl, {
				
					action: 'standard_delete_social_icons',
					nonce: $.trim($('#standard-delete-social-icon-nonce').text())
					
				}, function(response) {
					
					// Display the message only if a prior message doesn't exist
					if($('#standard-delete-social-icons').length === 0) {
						$('#message-container').append(response);
					} // end if
					
					$('#standard-hide-delete-social-icon-message').click(function(evt) {
					
						evt.preventDefault();
						$('#standard-delete-social-icons').remove();
						
					});
					
				});
			
			} else {

				$(evt.srcElement).hide().attr('src', '');
				$(evt.srcElement).parent().hide();
	
				updateIconValues();
	
				updateAvailableIcons($);
	
				$(this).css('border', 0);
			
			} // end if

		} // end drop
		
	});
	
	// Delete shortcut ala OS X. Kind of an easter egg :)
	$('#available-icons > ul > li').click(function() {
		
		// Maintain a reference to the icon we're removing
		var $icon = $(this).children('img');
		
		// Look for the delete shortcut
		$(window).keydown(function(evt) {
		
			if(evt.keyCode === 93) {
			
				$(window).keydown(function(evt) {
				
					if(evt.keyCode === 8) {
						
						// Hide the icon and remove it's source attribute
						$icon.hide().attr('src', '');
	
						updateAvailableIcons($);
	
						$(window).unbind(evt);
						
					} // end if
					
				});
				
			} // end if
			
		});
		
	});

} // end makeIconsRemoveable

/**
 * Hides fields that are irrelevant for the media uploader.
 *
 * @params	$		A reference to the jQuery function
 * @params	poller	The polling mechanism used to look for the form fields when a user uploads an image	
 */
function socialOptionsHideUnusedFields($, poller) {
	"use strict";
	
	var bHasHiddenFormFields, $formFields, $submit;
	
	// Hide the 'From URL' tabs
	$( '#tab-type_url', $('#TB_iframeContent')[0].contentWindow.document ).hide();

	// Hide unnecessary fields
	bHasHiddenFormFields = false;
	$formFields = $('.describe tbody tr, .savebutton', $('#TB_iframeContent')[0].contentWindow.document);
	$formFields.each(function() {
	
		// Remove everything except the URL field
		if(!($(this).hasClass('submit'))) {
			$(this).hide();
		} // end if
		
	});
	
	// Change the text of the submit button		
	$submit = $('.savesend input[type="submit"]', $('#TB_iframeContent')[0].contentWindow.document);
	if($submit.length > 0 && $submit !== null) {
	
		/* Translators: This will need to be localized. */
		$submit.val('Upload Social Icon');
		
		bHasHiddenFormFields = true;
		
	} // end if
	
	if( poller !== null && bHasHiddenFormFields) {
		clearInterval(poller);
	} // end if

} // end hideUnusedFields

/**
 * Determines if the specified image is part of the Standard icon library.
 *
 * @params	img	The image element being evaluated
 *
 * @returns		True if the image belongs in the core set of Standard icons.
 */
function isStandardIcon($img) {
	"use strict";
	
	return $img.attr('src').toString().indexOf('/images/social/small/') > 0;	
	
} // end isStandardIcon

/**
 * Overrides the core send_to_editor function in the media-upload script. Grabs the URL of the image after being uploaded and 
 * populates the favicon's text field with its URL.
 *
 * @params	sHtml	The HTML of the image tag from which we're setting the favicon
 */
function socialIconsShowMediaUploader() {
	"use strict";
	
	tb_show('', 'media-upload.php?type=image&TB_iframe=true');
	
	// Save the previous handler since we're spinning up another instance
	window.restore_editor = window.send_to_editor;

	window.send_to_editor = function(sHtml) {
	
		var $img = jQuery(sHtml).children('img').length === 1 ? jQuery(sHtml).children('img') : jQuery(sHtml);
	
		// Store the image's URL in the hidden field
		jQuery('#available-social-icons').val(jQuery('#available-social-icons').val() + ';' + $img.attr('src'));
		
		displayIcons(jQuery, 'available-social-icons', 'available-icons');
		updateIconValues();
	
		// Hide the thickbox
		tb_remove();
		
		// Restore the previous editor handler
		window.send_to_editor = window.restore_editor;		

	}; // end window.send_to_editor
	
} // end ad_personal_image_show_media_uploader

(function($) {
	"use strict";
	$(function() {
		
		if( 0 < $('#available-icon-list').length ) {
		
			// Hide the table of options.
			$('.social-icons-wrapper').siblings('table').hide();
			
			prepareIconMediaUploader($);
	
			// Render the avaialable icons and the active icons
			displayIcons($, 'available-social-icons', 'available-icons');
			displayIcons($, 'active-social-icons', 'active-icons');
			
			// Make the lists sortable
			makeSortable($, '#active-icons', '#available-icons');
			
			// Setup how to delete icons
			makeIconsRemoveable($);
			
			// Setup the handler for triggering the social icon url
			$('#set-social-icon-url').click(function(evt) {
				saveIconUrl($, evt);
			});
			
			// Save the input field if the user presses enter
			$(document).keypress(function(evt) {
	
				if(evt.keyCode === 13) {
					evt.preventDefault();
					saveIconUrl($, evt);
				} // end if
				
			});
			
			// Cancel entering a URL
			$('#cancel-social-icon-url').click(function(evt) {
				
				evt.preventDefault();
				cancelSettingIconURL($);
				
			});
			
			checkForMaxIcons();
			
			// Offer the ability to reset the icons
			$('#reset-social-icons').click(function(evt) {
			
				evt.preventDefault();
				
				var $this = $(this);
				$.post(ajaxurl, {
		
					action: 'standard_reset_social_icons',
					nonce: $.trim($('#standard-reset-social-icons').text())
					
				}, function() {
				
					$this.siblings('form').submit();	
					location.reload(true);
					
				});
			
			});
			
		} // end if

	});
}(jQuery));