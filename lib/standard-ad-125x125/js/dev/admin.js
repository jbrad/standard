// Global variables used to track the instance of this widget's source and URL fields.
// This is necessary so that the send_to_editor function can manipulate the widget's admin
var standard_125x125_sAdSrcId, standard_125x125_sAdSrcUrl;

standard_125x125_sAdSrcId = null;
standard_125x125_sAdSrcUrl = null;

/**
 * Hides fields that are irrelevant for the media uploader.
 *
 * @params	$		A reference to the jQuery function
 * @params	poller	The polling mechanism used to look for the form fields when a user uploads an image
 */
function standard_ad_125x125_hide_unused_fields($, poller) {
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
		$submit.val('Upload Advertisement');

		bHasHiddenFields = true;

	} // end if

	// Clear the polling interfval
	if(poller !== null && bHasHiddenFields) {
		clearInterval(poller);
	} // end if

} // end standard_ad_125x125_hide_unused_fields

/**
 * Overrides the core send_to_editor function in the media-upload script. Grabs the URL of the image after being uploaded and
 * populates the favicon's text field with its URL.
 *
 * @params	sHtml	The HTML of the image tag from which we're setting the favicon
 */
function ad_125x125_show_media_uploader() {
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

			jQuery(standard_125x125_sAdSrcId).val(sImageUrl);
			jQuery(standard_125x125_sAdSrcUrl).val(jQuery(sHtml).attr('href'));

		// Otherwise, we'll just grab the image
		} else {

			sImageUrl = jQuery(sHtml).attr('src');
			jQuery(standard_125x125_sAdSrcId).val(jQuery(sHtml).attr('src'));

		} // end if

		// Display the image in the admin area
		if(jQuery(standard_125x125_sAdSrcId).siblings('img').parent('a').length > 0) {
			jQuery(standard_125x125_sAdSrcId).siblings('img').parent('a').show();
		} // end if/else
		jQuery(standard_125x125_sAdSrcId).siblings('img').attr('src', sImageUrl).show();

		// Hide the upload anchor, show the delete anchor
		jQuery(standard_125x125_sAdSrcId).siblings('.ad_upload').hide();
		jQuery(standard_125x125_sAdSrcId).siblings('.ad_delete').show();

		// Hide the thickbox
		tb_remove();

		// Restore the previous editor handler
		window.send_to_editor = window.restore_editor;

	}; // end window.send_to_editor

} // end ad_125x125_show_media_uploader

/**
 * Attaches event handlers for Standard's 300x250 advertisement widget administration
 * panel.
 */
function standard_ad_125x125($) {
	"use strict";
	// Display the uploader when the anchor is clicked
	// We have to unbind previous click events in case someone adds multiple instances of this widget
	$('.standard-ad-125x125-wrapper img').unbind('click')
		.click(function() {

		// Identify the input fields for this advertisement
		var sAdNumber =$(this).parent('span').attr('class').split(' ')[1];
		standard_125x125_sAdSrcId = $(this).siblings('.' + sAdNumber + '-src');
		standard_125x125_sAdSrcUrl = $(this).siblings('.' + sAdNumber + '-url');

		// Show the uploader
		ad_125x125_show_media_uploader();

		// Modify the media uploader to hide certain fields and change the text of certain buttons
		$('#TB_iframeContent').load(function() {


			// if the user is uploading a new ad, we need to poll until we see the form fields
			var ad_125x125_poll = setInterval(function() {
				if($('#TB_iframeContent').contents().find('#media-items').children().length > 0) {
					standard_ad_125x125_hide_unused_fields($, ad_125x125_poll);
				} // end if
			}, 500);

			// if they aren't uplaoding, we'll clear the fields on load
			standard_ad_125x125_hide_unused_fields($);

		});

	});

	$('.standard-ad-125x125-wrapper a').click(function(evt) {

		evt.preventDefault();

		$(this).siblings('img').hide();
		$(this).siblings('input').val('');
		$(this).hide();

	});

} // end standard_ad_125x125

(function($) {
	"use strict";
	// Attach event handlers on initial page load
	$(function() {
		standard_ad_125x125($);
	});

	// If the 300x250 widget is being activated, we need to setup the event handlers again
	$(document).ajaxSuccess(function(e, xhr, settings) {

		var sWidgetName = 'standard-ad-125x125';

		// Make sure that we only attach handlers when we aren't deleting widgets
		if(settings !== undefined && settings.data !== undefined) {
			if(settings.data.search(sWidgetName) !== -1 && settings.data.search('id_base=' + sWidgetName) !== -1 && settings.data.search('delete_widget') === -1) {
				standard_ad_125x125($);
			} // end if
		} // end if

	});

}(jQuery));