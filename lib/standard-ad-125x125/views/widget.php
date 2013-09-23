<?php
/**
 * Renders the the 125x125 widget
 *
 * @package		Standard
 * @subpackage	125x125 Advertisement
 * @version 	1.1
 * @since		3.0
 */
?>
<?php $global_options = get_option( 'standard_theme_global_options' ); $default_url = ''; ?>

<?php echo isset( $args['before_widget'] ) ? $args['before_widget'] : ''; ?>
	<div class="row-fluid">
		<div class="standard-ad-row">
			<ul class="thumbnails mobile-2">
				<li class="span6">
					<div class="thumbnail">
						<?php echo $this->display_ad( $ad1_src, $ad1_url, 1 ); ?>
					</div><!--/.thumbnail -->
				</li><!-- /.left -->
				<li class="span6">
					<div class="thumbnail">
						<?php echo $this->display_ad( $ad2_src, $ad2_url, 2 ); ?>
					</div><!-- /.thumbnail -->
				</li><!-- /.right -->
			</ul><!-- /.thumbnails -->
		</div><!-- /.standard-ad-row -->
	</div><!-- /.row-fluid -->
<?php echo isset( $args['after_widget'] ) ? $args['after_widget'] : ''; ?>