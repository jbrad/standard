(function($) {
	"use strict";
	$(function () {

		var $googlePlus, sMessage, spanMessage;
		$googlePlus = $('#google_plus');

		if( 0 < $googlePlus.length ) {

			/* Translators: This will need to be localized. */
			sMessage = "Use long URL, not vanity URL.";

			spanMessage =
				$('<span />')
					.attr('class', 'description')
					.html( '&nbsp;' + sMessage );

			spanMessage.insertAfter( $googlePlus );

		} // end if

	});
}(jQuery));