<?php

/**
 * Standard SEO Titles will generate search engine optimized titles for each page
 * of your WordPress Blog.
 *
 * Home Page | Blog Name | Blog Description
 * Search Results | Search Results for search terms | 11 Articles | Blog Name
 * 404 (Error) Page  | Blog Name | 404 Nothing Found
 * Author Archives | Blog Name | Author Archives
 * Single Post | Post Name | Category Name | Blog Name
 * Page | Page Name | Blog Name
 * Category Page | Category Name | Blog Name
 * Monthly Archive | Blog Name | Archive | Month, Year
 * Day Archive | Blog Name | Archive | Month Day, Year
 * Tag | Blog Name | Tag Archive | Tag
 *
 * @package		Standard
 * @subpackage	SEO Titles
 * @version		1.0
 * @since		3.0
 */
class Standard_SeoTitles {

	/*--------------------------------------------------------*
	 * Public Functions
	 *--------------------------------------------------------*/

	/**
	 * Generates a breadcrumb trail for the current page.
	 *
	 * @param	int $page_id	Optional. The ID of the current page.
	 * @return	string The SEO optimized title element for the page.
	 * @since	3.0
	 * @version	1.0
	 */
	public static function get_page_title( $page_id = null ) { 

		$title = get_bloginfo( 'name' ) . ' | ' . get_bloginfo( 'description' );
		
		if( is_home() ) {
			$title = get_bloginfo( 'name' ) . ' | ' . get_bloginfo( 'description' );
		} elseif ( is_search() ) {
		
			$query = $_GET[ 's' ];
		
			$search = new WP_Query( 's=' . $query . '&posts_per_page=-1' );
			$key = trim( esc_html( $query, 1 ) );
			$count = $search->post_count;
			
			$title = __( 'Search Results For' , 'standard' ) . ' ' . $key . ' | ' . $count . ' ' . __( 'Results', 'standard' ) . ' | ' . get_bloginfo( 'name' );
			
		} elseif( is_404() ) {
			$title = get_bloginfo( 'name' ) . ' | ' . __( '404 Nothing Found', 'standard' ); 
		} elseif( is_author() ) {
			$title = get_bloginfo( 'name' ) . ' | ' . __( 'Author Archives', 'standard' ); 
		} elseif( is_single() ) {
		
			if( strlen( trim( get_the_title( $page_id ) ) ) == 0 ) {
				$title = get_bloginfo( 'name' ) . ' | ' . get_bloginfo( 'description' );
			} else {
				$title = strip_tags( htmlspecialchars_decode( get_the_title( $page_id ) ) ) . ' | ' . get_bloginfo( 'name' );
			} // end if/else
			
		} elseif( is_page() ) {
			$title = get_bloginfo( 'name' ) . ' | ' . strip_tags( htmlspecialchars_decode( get_the_title( $page_id ) ) );
		} elseif( is_category() ) {
			$title = single_cat_title( '', false ) . ' | ' . get_bloginfo( 'name' );
		} elseif( is_year() ) {
			$title = get_bloginfo( 'name' ) . ' | ' . __( 'Archive', 'standard' ) . ' | ' . get_the_time( 'Y' );
		} elseif( is_month() ) {
		
			// This particular format is not localized. The 'date_format' uses month and year and we only need month and year.
			// The archives widget built into WordPress follows the format that we're providing see.
			// Lines 938 - 939 of general-template.php in WordPress core.
			$title = get_bloginfo( 'name' ) . ' | ' . __( 'Archive', 'standard' ) . ' | ' . get_the_time( 'F Y' );
			
		} elseif( is_day() ) {
			$title = get_bloginfo( 'name' ) . ' | ' . __( 'Archive', 'standard' ) . ' | ' . get_the_time( get_option( 'date_format' ) );
		} elseif( is_tag() ) {
			$title = get_bloginfo( 'name' ) . ' | ' . __( 'Tag Archive', 'standard' ) . ' | ' . single_tag_title( '', false );
		} elseif( is_feed() ) {
			$title = ' | ' . get_bloginfo( 'description' );
		} // end if/else
		
		return $title;
		
	} // end get_page_title

} // end class