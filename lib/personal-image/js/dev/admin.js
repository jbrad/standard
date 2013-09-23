// Global variables used to track the instance of this widget's source and URL fields.
// This is necessary so that the send_to_editor function can manipulate the widget's admin
var standard_personal_image_url, standard_personal_image_src;
standard_personal_image_url = null;
standard_personal_image_src = null;

/**
 * Hides fields that are irrelevant for the media uploader.
 *
 * @params	$		A reference to the jQuery function
 * @params	poller	The polling mechanism used to look for the form fields when a user uploads an image
 */
function standard_personal_image_hide_unused_fields($, poller) {
	"use strict";

	var bHasHiddenFields, $formFields, $submit;

	// Hide the 'From URL' tabs
	$( '#tab-type_url', $('#TB_iframeContent')[0].contentWindow.document ).hide();

	// Hide unnecessary fields
	bHasHiddenFields = false;
	$formFields = $('.describe tbody tr, .savebutton', $('#TB_iframeContent')[0].contentWindow.document);

	$formFields.each(function() {

		// Remove everything except the URL field
		if(!($(this).hasClass('submit') || $(this).hasClass('url'))) {
			$(this).hide();
		} // end if

		// Make sure we're selecting the maximum size image
		if($(this).hasClass('image-size')) {
			$(this).children('.field')
				.children('.image-size-item:last')
				.children('input').attr('checked', 'checked');
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
		$submit.val('Upload Image');

		bHasHiddenFields = true;

	} // end if

	// Clear the polling interfval
	if(poller !== null && bHasHiddenFields) {
		clearInterval(poller);
	} // end if

} // end standard_personal_image_hide_unused_fields

/**
 * Attaches event handlers for Standard's Personal Image widget administration
 * panel.
 */
function standard_personal_image($) {
	"use strict";
	// Setup the character counter - we have to do it for each widget on the admin page because of how
	// WordPress manages this on the dashboard.
	$('.bio textarea').each(function() {

		var $span;
		$span = $(this).next().children('span');

		// Update the counter on load
		$span.text( 400 - parseInt($(this).val().length, 10 ) );

		// Update the counter when typing
		$(this).keyup(function() {
			$span.text( 400 - parseInt($(this).val().length, 10 ) );
		});

	});
	/*
	$('.bio textarea').keyup(function() {
		$(this).next().children('span').text( 400 - parseInt($(this).val().length));
	});
	*/

	// Display the uploader when the anchor is clicked.
	// We have to unbind previous click events in case someone adds multiple instances of this widget
	$('.standard-personal-image-wrapper .option .personal_image_preview_image_container').unbind('click')
		.click(function(evt) {

		evt.preventDefault();

		// Identify the input fields for this image and anchor
		standard_personal_image_url = '#' + $(this).siblings('.img_url').attr('id');
		standard_personal_image_src = '#' + $(this).siblings('.img_src').attr('id');

		// Show the media uploader
		personal_image_show_media_uploader();
		$('#TB_iframeContent').load(function() {

			// if the user is uploading a new personal image, we need to poll until we see the form fields
			var personal_image_poll = setInterval(function() {
				if($('#TB_iframeContent').contents().find('#media-items').children().length > 0) {
					standard_personal_image_hide_unused_fields($, personal_image_poll);
				} // end if
			}, 500);

			// if they aren't uplaoding, we'll clear the fields on load
			standard_personal_image_hide_unused_fields($);
		});

	});

	// Delete the adveritsement and clear the input fields when the delete anchor is clicked
	$('.standard-personal-image-wrapper .option .img_delete').click(function(evt) {

		// Reset the hidden field and hide the preview image
		$(this).siblings('.img_url').val('');
		$(this).siblings('.img_src').val('');
		$(this).siblings('.personal_image_preview_image_container').children('img').attr('src', $(this).next().val());

		// Hide the delete link, show the upload link
		$(this).hide();

	});

} // end standard_personal_image

/**
 * Overrides the core send_to_editor function in the media-upload script. Grabs the URL of the image after being uploaded and
 * populates the favicon's text field with its URL.
 *
 * @params	sHtml	The HTML of the image tag from which we're setting the favicon
 */
function personal_image_show_media_uploader() {
	"use strict";

	tb_show('', 'media-upload.php?type=image&TB_iframe=true');

	// Save the previous handler since we're spinning up another instance
	window.restore_editor = window.send_to_editor;

	window.send_to_editor = function(sHtml) {

		var sImageUrl = '';
		if(jQuery(sHtml).children('img').length === 1) {

			sImageUrl = jQuery(sHtml).children('img').attr('src');

			jQuery(standard_personal_image_src).val(sImageUrl);
			jQuery(standard_personal_image_url).val(jQuery(sHtml).attr('href'));

		} else {

			sImageUrl = jQuery(sHtml).attr('src');
			jQuery(standard_personal_image_src).val(jQuery(sHtml).attr('src'));

		} // end if/else

		// Display the image in the admin area
		jQuery(standard_personal_image_src).siblings('.personal_image_preview_image_container').children('img').attr('src', sImageUrl).show();

		// Hide the upload anchor, show the delete anchor
		jQuery(standard_personal_image_src).siblings('.img_upload').hide();
		jQuery(standard_personal_image_src).siblings('.img_delete').show();

		// Hide the thickbox
		tb_remove();

		// Restore the previous editor handler
		window.send_to_editor = window.restore_editor;

	}; // end window.send_to_editor

} // end ad_personal_image_show_media_uploader


(function($) {
	"use strict";
	// Attach event handlers on initial page load
	$(function() {
		standard_personal_image($);
	});

	// If the Personal Image widget is being activated, we need to setup the event handlers again
	$(document).ajaxSuccess(function(e, xhr, settings) {

		var sWidgetName = 'standard-personal-image';

		// Make sure that we only attach handlers when we aren't deleting widgets
		if(settings !== undefined && settings.data !== undefined) {
			if(settings.data.search(sWidgetName) !== -1 && settings.data.search('id_base=' + sWidgetName) !== -1 && settings.data.search('delete_widget') === -1) {
				standard_personal_image($);
			} // end if
		} // end if

	});

}(jQuery));