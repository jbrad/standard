<?php
/**
 * If the user has defined a Google Analytics code, then this will write it out to the <head>
 * element of the page.
 *
 * @version 1.0.0
 * @since   3.4.0
 */
function standard_fav_icon() {

	$presentation_options = get_option( 'standard_theme_presentation_options');

	if( '' != $presentation_options['fav_icon'] ) {
	?>
		<link rel="shortcut icon" href="<?php echo $presentation_options['fav_icon']; ?>" />
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $presentation_options['fav_icon']; ?>" />
	<?php
	} // end if

} // end standard_fav_icon
add_action( 'wp_head', 'standard_fav_icon' );
?>