<?php
/**
 * A widget for displaying a personal image and an optional description for displaying in the sidebar
 * of Standard.
 *
 * @package		Standard
 * @subpackage	Personal Image Widget
 * @version		1.0
 * @since		3.0
 */
class Standard_Personal_Image extends WP_Widget {

	/*--------------------------------------------------------*
	 * Constructor
	 *--------------------------------------------------------*/

	/**
	 * Initializes the widget's classname, description, and JavaScripts.
	 */
	public function __construct() {

		$widget_opts = array(
			'classname' 	=> __( 'personal-image', 'standard' ),
			'description' 	=> __( 'Display a personal image and an optional description.', 'standard' )
		);
		$this->WP_Widget( 'standard-personal-image', __( 'Personal Image', 'standard' ), $widget_opts );

		// We don't want to load these on the Appearance Options because we're overiding window.send_to_editor there, too.
		global $pagenow;
		if( 'themes.php' != $pagenow ) {

			add_action( 'admin_print_styles', array( $this, 'register_admin_styles' ) );

		} // end if

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
	 * @version	1.0
	 */
	public function widget( $args, $instance ) {

		extract( $args, EXTR_SKIP );

		$image_src = empty( $instance['image_src']) ? '' : apply_filters( 'image_src', $instance['image_src'] );
		$image_url = empty( $instance['image_url']) ? '' : apply_filters( 'image_url', $instance['image_url'] );
		$image_description = empty( $instance['image_description']) ? '' : apply_filters( 'image_description', $instance['image_description'] );

		// Display the widget
		include( plugin_dir_path( __FILE__ ) .  'views/widget.php' );

	} // end widget

	/**
	 * Processes the widget's options to be saved.
	 *
	 * @param  array   $new_instance	The previous instance of values before the update.
	 * @param  array   $old_instance	The new instance of values to be generated via the update.
	 * @return array                    The updated instance of the widget.
	 * @since	3.0
	 * @version	1.4
	 */
	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['image_src'] = strip_tags( stripslashes( $new_instance['image_src'] ) );
		$instance['image_url'] = strip_tags( stripslashes( $new_instance['image_url'] ) );

		// we'll allow css and html, but no javascript
		$instance['image_description'] = preg_replace( '/<script\b[^>]*>(.*?)<\/script>/is', '', $new_instance['image_description'] );

		return $instance;

	} // end widget

	/**
	 * Generates the administration form for the widget.
	 *
	 * @param	array $instance	The array of keys and values for the widget.
 	 * @since	3.0
	 * @version	1.0
	 */
	public function form( $instance ) {

		$instance = wp_parse_args(
			(array)$instance,
			array(
				'image_src' 		=> '',
				'image_url' 		=> '',
				'image_description'	=> ''
			)
		);

		$image_src = esc_url( $instance['image_src'] );
		$image_url = esc_url( $instance['image_url'] );
		$image_description = esc_textarea( $instance['image_description'] );

		// Display the admin form
		include( plugin_dir_path( __FILE__ ) .  'views/admin.php' );

	} // end form

	/*--------------------------------------------------------*
	 * Helper Functions
	 *--------------------------------------------------------*/

	/**
	 * Registers and Enqueues the stylesheets for the Media Uploader and this widget.
	 *
	 * @since	3.0
	 * @version	1.0
	 */
	public function register_admin_styles() {
		wp_enqueue_style( 'standard-personal-image', get_template_directory_uri() . '/lib/personal-image/css/admin.css', array( 'thickbox' ), STANDARD_THEME_VERSION );
	} // end register_admin_styles

} // end class
add_action( 'widgets_init', create_function( '', 'register_widget( "Standard_Personal_Image" );' ) );