<?php
/**
 * Activity Tabs is a widget for easily displaying your recent posts,
 * most popular posts, top comments, and tag cloud.
 *
 * It depends on Twitter Booterstrap.
 *
 * @package		Standard
 * @subpackage	Activity Tabs Widget
 * @version 	1.1
 * @since		3.0
 */
class Activity_Tabs extends WP_Widget {

	/*--------------------------------------------------------*
	 * Constructor
	 *--------------------------------------------------------*/
	 
	/**
	 * Initializes the widget's classname, description, and JavaScripts.
	 */
	public function __construct() {

		$widget_opts = array(
			'classname' 	=> __( 'standard-activity-tabs', 'standard' ), 
			'description' 	=> __( 'Display your most recent posts, comments, popular posts, and tags.', 'standard' ),
		);	
		$this->WP_Widget( 'standard-activity-tabs', __( 'Activity Tabs', 'standard' ), $widget_opts );
		
		add_action( 'admin_enqueue_scripts', array( &$this, 'register_admin_styles' ) );
		
	} // end constructor

	/*--------------------------------------------------------*
	 * API Functions
	 *--------------------------------------------------------*/
	 
	/**
	 * Outputs the content of the widget.
	 *
	 * @param	array    $args		The array of form elements
	 * @param	object   $instance	The current instance of the wdiget
	 * @since	3.0
	 * @version	3.0
	 */
	public function widget( $args, $instance ) {
	
		extract( $args, EXTR_SKIP );

		$post_count = empty( $instance['post_count']) ? '' : apply_filters( 'post_count', $instance['post_count'] );
		$popular_count = empty( $instance['popular_count']) ? '' : apply_filters( 'popular_count', $instance['popular_count'] );
		$comment_count = empty( $instance['comment_count']) ? '' : apply_filters( 'comment_count', $instance['comment_count'] );
		$tag_count = empty( $instance['tag_count']) ? '' : apply_filters( 'tag_count', $instance['tag_count'] );

		// Display the widget
		if( $post_count > 0 || $popular_count > 0 || $comment_count > 0 || $tag_count > 0 ) {
		
			if( isset( $args['before_widget'] ) ) {
				echo $args['before_widget'];
			} // end if
			
			echo self::get_popular_content( $post_count, $popular_count, $comment_count, $tag_count );
			
			if( isset( $args['after_widget'] ) ) {
				echo $args['after_widget'];
			} // end if
			
		} // end if
		
	} // end widget
	
	/**
	 * Processes the widget's options to be saved.
	 *
	 * @param  array   $new_instance	The previous instance of values before the update.
	 * @param  array   $old_instance	The new instance of values to be generated via the update.
	 * @return array                    The updated instance of the widget.
	 * @since	3.0
	 * @version	3.0
	 */
	public function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;

		$instance['post_count'] = strip_tags( stripslashes( $new_instance['post_count'] ) );
		$instance['popular_count'] = strip_tags( stripslashes( $new_instance['popular_count'] ) );
		$instance['comment_count'] = strip_tags( stripslashes( $new_instance['comment_count'] ) ); 
		$instance['tag_count'] = strip_tags( stripslashes( $new_instance['tag_count'] ) ); 

