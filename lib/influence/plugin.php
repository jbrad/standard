<?php
/**
 * Influence is a widget for showing an aggregate of your Twitter followers and
 * Facebook fans.
 *
 * @version	1.5
 */
class Standard_Influence extends WP_Widget {

	/*--------------------------------------------------------*
	 * Constructor
	 *--------------------------------------------------------*/
	 
	public function __construct() {

		$widget_opts = array(
			'classname' 	=> __( 'standard-social-influence', 'standard' ), 
			'description' 	=> __( 'Display your social influence by showcasing Twitter followers and Facebook fans.', 'standard' )
		);	
		$this->WP_Widget( 'standard-influence-widget', __( 'Social Influence', 'standard' ), $widget_opts );
				
		add_action( 'admin_print_styles', array( $this, 'register_admin_styles' ) );
		
	} // end constructor

	/*--------------------------------------------------------*
	 * API Functions
	 *--------------------------------------------------------*/
	 
	/**
	 * Outputs the content of the widget.
	 *
	 * @args			The array of form elements
	 * @instance
	 */
	public function widget( $args, $instance ) {
	
		extract( $args, EXTR_SKIP );
		
		$twitter = empty( $instance['twitter']) ? '' : apply_filters( 'twitter', $instance['twitter'] );
		$facebook = empty( $instance['facebook']) ? '' : apply_filters( 'facebook', $instance['facebook'] );
		$display = empty( $instance['display']) ? '' : apply_filters( 'display', $instance['display'] );
		
		// Display the widget
		include( plugin_dir_path( __FILE__ ) .  'views/widget.php' );
		
	} // end widget
	
	/**
	 * Processes the widget's options to be saved.
	 *
	 * @new_instance	The previous instance of values before the update.
	 * @old_instance	The new instance of values to be generated via the update.
	 */
	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['twitter'] = strip_tags( stripslashes( $new_instance['twitter'] ) );
		$instance['facebook'] = strip_tags( stripslashes( $new_instance['facebook'] ) );
		$instance['display'] = strip_tags( stripslashes( $new_instance['display'] ) );


		$this->delete_values( 'twitter', $old_instance );
		$this->delete_values( 'twitter', $instance );
		
		$this->delete_values( 'facebook', $old_instance );
		$this->delete_values( 'facebook', $instance );

