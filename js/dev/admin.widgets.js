(function($) {
	"use strict";
	$(function() {
		$('h4').each(function() {

			var $parent = $(this).parent().parent().parent();

			if($parent.attr('id') !== undefined && $parent.attr('id') !== false && $parent.attr('id').indexOf('standard-') > 0) {
				$(this).parents('.widget-top').addClass('standard-widget-top');
			} // end if
		});
	});
}(jQuery));