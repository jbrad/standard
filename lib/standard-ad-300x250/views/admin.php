<?php
/**
 * Renders the administration dashboard for the 300x250 widget.
 *
 * @package		Standard
 * @subpackage	300x250 Advertisement
 * @version 	1.0
 * @since		3.0
 */
?>
<div class="standard-ad-300x250-wrapper">

	<div class="preview_image_container">
		<img src="<?php echo '' == $ad_src ? '' : $ad_src; ?>" alt="" class="preview_image" />
	</div><!-- /.preview_image_container -->
	
	<!-- Hidden fields used to track uploaded images and links -->
	<input type="hidden" id="<?php echo $this->get_field_id( 'ad_src' ); ?>" name="<?php echo $this->get_field_name( 'ad_src' ); ?>" value="<?php echo $ad_src; ?>" class="ad_src" />
	<input type="hidden" id="<?php echo $this->get_field_id( 'ad_url' ); ?>" name="<?php echo $this->get_field_name( 'ad_url' ); ?>" value="<?php echo $ad_url; ?>" class="ad_url" />
	<input type="hidden" class="widget-parent-id" value="" />
	<!-- /Hidden fields -->

	<a href="javascript:;" class="ad_delete ad-delete <?php echo ('' == $ad_url && '' == $ad_src) ? 'hidden' : '' ?>"><?php _e( 'Delete Advertisement', 'standard' ); ?></a>
	
</div><!-- /.standard-ad-300x250-wrapper -->