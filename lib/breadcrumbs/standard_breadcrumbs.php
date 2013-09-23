<?php

/**
 * Standard Breadcrumbs is a class that is responsible for creating SEO-friendly
 * breadcrumbs for blog posts.
 *
 * The class will generate the breadcrumbs in the format of:
 * 	Home / Category / Page Title
 * with links to each page throughout the hierarchy.
 *
 * @package		Standard
 * @subpackage	Breadcrumbs
 * @version 	1.0
 * @since		3.0
 */
class Standard_Breadcrumbs {

	/*--------------------------------------------------------*
	 * Public Functions
	 *--------------------------------------------------------*/

	/**
	 * Generates a breadcrumb trail for the current page.
	 *
	 * @param   int $page_id   The ID of the current page.
	 * @return  string         The markup for the breadcrumb trial.
	 * @since	3.0
	 * @version 1.0
	 */
	public static function get_breadcrumb_trail( $page_id ) { 
	
		if( ! is_home() ) {
		
			$str_breadcrumb = '<div itemscope itemtype="http://data-vocabulary.org/Breadcrumb">';
			$str_breadcrumb .= '<ul class="breadcrumb">';
			
			if( is_page() ) {
			
				$str_breadcrumb .= self::get_home_link() . self::get_parent_page_link( $page_id );
				
			} elseif( is_single() ) {
			
				if( '' != get_query_var( 'attachment_id' ) || '' != get_query_var( 'attachment' ) ) {
				
					$post = get_post( get_post_field( 'post_parent', get_the_ID() ) );
					$str_breadcrumb .= self::get_home_link() . self::get_category_links( $post->ID ) . self::get_parent_page_link( $post->ID ) . self::get_page_title($page_id);
					
				} else {
					$str_breadcrumb .= self::get_home_link() . self::get_category_links( $page_id ) . self::get_page_title( $page_id );
				} // end if/else
				
			} elseif( is_archive() ) {

				if( is_author() ) {
					$str_breadcrumb .= self::get_home_link() . __( 'Archives', 'standard' ) . ' ' . __( '/', 'standard' ) . ' ' . self::get_author_display_name(); 
				} elseif( '' != get_query_var( 'year' ) || '' != get_query_var( 'monthnum' ) || '' != get_query_var( 'm' ) || '' != get_query_var( 'day' ) ) {
					$str_breadcrumb .= self::get_home_link() . __( 'Archives', 'standard' ) . ' ' . __( '/', 'standard' ) . ' ' . self::get_date_labels(); 
				} else {
					$str_breadcrumb .= self::get_home_link() . __( 'Archives', 'standard' ) . ' ' . __( '/', 'standard' ) . ' ' . self::get_category_links();
				} // end if
				
			} else if( is_search() ) {
			
				$str_breadcrumb .= self::get_home_link() . __( 'Search', 'standard' ) . ' ' . __( '/', 'standard' ) . ' ' . self::get_search_query();
				
			} // end if/else
			
			$str_breadcrumb .= '</ul>';
			$str_breadcrumb .= '</div>';

			return $str_breadcrumb;
			
		} // end if
		
	} // end standard_breadcrumbs

	/*--------------------------------------------------------*
	 * Private Functions
	 *--------------------------------------------------------*/
	
	/**
	 * Creates the list item home link. The home link is generated on the blog's URL.
	 * 
	 * @return	string A list item and anchor to the home of the website.
	 * @since	3.0
	 * @version 1.0
	 */
	private static function get_home_link() {
	
		$home_link = '';
		
		$home_link .= '<li class="home-breadcrumb">';
			$home_link .= '<a href="' . home_url() . '" itemprop="url"><span itemprop="title">' . __( 'Home', 'standard' ) . '</span></a>';
			$home_link .= '<span class="divider">/</span>';
		$home_link .= '</li>';
		
		return $home_link;
		
	} // end get_home_link	
	
	/**
	 * Creates the list of category links based on the current page.
	 *
	 * @param	int $page_id		Optional. The ID for the current page
	 * @return	string The category list item and anchor for the current category.
	 * @since	3.0
	 * @version	1.0
	 */
	private static function get_category_links( $page_id = '' ) {
	
		// Get the current category based on whether or not the page ID is set.
		// If the ID isn't set, we're on an archives page
		if( strlen( trim( $page_id ) ) > 0 ) {

			$category_name = '';
			$category_url = '';

			$categories = get_the_category( $page_id );
			if( count( $categories) > 0 ) {
			
				$category = $categories[0];
				
				$category_id = $category->cat_ID;
				$category_name = $category->cat_name;
				$category_url = get_category_link( $category_id );
			
			} // end if
		
		} else {
		
			if( '' == single_tag_title( '', false ) ) {
			
				$category_id = get_query_var( 'cat' );
				$category_name = get_cat_name( $category_id );
				$category_url = get_category_link( $category_id );
				
			} else {
			
				$category_name = single_tag_title( '', false );
				$category_url = get_tag_link( get_query_var( 'tag_id' ) );

			} // end if/else
		
		} // end if/else
		
		// Create the category link
		$category_link = '<li>';
			$category_link .= '<a href="' . $category_url . '" itemprop="url"><span itemprop="title">' . $category_name . '</span></a>';
			if( strlen( trim( $page_id ) ) > 0 && strlen( trim( $category_name ) ) > 0) {
				$category_link .= '<span class="divider">/</span>';
			} // end if
		$category_link .= '</li>';
		
		
		return $category_link;
			
	} // end get_category_links
	
