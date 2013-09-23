<?php
/**
 * Renders the administration dashboard for the 125x125 widget.
 *
 * @package		Standard
 * @subpackage	125x125 Advertisement
 * @version 	1.0
 * @since		3.0
 */
?>
<div class="standard-ad-125x125-wrapper">

	<div class="ads">
	
		<div class="row ad-125x125-row">
			<span class="left 125x125-1">
				<img src="<?php echo '' == $ad1_src ? '' : $ad1_src; ?>" alt="" width="90" height="90" class="125x125-1-preview" />
				<input type="hidden" id="<?php echo $this->get_field_id( 'ad1_src' ); ?>" name="<?php echo $this->get_field_name( 'ad1_src' ); ?>" class="125x125-1-src" value="<?php echo '' == $ad1_src ? '' : $ad1_src; ?>" />
				<input type="hidden" id="<?php echo $this->get_field_id( 'ad1_url' ); ?>" name="<?php echo $this->get_field_name( 'ad1_url' ); ?>" class="125x125-1-url" value="<?php echo '' == $ad1_url ? '' : $ad1_url; ?>" />
				<?php if( '' != $ad1_src ) { ?>
					<a href="javascript:;" class="125x125-1-delete ad-delete"><?php _e( 'Delete', 'standard' ); ?></a>
				<?php } // end if ?>
			</span>
			<span class="right 125x125-2">
				<img src="<?php echo '' == $ad2_src ? '' : $ad2_src; ?>" alt="" width="90" height="90" class="125x125-2-preview" />
				<input type="hidden" id="<?php echo $this->get_field_id( 'ad2_src' ); ?>" name="<?php echo $this->get_field_name( 'ad2_src' ); ?>" class="125x125-2-src" value="<?php echo '' == $ad2_src ? '' : $ad2_src; ?>" />
				<input type="hidden" id="<?php echo $this->get_field_id( 'ad2_url' ); ?>" name="<?php echo $this->get_field_name( 'ad2_url' ); ?>" class="125x125-2-url" value="<?php echo '' == $ad2_url ? '' : $ad2_url; ?>" />
				<?php if( '' != $ad2_src ) { ?>
					<a href="javascript:;" class="125x125-2-delete ad-delete"><?php _e( 'Delete', 'standard' ); ?></a>
				<?php } // end if ?>
			</span>
		</div><!-- /.row -->
		
	</div><!-- /.ads -->

</div><!-- /.standard-ad-125x125-wrapper -->