		return $instance;
		
	} // end widget
	
	/**
	 * Generates the administration form for the widget.
	 *
	 * @param	array $instance	The array of keys and values for the widget.
 	 * @since	3.0
	 * @version	3.0
	 */
	public function form( $instance ) {

		$instance = wp_parse_args(
			(array)$instance,
			array(
				'post_count'      => '',
				'popular_count'   => '',
        		'comment_count'   => '',
        		'tag_count'       => ''
			)
		);
    
    	$post_count = strip_tags( stripslashes( $instance['post_count'] ) );
    	$popular_count = strip_tags( stripslashes( $instance['popular_count'] ) );
    	$comment_count = strip_tags( stripslashes( $instance['comment_count'] ) );
    	$tag_count = strip_tags( stripslashes( $instance['tag_count'] ) );
   
		// Display the admin form
    	include( get_template_directory() . '/lib/activity/views/admin.php' );
		
	} // end form
	

	/*--------------------------------------------------------*
	 * Helper Functions
	 *--------------------------------------------------------*/

	/** 
	 * Registers and Enqueues the stylesheets for the Media Uploader and this widget.
	 *
	 * @since	3.0
	 * @version	3.0
	 */
	public function register_admin_styles() {
		wp_enqueue_style( 'standard-activity-tabs', get_template_directory_uri() . '/lib/activity/css/admin.css', false, STANDARD_THEME_VERSION );
	} // end register_admin_styles

	/*--------------------------------------------------------*
	 * Private Functions
	 *--------------------------------------------------------*/
	 
	/**
	 * Creates the container for all of the popular elements.
	 *
	 * @param      int $post_count     Whether or not the plugin should display recent posts.
	 * @param      int $popular_count  Whether or not the plugin should display popular posts.
	 * @param      int $comment_count  Whether or not the plugin should display latest comments.
	 * @param      int $tag_count	   Whether or not the plugin should display post tags.
	 * @return     string              The HTML used to render the popular content.
	 * @since      3.0
	 * @version    3.0
	 */
	private static function get_popular_content($post_count, $popular_count, $comment_count, $tag_count) {
	
		global $post;
			
		$html = '<div class="tabbed-widget widget">';
		
			$html .= '<div class="tab-inner">';

				// Determine how many tabs we are going to display		
				$tab_count = 0;
				foreach( func_get_args() as $arg ) {
					if( $arg > 0 ) {
						$tab_count++;
					} // end if
				} // end foreach
		
				$html .= '<ul class="nav nav-tabs tab-count-' . $tab_count . '">';
				
					if( $post_count > 0 ) {
						$html .= '<li><a href="#recent" data-toggle="tab">' . __( 'Recent', 'standard' ) . '</a></li>';
					} // end if
					
					if( $popular_count > 0 ) {
						$html .= '<li><a href="#popular" data-toggle="tab">' . __( 'Popular', 'standard' ) . '</a></li>';
					} // end if
					
					if( $comment_count > 0 ) {
						$html .= '<li><a href="#pop-comments" data-toggle="tab">' . __( 'Comments', 'standard' ) . '</a></li>';
					} // end if
					
					if( $tag_count > 0 ) {
						$html .= '<li><a href="#tags" data-toggle="tab">' . __( 'Tags', 'standard' ) . '</a></li>';
					} // end if
					
				$html .= '</ul>';
				
				$html .= '<div class="tab-content">';
				
					if( $post_count > 0 ) {
						$html .= self::get_latest_posts( $post_count );
					} // end if
						
					if( $popular_count > 0 ) {
						$html .= self::get_popular_posts( $popular_count );
					} // end if
					
					if( $comment_count > 0 ) {
						$html .= self::get_latest_comments( $post, $comment_count );
					} // end if
						
					if( $tag_count ) {
						$html .= self::get_tags( $tag_count );
					} // end if
						
				$html .= '</div><!-- /.tab-content -->'; 
				
			$html .= '</div><!-- /.tab-inner -->';
		
		$html .= '</div><!-- /.tabbed-widget -->';
		
		return $html;
	
	} // end get_container

	/**
	 * Creates the container for all of the latest posts.
	 *
	 * @param	int $post_count  The number of latest posts to list.
	 * @return	string  The HTML used to render the list of latest posts.
	 * @since	3.0
	 * @version	3.0
	 */
	private function get_latest_posts( $post_count ) {
	
		// Get the latest posts
		$latest_posts = get_posts(
			array(
				'numberposts' 	=> $post_count,
				'order' 		=> 'desc',
				'orderby'	 	=> 'date'
			)
		);

		// Create the markup for the listing
		$html = '<div class="tab-pane" id="recent">';
			$html .= '<ul class="latest-posts">';

			if( count( $latest_posts ) > 0 ) {
						
				foreach( $latest_posts as $post ) {
				
					$html .= '<li class="clearfix">';
						
						// Add the small featured image
						if( has_post_thumbnail( $post->ID ) ) {
							$html .= '<a class="latest-post-tn fademe" href="' . get_permalink( $post->ID ) . '" rel="nofollow">';
								if( 0 < strlen( get_the_post_thumbnail( $post->ID ) ) ) {
									$html .= get_the_post_thumbnail( $post->ID, 'thumbnail' );
								} // end if 
							$html .= '</a>';
						} // end if
						
						$html .='<div class="latest-meta">';	
							
							// Add the title
							$html .= '<a href="' . get_permalink( $post->ID ) . '" rel="nofollow">';
								$html .= get_the_title( $post->ID );
							$html .= '</a>';
							
							// Add date posted
							// If there's no title, then we need to turn the date into the link
							if( strlen( get_the_title( $post->ID ) ) == 0 ) {
								$html .= '<a href="' . get_permalink( $post->ID ) . '" rel="nofollow">';
							} // end if
							
							$html .= '<span class="latest-date">';
								$html .= get_the_time( get_option( 'date_format' ), $post->ID );
							$html .= '</span>';
							
							// Close the anchor 
							if(strlen( get_the_title( $post->ID ) ) == 0 ) {
								$html .= '</a>';
							} // end if
							
						$html .='</div>';
						
					$html .= '</li>';
				} // end foreach
				
			} else {
			
				$html .= '<li>';
					$html .= '<p class="no-posts">' . __( "You have no recent posts.", 'standard' ) . '</p>';
				$html .= '</li>';
			
			} // end if/else
			
			$html .= '</ul>';
		$html .= '</div>';
		
		return $html;
	
	} // end get_latest_posts

	/**
	 * Renders the list of the most popular comments based on the number of comments
	 * over the last week, month, or all time.
	 *
	 * @param	int  $popular_count   The number of posts to list.
	 * @return	string The HTML used to render the list of popular posts.
	 * @since	3.0
	 * @version	3.0
	 */
	private function get_popular_posts( $popular_count ) {
	
		$args = array(
			'orderby'				=>	'comment_count',
			'order'					=>	'desc',
			'posts_per_page'		=>	$popular_count,
			'ignore_sticky_posts'	=> 	1
		);
		$popular_posts = new WP_Query( $args );

		$html = '<div id="popular" class="tab-pane">';
		$html .= '<ul class="popular-posts">';
		if( $popular_posts->have_posts() ) { 
		
			while( $popular_posts->have_posts() ) { 
			
				$popular_posts->the_post();
				
				$html .= '<li class="clearfix">';
				
					// Render the thumbnail, if it's set
					if( '' != get_the_post_thumbnail() ) {
					
						$html .= '<a class="latest-post-tn fademe" href="' . get_permalink() . '" rel="nofollow">';
							$html .= get_the_post_thumbnail( get_the_ID(), 'thumbnail' );
						$html .= '</a>';
					
					} // end if/else
					
					$html .= '<div class="latest-meta">';
						
						// Render the title (but make sure it doesn't exceed 60 characters)
						$html .= '<a href="' . get_permalink() . '" rel="nofollow">';
													
							$title = get_the_title();
							if( strlen( $title ) > 45 ) {
								$title = trim( substr( $title, 0, 45 ) ) . '...';
							} // end if
							
							$html .= $title;
							
						$html .= '</a>';
						
						// Render the meta data
						$html .= '<span class="latest-date">';
							
							// Start the anchor for the time if the title isn't present
							if( strlen( $title) == 0 ) {
								$html .= '<a href="' . get_permalink() . '" rel="nofollow">';
							} // end if
							
							// Get the number of comments for this post
							$comment_count = wp_count_comments( get_the_ID() );
							$comment_count = $comment_count->approved;
							$comment_str = $comment_count . ' ' . __( 'comments since', 'standard' ) . ' ';
							
							$html .= $comment_str . get_the_time( get_option( 'date_format' ) );
							
							// Close the anchor for the time if the title isn't present
							if( strlen( $title ) == 0 ) {		
								$html .= '</a>';
							} // end if
							
						$html .= '</span>';
						
					$html .= '</div>';
					
				$html .= '</li>';
				
			} // end while
				
		} else {
		
			$html .= '<li>';
				$html .= '<p class="no-posts">' . __( "You have no popular posts.", 'standard' ) . '</p>';
			$html .= '</li>';
			
		} // end if/else
			
			$html .= '</ul>';
		$html .= '</div>';
		
		wp_reset_postdata();
		
		return $html;
	
	} // end get_popular_posts
	
	/**
	 * Renders the most recent comments.
	 *
	 * @param   object $post           The current post
	 * @param   int    $comment_count  The number of comments to display
	 * @return  string The markup for rendering the comments.
	 * @since	3.0
	 * @version	3.0
	 */
	private function get_latest_comments( $post, $comment_count ) {

		// Get the 10 most recent comments
		$comments = get_comments(	
			array(
				'number' => $comment_count,
				'status' => 'approve'
			)
		);
		
		// Create the markup for the listing
		$html = '<div id="pop-comments" class="tab-pane">';
			$html .= '<ul class="latest-comments">';

			if( count( $comments ) > 0 ) {
		
				foreach( $comments as $comment ) {
		
					$html .= '<li class="clearfix">';
	
						$html .= '<a class="latest-comment-tn fademe" href="' . get_permalink( $comment->comment_post_ID ) . '" rel="nofollow">';
							$html .= get_avatar( $comment->comment_author_email, '50' );
						$html .= '</a>';
												
						// Link the comment to the post
						$html .='<div class="comment-meta">';	
							
							// Add the title
							if( strlen( $comment->comment_content ) <= 40 ) {
								$html .= '<div class="comment-meta-author">' . $comment->comment_author . '</div>';
								$html .= '<div class="comment-meta-comment">';
									$html .= '<a href="' . get_comment_link( $comment ) . '" rel="nofollow">';
										$html .= strip_tags( $comment->comment_content );
									$html .= '</a>';
								$html .= '</div>';
							} else {
								$html .= '<div class="comment-meta-author">' . $comment->comment_author . '</div>';
								$html .= '<div class="comment-meta-comment">';
									$html .= '<a href="' . get_comment_link( $comment ) . '" rel="nofollow">';
										$html .= strip_tags( substr( $comment->comment_content, 0, 40 ) ) . '...';
									$html .= '</a>';
								$html .= '</div>';
							} // end if/else	
							
							
						$html .='</div>';
	
					$html .= '</li>';
					
				} // end foreach
				
			} else {
			
				$html .= '<li>';
					$html .= '<p class="no-comments">' . __( 'You have no comments.', 'standard' ) . '</p>';
				$html .= '</li>';
				
			} // end if
								
			$html .= '</ul>';
		$html .= '</div>';
		
		return $html;
	
	} // end get_lastest_comments
	
	/**
	 * Renders a cloud of the most popular tags.
	 * 
	 * @param	int $tag_count	The number of tags to reder
	 * @return	string The HTML used to render the list of tags.
	 * @since	3.0
	 * @version	3.0
	 */
	private function get_tags( $tag_count ) {

		$tags = wp_tag_cloud( 
				 	array( 
				 		'smallest' 	=> '8',
				 		'largest' 	=> '22',
				 		'number'	=> $tag_count,
				 		'orderby' 	=> 'count',
				 		'taxonomy' 	=> 'post_tag',
				 		'format' 	=> 'array'
				 	) 
				 );

		// Create the markup
		$html = '<div id="tags" class="tagcloud tab-pane">';		
			$html .= '<div class="post-tags">';
				if( $tags && count( $tags ) > 0 ) {
					foreach( $tags as $tag ) {
						$html .= $tag;
					} // end foreach
				} else {
						$html .= '<p class="no-tags">' . __( 'You have no tags.', 'standard' ) . '</p>';
				} // end if
			$html .= '</div>';
		$html .= '</div>';
		
		return $html; 
		
	} // end get_tags

} // end class
add_action( 'widgets_init', create_function( '', 'register_widget( "Activity_Tabs" );' ) ); 