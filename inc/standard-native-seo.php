<?php
/**
 * Helper function for determining if any other SEO plugins are installed.
 *
 * @return	boolean True if 'WordPress SEO', 'All In One SEO', or 'Platinum SEO' are installed.
 * @since	3.0
 * @version	3.0
 */
function standard_using_native_seo() {
	return ! ( defined( 'WPSEO_URL' ) || class_exists( 'All_in_One_SEO_Pack' ) || class_exists( 'Platinum_SEO_Pack' ) );
} // end standard_using_native_seo