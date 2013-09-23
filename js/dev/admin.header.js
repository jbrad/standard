(function ($) {
	"use strict";
    $(window).load(function () {

	    if( 0 !== $('#_wpnonce-custom-header-upload').length ) { 
       
	        // Unconditionally hide the ability to check to include text with the image
	        $('.form-table:last tr:first').hide();
	       
	        /* If the header image is displayed, then we hide the text. Users can
	         * only have an image or text, but not both.
	         */
	        if($('#header-bottom').length > 0) {
	        
	            $('#header-top').hide();
	            
	            alert();
	            
	            // Add a 'disabled' class and disable the elements in the second form
	            $('.form-table:last').addClass('disabled');
	            $('.form-table:last input').attr('disabled', 'disabled');
	            
	            // Create the new notification row for 
	            var $notificationRow, $notificationCell;
	            
	            /* Translators: This will need to be localized. */
	            $notificationCell = $('<td />')
	                .attr('colspan', '2')
	                .html('<p class="description">Remove header image to activate header text.</p>');
	                
	            $notificationRow = $('<tr />')
	                .append($notificationCell);
	                
	            $('.form-table:last').prepend($notificationRow);
	            
	            // Since the form is disabled, we need to hide the 'Select a Color' anchor
	            $('.form-table:last a').hide();
	            
	            // Hide the 'Header Text' element
	            $('.form-table.disabled')
	            	.hide()
	            	.prev()
	            	.hide();
	        
	        } else {
	        	
	            $('#header-top').show();
	            
	            // Update the description color with what's in the color picker
		        $('.iris-picker, .iris-palette').mousedown(function(evt) { 

			        // If this is the iris palette, we have to trigger a double-click
			        if( $(this).hasClass('iris-palette') ) {
				        $(this).trigger('click');
			        } // end if

			        $('#desc')
			        	.removeAttr( 'style' )
			        	.attr( 'style', 'color: ' + $('#text-color').val() + ' !important' ); 

			        	
		        });
		        
        		// If the 'Default' button is clicked, then we need to update the color
    		    $('input[type="button"].wp-picker-default').click(function(evt) {
			        $('#desc').attr( 'style', 'color: #7a7a7a' );
		        });
	            
	        } // end if
        
        } // end if
        
    });
}(jQuery));