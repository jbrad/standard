<?php 
/**
 * The template for rendering the social networking icons.
 *
 * @package Standard
 * @since 	3.0
 * @version	3.1
 */
 
// Read the active social icon stirng
$social_options = get_option( 'standard_theme_social_options' ); 
$social_options = $social_options['active-social-icons'];	

// Read out the URLs
$social_icons_urls = explode( ';', $social_options );

// Begin to build up the list looking for the anchors for each image, too
$html = '<ul class="nav social-icons clearfix">';
foreach( $social_icons_urls as $icon_url ) {

	$icon_url_array = explode( '|' , $icon_url );
	$url = null;
	if( count( $icon_url_array ) == 1 ) {
	
		$icon = $icon_url_array[0];
	
	} else { 
	
		$icon = $icon_url_array[0];
		$url = $icon_url_array[1];
		
	} // end if/else
	
	// Build the line item
	if( isset( $url ) || '' != esc_url( $icon ) ) { 
	
		$html .= '<li>';
		if( strpos( $icon, 'rss.png' ) > 0 ) {
			$url = standard_get_rss_feed_url();
		} // end if/else
		
		// if the image has a URL, setup the anchor...
		if( '' != $url ) {
			$html .= '<a href="' . esc_url( str_replace( 'https://', 'http://', $url ) ) . '" class="fademe" target="_blank">';
		} // end if
		
			// display the image
			$html .= '<img src="' . esc_url( $icon ) . '" alt="" />';
		
		// ...and if the image has a URL, close the anchor
		if( '' != $url ) {
			$html .= '</a>';
		} // end if
		
		unset( $url );
		
		$html .= '</li>';
	
	} // end if/else
	
} // end foreach
$html .= '</ul>';

// Render the list
echo $html;