<?php
/**
 * Renders the the 468x60 widget
 *
 * @package		Standard
 * @subpackage	468x60 Advertisement
 * @version 	1.2
 * @since		3.0
 */
?>

<?php $global_options = get_option( 'standard_theme_global_options' ); ?>

<?php echo $args['before_widget']; ?>
	<?php echo $this->display_ad( $ad_src, $ad_url ); ?>
<?php echo $args['after_widget']; ?>