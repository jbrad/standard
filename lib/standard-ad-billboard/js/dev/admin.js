// Global variables used to track the instance of this widget's source and URL fields.
// This is necessary so that the send_to_editor function can manipulate the widget's admin
var standard_468x60_sAdSrcId, standard_468x60_sAdSrcUrl;

standard_468x60_sAdSrcId = null;
standard_468x60_sAdSrcUrl = null;

/**
 * Hides fields that are irrelevant for the media uploader.
 *
 * @params	$		A reference to the jQuery function
 * @params	poller	The polling mechanism used to look for the form fields when a user uploads an image
 */
function standard_ad_468x60_hide_unused_fields($, poller) {
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
		if($(this).hasClass('url') || $(this).hasClass('urlfield')) {

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
		$submit.val('Upload Advertisement');

		// Mark that the proper fields have been hidden
		bHasHiddenFields = true;

	} // end if

	// Clear the polling interfval
	if(poller !== null && bHasHiddenFields) {
		clearInterval(poller);
	} // end if

} // end standard_ad_468x60_hide_unused_fields

/**
 * Overrides the core send_to_editor function in the media-upload script. Grabs the URL of the image after being uploaded and
 * populates the favicon's text field with its URL.
 *
 * @params	sHtml	The HTML of the image tag from which we're setting the favicon
 */
function standard_ad_468x60_show_media_uploader() {
	"use strict";

	// Show the uploader
	tb_show('', 'media-upload.php?type=image&TB_iframe=true');

	// Save the previous handler since we're spinning up another instance
	window.restore_editor = window.send_to_editor;

	window.send_to_editor = function(sHtml) {

		// If the user has specified a link, we'll grab the anchor and the image source
		var sImageUrl = '';
		if(jQuery(sHtml).children('img').length > 0) {

			sImageUrl = jQuery(sHtml).children('img').attr('src');

			jQuery(standard_468x60_sAdSrcId).val(sImageUrl);
			jQuery(standard_468x60_sAdSrcUrl).val(jQuery(sHtml).attr('href'));

		// Otherwise, we'll just grab the image
		} else {

			sImageUrl = jQuery(sHtml).attr('src');
			jQuery(standard_468x60_sAdSrcId).val(jQuery(sHtml).attr('src'));

		} // end if

		// Display the image in the admin area
		jQuery(standard_468x60_sAdSrcId).parent()
			.children('.preview_image_container')
			.children('.preview_image')
			.attr('src', sImageUrl)
			.show();

		// Hide the upload anchor, show the delete anchor
		jQuery(standard_468x60_sAdSrcId).siblings('.ad_delete')
			.show();

		// Hide the thickbox
		tb_remove();

		// Restore the previous editor handler
		window.send_to_editor = window.restore_editor;

	}; // end window.send_to_editor

} // end standard_ad_468x60_show_media_uploader

/**
 * Attaches event handlers for Standard's 468x60 advertisement widget administration
 * panel.
 */
function standard_ad_468x60($) {
	"use strict";

	// Display the uploader when the anchor is clicked
	// We have to unbind previous click events in case someone adds multiple instances of this widget
	$('.standard-ad-468x60-wrapper > .preview_image_container').unbind('click')
		.click(function(evt) {

		evt.preventDefault();

		// Identify the input fields for this image and anchor
		$(this).siblings('.widget-parent-id').val($(this).parents('.widget').attr('id'));
		var sId = $(this).siblings('.widget-parent-id').val();

		// If sId is empty, then we're in accessibility mode.
		if( '' === sId ) {

			standard_468x60_sAdSrcId = '#' + $('.ad_src').attr('id');
			standard_468x60_sAdSrcUrl = '#' + $('.ad_url').attr('id');

		// Otherwise, we're running in normal mode.
		} else {

			standard_468x60_sAdSrcId = '#' + $('#' + sId + ' .widget-content .standard-ad-468x60-wrapper').children('.ad_src').attr('id');
			standard_468x60_sAdSrcUrl = '#' + $('#' + sId + ' .widget-content .standard-ad-468x60-wrapper').children('.ad_url').attr('id');

		} // end if/else

		// Show the media uploader
		standard_ad_468x60_show_media_uploader();
		$('#TB_iframeContent').load(function() {

			// if the user is uploading a new ad, we need to poll until we see the form fields
			var ad_468x60_poll = setInterval(function() {
				if($('#TB_iframeContent').contents().find('#media-items').children().length > 0) {
					standard_ad_468x60_hide_unused_fields($, ad_468x60_poll);
				} // end if
			}, 500);

			// if they aren't uploading, we'll clear the fields on load
			standard_ad_468x60_hide_unused_fields($);

		});

	});

	// Delete the adveritsement and clear the input fields when the delete anchor is clicked
	$('.standard-ad-468x60-wrapper > .ad_delete').click(function(evt) {

		$(this).siblings('.preview_image_container').children('img').hide();
		$(this).siblings('input').val('');
		$(this).hide();

	});

} // end standard_ad_468x60

(function($) {
	"use strict";
	// Attach event handlers on initial page load
	$(function() {
		standard_ad_468x60($);
	});

	// If the 468x60 widget is being activated, we need to setup the event handlers again
	$(document).ajaxSuccess(function(e, xhr, settings) {

		var sWidgetName = 'standard-ad-468x60';

		// Make sure that we only attach handlers when we aren't deleting widgets
		if(settings !== undefined && settings.data !== undefined) {
			if(settings.data.search(sWidgetName) !== -1 && settings.data.search('id_base=' + sWidgetName) !== -1 && settings.data.search('delete_widget') === -1) {
				standard_ad_468x60($);
			} // end if
		} // end if

	});

}(jQuery));