		return $instance;
		
	} // end widget
	
	/**
	 * Generates the administration form for the widget.
	 *
	 * @instance	The array of keys and values for the widget.
	 */
	public function form( $instance ) {

		$instance = wp_parse_args(
			(array)$instance,
			array(
				'twitter'		=>	'',
				'facebook'		=>	'',
				'display'		=>	'both'
			)
		);
    
		$twitter = stripslashes( strip_tags( $instance['twitter'] ) );
		$facebook = stripslashes( strip_tags( $instance['facebook'] ) );
		$display = stripslashes( strip_tags( $instance['display'] ) );

		// Display the admin form
		include( plugin_dir_path( __FILE__ ) .  'views/admin.php' );
		
	} // end form

	/*--------------------------------------------------------*
	 * Helper Functions
	 *--------------------------------------------------------*/

	/** 
	 * Registers and Enqueues the stylesheets for the Media Uploader and this widget.
	 */
	public function register_admin_styles() {
		wp_enqueue_style( 'standard-influence', get_template_directory_uri() . '/lib/influence/css/admin.css' );
	} // end register_admin_styles

	/*--------------------------------------------------------*
	 * Private Functions
	 *--------------------------------------------------------*/

	/** 
	 * Retrieves the number of followers for the incoming username.
	 *
	 * The function fill first check the cache to see if it's available. If not,
	 * a request will be sent to Twitter for a JSON response. If the request or
	 * the response fails, then the follower count value will be given a negative
	 * value.
	 *
	 * Error codes:
	 * -1: Uninitialize value
	 * -2: Problem with a response from Twitter
	 * -3: Problem decoding the JSON returned from Twitter
	 *
	 * @params	$username	The username of the Twitter account from which to pull followers
	 *
	 * @returns	The total number of followers for the given Twitter account.
	 */
	private function twitter_follower_count( $username, $debug = false ) {
	
		// This represents an uninitialize value
		$follower_count = -1;
		
		// Key values for the database
		$transient_key = 'influence_twitter_' . $username;

		// Check to see if the value exists in the cache and it isn't 0
		if( ! true == get_transient( $transient_key ) && 0 < get_transient( $transient_key ) ) {
			
			$follower_count = get_transient( $transient_key );

		// If the value doesn't exist as a transient, let's read the value from Twitter	 
		} else {

			// Attempt to read the XML from Twitter
			$response = $this->get_feed_response( 'https://twitter.com/users/' . $username . '.json' );
			try {
				$json = json_decode( $response );
			} catch ( Exception $ex ) {
				$json = null;
			} // end try/catch
			
			// If the XML response isn't valid, store the error
			if( null == $json ) {
			
				$follower_count = -2;
				
			} else {
				
				// If it's null, store the error.
				if( null == (string)$json->followers_count ) {
					
					$follower_count = -3;
				
				// Otherwise, we're good to go
				} else {

					$follower_count = (string)$json->followers_count;
					
				} // end if/else
				
			} // end if/else
			
		} // end if/else
		
		// And cache it for 24 hours
		set_transient( $transient_key, $follower_count, 60 * 60 * 24 );
		
		// If debug mode is running, return the raw follower count; otherwise, return the value or 0 if it's an error.
		$follower_count = $debug ? $follower_count : ( $follower_count <= 0 ? 0 : $follower_count );
		
		return $follower_count;
		
	} // end twitter_follower_count
	
	/** 
	 * Retrieves the number of likes for the incoming username.
	 *
	 * The function fill first check the cache to see if it's available. If not,
	 * a request will be sent to Facebook for a JSON response. If the request or
	 * the response fails, then the follower count value will be given a negative
	 * value.
	 *
	 * Error codes:
	 * -1: Uninitialize value
	 * -2: Problem with a response from Facebook
	 * -3: Problem decoding the JSON returned from Facebook
	 *
	 * @params	$username	The username of the Facebook page from which to pull likes
	 *
	 * @returns	The total number of likes for the given Facebook page.
	 */
	private function facebook_like_count( $username, $debug = false ) {
	
		// This represents an uninitialize value
		$like_count = -1;
		
		// Key values for the database
		$transient_key = 'influence_facebook_' . $username;
		
		// Check to see if the value exists in the cache and it isn't 0
		if( true == get_transient( $transient_key ) && 0 < get_transient( $transient_key ) ) {
			
			$like_count = get_transient( $transient_key );
			 
		} else {
			
			// If it's not present, then we attempt to contact Facebook
			$response = $this->get_feed_response( 'http://graph.facebook.com/' . $username . '/' );
			
			// If the response is null, then the response from Twitter failed
			if( null == $response ) {
				
				$like_count = -2;
				
			// Otherwise, we have a response so let's parse it
			} else {
			
				// Decode the JSON string and attempt to ready the follower count value
				$facebook = json_decode( $response );
				if( isset( $facebook->likes ) ) {
					$like_count = $facebook->likes;
				} else {
					$like_count = -3;
				} // end if
			
			} // end if
			
		} // end if/else
		
		// And cache it for 24 hours
		set_transient( $transient_key, $like_count, 60 * 60 * 24 );
		
		// If debug mode is running, return the raw follower count; otherwise, return the value or 0 if it's an error.
		$like_count = $debug ? $like_count : ( $like_count <= 0 ? 0 : $like_count );
		
		return $like_count;

	} // end facebook_like_count
	
	
	/** 
	 * Retrieves the total number of subscribers for each account.
	 *
	 * @params	$twitter	The Twitter username from which to pull followers
	 * @params	$facebook	The ID of the Facebook page from which to pull likes
	 *
	 * @returns	The total influence as calculated by all three services.
	 */
	private function get_total_influence_count( $twitter, $facebook, $debug = false ) {
	
		$influence = 0;
	
		if( '' != $twitter ) { 
			$influence += $this->twitter_follower_count( $twitter, $debug );
		} // end if
		
		if( '' != $facebook ) {
			$influence += $this->facebook_like_count( $facebook, $debug );
		} // end if
	
		return $influence;
	
	} // end get_total_influence_count
	
	/**
	 * Helper functions for easily deleting transient and option values from the database.
	 *
	 * @params	$key		The ID of the option to remove
	 * @params	$instance	Which instance of the widget to remove
	 */
	private function delete_values( $key, $instance ) {
		
		delete_transient( 'influence_' . $key . '_' . $instance[$key] );
		
		// If the option exists, we need to delete it. This is a carry over from < 3.0.2.
		// We can eventually remove this line, perhaps in 3.1.
		if( true == get_option( 'influence_' . $key . '_' . $instance[$key] ) ) {
			delete_option( 'influence_' . $key . '_' . $instance[$key] );
		} // end if
		
	} // end delete_values
	
	/**
	 * Retrieves the response from the specified URL using one of PHP's outbound request facilities.
	 *
	 * @params	$url	The URL of the feed to retrieve.
	 * @returns			The response from the URL; null if empty.
	 */
	private function get_feed_response( $url ) {
		
		$response = null;
		
		// First, check to see if curl is enabled. If so, we'll use it.
		if( function_exists( 'curl_init' ) ) {
			$response = $this->curl( $url );
		} elseif( function_exists( 'file_get_contents' ) ) {
			$response = $this->file_get_contents( $url );
		} // end if
		
		return $response;
		
	} // end get_feed_response
	
	/**
	 * Retrieves the response from the specified URL using PHP's cURL module.
	 *
	 * @params	$url	The URL of the feed to retrieve.
	 * @returns			The response from the URL.
	 */
	private function curl( $url ) {

		$curl = curl_init( $url );

		curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $curl, CURLOPT_HEADER, false );
		curl_setopt( $curl, CURLOPT_USERAGENT,  '' );
		
		// Increasing the TIMEOUT in hopes that it works better for some hosting environments
		curl_setopt( $curl, CURLOPT_TIMEOUT, 10000 );
		
		$response = curl_exec( $curl );
		if( 0 !== curl_errno( $curl ) || 200 !== curl_getinfo( $curl, CURLINFO_HTTP_CODE ) ) {
			$response = null;
		} // end if
		curl_close( $curl );
		
		return $response;
		
	} // end curl
	
	/**
	 * Retrieves the response from the specified URL using PHP's file_get_contents method.
	 *
	 * @params	$url	The URL of the feed to retrieve.
	 * @returns			The response from the URL.
	 */
	private function file_get_contents( $url ) {
		return file_get_contents( $url );
	} // end file_get_contents
	
	/**
	 * Determines if the current hosting platform supports curl or file_get_contents for making outbound requests.
	 *
	 * @returns		True if the server supports outbound requests; false, otherwise.
	 */
	private function supports_outbound_requests() {
		return function_exists( 'curl_init' ) || function_exists( 'file_get_contents' );
	} // end supports_outbound_requests

} // end class
add_action( 'widgets_init', create_function( '', 'register_widget( "Standard_Influence" );' ) ); 