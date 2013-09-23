var standard_presentationPreviewImage, standard_presentationPreviewUrl;

standard_presentationPreviewImage = null;
standard_presentationPreviewUrl = null;

/**
 * Hides fields that are irrelevant for the media uploader.
 *
 * @params	$		A reference to the jQuery function
 * @params	poller	The polling mechanism used to look for the form fields when a user uploads an image	
 */
function standard_upload_hide_unused_fields($, poller) {
	"use strict";
	
	var bHasHiddenFields, $formFields, $submit; 
	
	// Hide the 'From URL' tabs
	$( '#tab-type_url', $('#TB_iframeContent')[0].contentWindow.document ).hide();

	// Hide unnecessary fields
	bHasHiddenFields = false;
	$formFields = $('.describe tbody tr, .savebutton', $('#TB_iframeContent')[0].contentWindow.document);
	$formFields.each(function() {
	
		// Remove everything except the URL field
		if(!$(this).hasClass('submit')) {
			$(this).hide();
		} // end if
		
		// Make sure that we select the 'Full Size' of the image
		if($(this).hasClass('image-size')) {
			$(this).children('.field').children().each(function() {
				if($(this).children('input[type=radio]').attr('id').indexOf('-full-') > 0) {
					$(this).children('input[type=radio]').attr('checked', 'checked');
				} // end if
			});
		} // end if

		// If we're looking at the URL field, remove the extra buttons and text
		if($(this).hasClass('url')) {
		
			var $input = $(this).children('.field').children('input');
			$input.val('');
			$input.attr('placeholder', 'http://example.com');
			$input.siblings().hide();
			
		} // end if
	
	});
	
	// Change the text of the submit button
	$submit = $('.savesend input[type="submit"]', $('#TB_iframeContent')[0].contentWindow.document);
	if($submit.length > 0 && $submit !== null) {
	
		/* Translators: This will need to be localized. */
		$submit.val('Save Image');
		
		bHasHiddenFields = true;
		
	} // end if
						
	// Clear the polling interfval
	if(poller !== null && bHasHiddenFields) {
		clearInterval(poller);
	} // end if

} // end standard_upload_hide_unused_fields

/**
 * Overrides the core send_to_editor function in the media-upload script. Grabs the URL of the image after being uploaded and 
 * populates the favicon's text field with its URL.
 *
 * @params	sHtml	The HTML of the image tag from which we're setting the favicon
 */ 
window.send_to_editor = function(sHtml) {
	"use strict";
	
	var sPreviewId, sPreviewUrlId;

	// Set the container ID for the preview image that's being uploaded
	sPreviewId = '#' + standard_presentationPreviewImage;
	sPreviewUrlId = '#' + standard_presentationPreviewUrl;

	// Grab the URL of the image and set it into the field's ID.
	// The raw class accepts a string of HTML, the other just the attribute
	if(jQuery('.media-upload-field-raw').length > 0) {
		jQuery('.media-upload-field-raw').val(sHtml);
	} else {
		jQuery(sPreviewUrlId).val(jQuery(sHtml).attr('src'));
	} // end if/else
	
	// If the preview element exists, insert the image into the preview
	if(jQuery(sPreviewId).length > 0) {

		// If there's an anchor in the markup, set a target="_blank" on it
		if(jQuery(sHtml).attr('href') !== undefined && jQuery(sHtml).attr('href') !== null) {
			jQuery(sHtml).attr('target', '_blank');
		} // end if
		
		if(jQuery('.media-upload-field-raw').length > 0) {
			jQuery(sPreviewId).html(sHtml);
		} else {
			
			jQuery(sPreviewId).attr('src', jQuery(sHtml).attr('src'));			

		} // end if/else	
		
		// Toggle the visibility of the preview and the delete button if they're hidden
		jQuery('#logo_preview_container').children('img:first').removeClass('hidden');
		jQuery('#delete_fav_icon').show();
		
	} // end if
			
	// Hide the thickbox
	tb_remove();

}; // end window.send_to_editor

(function ($) {
	"use strict";
	
	$(function() {
	
		/* --- Site Icon --- */
		
		// Display the media uploader when the 'Upload' button is clicked
		$('#upload_fav_icon').click(function() {
			
			// the element that will receive the preview image
			standard_presentationPreviewImage = 'fav_icon_preview';
			standard_presentationPreviewUrl = 'fav_icon';
			
			// Show the media uploader
			tb_show('', 'media-upload.php?type=image&TB_iframe=true');
			
			$('#TB_iframeContent').load(function() {
	
				// if the user is uploading a new icon, we need to poll until we see the form fields
				var fav_icon_poll = setInterval(function() {
					if($('#TB_iframeContent').contents().find('#media-items').children().length > 0) {
						standard_upload_hide_unused_fields($, fav_icon_poll);
					} // end if
				}, 500);
		
				// if they aren't uploading, we'll clear the fields on load
				standard_upload_hide_unused_fields($);
			
			});
			
			// Show the site icon if it's hidden
			$('#fav_icon_preview').show();
				
		});
		
		// Remove the URL of the fav icon
		$('#delete_fav_icon').click(function() {
			$('#fav_icon_preview').attr('src', '');
			$('#fav_icon').val('');
			$('#fav_icon_preview_container').children('img').hide();
			$(this).hide();
		});
		
		/* --- Logo --- */
		
		// Display the media uploader when the 'Upload' button is clicked
		$('#upload_logo').click(function() {
			
			// the element that will receive the preview image
			standard_presentationPreviewImage = 'logo_preview';
			standard_presentationPreviewUrl = 'logo';
			
			// Show the media uploader
			tb_show('', 'media-upload.php?type=image&TB_iframe=true');
			
			$('#TB_iframeContent').load(function() {
	
				// if the user is uploading a new logo, we need to poll until we see the form fields
				var logo_poll = setInterval(function() {
					if($('#TB_iframeContent').contents().find('#media-items').children().length > 0) {
						standard_upload_hide_unused_fields($, logo_poll);
					} // end if
				}, 500);
		
				// if they aren't uploading, we'll clear the fields on load
				standard_upload_hide_unused_fields($);

			});
				
		});
		
		// Remove the URL of the fav icon
		$('#delete_logo').click(function() {
			$('#logo').val('');
			$('#logo_preview_container').children('img:first').addClass('hidden');
			$(this).hide();
		});
	
	});
}(jQuery));