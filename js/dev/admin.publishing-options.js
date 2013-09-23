(function($) {
	"use strict";
	$(function () {

		// Generate Privacy Policy
		$('#generate_privacy_policy').click(function(evt) {
			
			evt.preventDefault();
			
			$.post(ajaxurl, {
				
					action: 'standard_generate_privacy_policy_page',
					nonce: $.trim($('#standard-privacy-policy-nonce').text()),
					generatePrivacyPolicy: 'true'
					
				}, function(response) {
				
					if( parseInt(response, 10) > 0 ) {

						$('#generate-privacy-policy-wrapper').hide('fast', function() {
						
							$('#privacy_policy_id').text(response);
							$('#edit-privacy-policy').attr('href', 'post.php?post=' + response + '&action=edit');
							$('#has-privacy-policy-wrapper').show();
							
						});
						
						$('#delete-privacy-policy-wrapper').show();
						
					} // end if
					
				});
			
		});
		
		// Delete Privacy Policy
		$('#delete_privacy_policy').click(function(evt) {
			
			evt.preventDefault();
			
			$.post(ajaxurl, {
				
					action: 'standard_delete_privacy_policy_page',
					nonce: $.trim($('#standard-privacy-policy-nonce').text()),
					page_id: $('#privacy_policy_id').text(),
					deletePrivacyPolicy: 'true'
					
				}, function(response) {
				
					if( parseInt(response, 10) === 0 ) {
						
						$('#has-privacy-policy-wrapper').hide('fast', function() {
						
							$('#generate-privacy-policy-wrapper').show();
							
						});

					} // end if
					
				});
			
		});
		
		// Generate Comment Policy
		$('#generate_comment_policy').click(function(evt) {
			
			evt.preventDefault();
			
			$.post(ajaxurl, {
				
					action: 'standard_generate_comment_policy_page',
					nonce: $.trim($('#standard-comment-policy-nonce').text()),
					generateCommentPolicy: 'true'
					
				}, function(response) {

					if( parseInt(response, 10) > 0 ) {
					
						$('#generate-comment-policy-wrapper').hide('fast', function() {
						
							$('#comment_policy_id').text(response);
							$('#edit-comment-policy').attr('href', 'post.php?post=' + response + '&action=edit');
							$('#has-comment-policy-wrapper').show();
							
						});
						
					} // end if
					
				});
			
		});
		
		// Delete Comment Policy
		$('#delete_comment_policy').click(function(evt) {
			
			evt.preventDefault();
			
			$.post(ajaxurl, {
				
					action: 'standard_delete_comment_policy_page',
					nonce: $.trim($('#standard-comment-policy-nonce').text()),
					page_id: $('#comment_policy_id').text(),
					deleteCommentPolicy: 'true'
					
				}, function(response) {
				
					if( parseInt(response, 10) === 0 ) {
						
						$('#has-comment-policy-wrapper').hide('fast', function() {

							$('#generate-comment-policy-wrapper').show();
							
						});

					} // end if
					
				});
			
		});
		
	});
}(jQuery));