	/**
	 * Generates labels for each of the date archives (that is, year, month, and day). Uses the users date format
	 * to properly format the day archive.
	 * 
	 * @return	string A list item and anchor for the type of archive (year, month, and day) is being displayed.
	 * @since	3.0
	 * @version 1.0
	 */
	public static function get_date_labels() {
	
		$date_label = '<li>';
		
		if( '' != get_query_var( 'day' ) ) {

			$date_label .= date( get_option( 'date_format' ), mktime(0, 0, 0, get_query_var( 'monthnum' ), get_query_var( 'day' ), get_query_var( 'year' ) ) );

		} elseif( '' != get_query_var( 'monthnum' ) ) {
		
			// This particular format is not localized. The 'date_format' uses month and year and we only need month and year.
			// The archives widget built into WordPress follows the format that we're providing see.
			// Lines 938 - 939 of general-template.php in WordPress core.
			$date_label = get_the_time( 'F Y' );
			
		} elseif( '' != get_query_var( 'm' ) ) { 

			if( strlen( get_query_var( 'm' ) ) == 6 ) {
							
				// See comment in lines 152 - 154
				$date_label .= get_the_time( 'F Y' );
			
			} else {
	
				$year = substr( get_query_var( 'm' ), 0, 4 );
				$month = substr( get_query_var( 'm' ), 4, 2);
				$day = substr( get_query_var( 'm' ), 6, 2 );
				
				$date_label .= date( get_option( 'date_format' ), mktime(0, 0, 0, $month, $day, $year ) );
			
			} // end if/else
			
		} elseif( '' != get_query_var( 'year' ) ) {

			$date_label .= get_query_var( 'year' );
			
		} // end if
	
		$date_label .= '</li>';
		
		return $date_label;
	
	} // end get_date_labels
	
	/**
	 * Recursively creates the parent page breadcrumb trail.
	 * 
	 * @param	int $page_id		The ID of the current page. 
	 * @return	string A list item and anchor for the current page's parent.
	 * @since	3.0
	 * @version 1.0
	 */
	private static function get_parent_page_link( $page_id ) {
		
		$page = get_page( $page_id );
		$page_link = '';
		if( $page->post_parent ) {
			$page_link = self::get_parent_page_link( $page->post_parent );
		} // end if
		
		$page_link .= '<li>';
		
			if( get_the_ID() == $page->ID ) {
			
				$page_link .= get_the_title();
			
			} else {
			
				$page_link .= '<a href="' . get_permalink( $page_id ) . '" itemprop="url"><span itemprop="title">' . get_the_title( $page_id ) . '</span></a>';
				$page_link .= '<span class="divider">/</span>';
				
			} // end if/else	
			
		$page_link .= '</li>';
		
		return $page_link;
	
	} // get_parent_page_link
	
	
	/**
	 * Creates page title list item. No link is generated for the current page.
	 *
	 * @param	int    $page_id		The ID of the current page. 
	 * @return	string A list item for the current page's parent.
	 * @since	3.0
	 * @version 1.0
	 */	
	private static function get_page_title( $page_id ) {
	
		$page_title = '';
		
		$page_title .= '<li class="active">';
			if( is_single() ) {
			
				if( strlen( $the_title = get_the_title( $page_id ) ) ) {
					$page_title .= $the_title;
				} else {
					$page_title .= get_permalink( $page_id );
				} // end if
				
			} else {
				
				$categories = get_the_category();
				$category = $categories[0];

				$page_title .= $category->name;
				
			} // end if/else
			
		$page_title .= '</li>';	

		return $page_title;
	
	}  // end get_page_title
	
	/**
	 * Creates the search query text element to be rendered in the breadcrumb trail.
	 *
	 * @return	string The value of the search term in the query string.
	 * @since	3.0
	 * @version 1.0
	 */
	private static function get_search_query() { 
	
		$query = __( '[ No search query. ]', 'standard' );
		if( isset( $_GET['s'] ) ) {
			$query = $_GET['s'];
		} // end if/else
		
		return '<span itemprop="title">' . trim( esc_html( $query, 1 ) ) . '</span>';
	
	} // end get_search_query
	
	/**
	 * Returns the name of the author based on the ID in the query string.
	 *
	 * @return	string An anchor to the name of the author.
	 * @since	3.0
	 * @version 1.0
	 */
	private static function get_author_display_name() {

		global $wp_rewrite;
		
		// If we're using permalinks, then we need to add user_trailingslashit;
		// Otherwise, we use the old way of doing it.
		if( standard_is_using_pretty_permalinks() ) { 		
			$author_data = get_userdata( get_query_var( 'author' ) );
		} else {
			$author_data = get_userdata( user_trailingslashit( get_query_var( 'author' ) ) );			
		} // end if
		
		// If the $author_data is null, then the user must have a cusotm permalink structure
		if( null == $author_data ) {
			$author_data = get_userdata( get_post( get_the_ID() )->post_author );
			$author_data = $author_data->data;
		} // end if

		$author_link = '<a href="' . esc_html( get_author_posts_url( $author_data->ID ) ) . '">';
			$author_link .= $author_data->display_name;
		$author_link .= '</a>';
		
		return $author_link;

	} // end get_author_display_name

} // end class