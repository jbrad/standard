<?php
/**
 * Determines if the incoming URL is a gplus.to URL or a vanilla Google+ URL.
 *
 * @param	string $url	The URL to evaluate
 * @return	boolean Whether or not the URL is a gplus.to URL
 * @since	3.1
 * @version	3.1
 */
function standard_is_gplusto_url( $url ) {
	return false != stristr( $url, 'gplus.to' );
} // end standard_is_gplusto_url

/**
 * Determines if the incoming URL is a Google+ vanity URL.
 *
 * @param	string $url	The URL to evaluate
 * @return	boolean 	Whether or not the URL is a Google Plus Vanity URL
 * @since	3.3
 * @version	3.3
 */
function standard_is_google_plus_vanity_url( $url ) {
	return false != stristr( $url, '/+' );
} // end standard_is_google_plus_vanity_url

/**
 * Retrieves the user's Google+ ID from their gplus.to address.
 *
 * @param	string $url	The URL to evaluate
 * @return	string The full Google+ URL from the incoming URL.
 * @since	3.1
 * @version	3.1
 */
function standard_get_google_plus_from_gplus( $url ) {

	$gplus_url = $url;

	// Check to see if http:// is there
	if( false == stristr( $url, 'http://' ) ) {
		$url = 'http://' . $url;
	} // end if

	// Get the headers from the gplus.to, URL
	$headers = @get_headers( $url );
	$url_parts = explode( '/', $headers[5] );

	// If the 5th index exists, the Google+ ID will be here
	if( isset( $url_parts[5] ) ) {
		$gplus_url = 'https://plus.google.com/' . $url_parts[5];
	} // end if

	return user_trailingslashit( $gplus_url );

} // standard_get_google_plus_from_gplus

/**
 * Echos the publisher's Google Plus URL to the header of the page, if it's defined.
 *
 * @version 1.0.0
 * @since   3.4.0
 */
function standard_google_plus() {

	global $post;

	$html = '';
	if( standard_using_native_seo() && ( ( is_single() || is_page() ) && ( 0 != strlen( trim( ( $google_plus = get_user_meta( $post->post_author, 'google_plus', true ) ) ) ) ) ) ) {

		if( false != standard_is_gplusto_url( $google_plus ) ) {
			$google_plus = standard_get_google_plus_from_gplus( $google_plus );
		} // end if

		$html = '<link rel="author" href="' . trailingslashit( $google_plus ) . '"/>';

	} // end if

	echo $html;

} // end standard_google_plus
add_action( 'wp_head', 'standard_google_plus' );