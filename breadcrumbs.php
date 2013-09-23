<?php
/**
 * The template for displaying breadcrumbs. Supports both Standard and Yoast Breadcrumbs.
 *
 * @package Standard
 * @version	3.1
 * @since 	3.0
 */
?>
<?php 
if( function_exists( 'yoast_breadcrumb' ) ) {

	yoast_breadcrumb( '', '' );

} else {

	$presentation_options = get_option( 'standard_theme_presentation_options ' );
	
	$display_breadcrumbs = '';
	if( isset( $presentation_options['display_breadcrumbs'] ) ) {
		$display_breadcrumbs = $presentation_options['display_breadcrumbs'];
	} // end if
	
	if( 'always' == $display_breadcrumbs ) {
		if( '' !== get_the_ID() ) {
			echo Standard_Breadcrumbs::get_breadcrumb_trail( get_the_ID() );
		} // end if
	} // end if
 
} // end if