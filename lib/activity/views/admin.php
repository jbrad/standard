<?php
/**
 * The template for displaying the admin dashboard.
 *
 * @package		Standard
 * @subpackage	Activity Tabs
 * @version		1.0
 * @since 		3.0
 */
?>
<div class="activity-tabs wrapper">

    <div class="option">
    	<span><?php _e( 'Show', 'standard' ); ?></span>
    	<select name="<?php echo $this->get_field_name( 'post_count' ); ?>" id="<?php echo $this->get_field_id( 'post_count' ); ?>">
    		<?php for( $i = 0; $i <= 10; $i++ ) { ?>
    			<option value="<?php echo $i; ?>" <?php if( $instance['post_count'] == $i ) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
    		<?php } // end for ?>
    	</select>
		<span><?php _e( 'recent posts', 'standard' ); ?></span>
    </div>
    
    <div class="option">
    	<span><?php _e( 'Show', 'standard' ); ?></span>
    	<select name="<?php echo $this->get_field_name( 'popular_count' ); ?>" id="<?php echo $this->get_field_id( 'popular_count' ); ?>">
    		<?php for( $i = 0; $i <= 10; $i++ ) { ?>
    			<option value="<?php echo $i; ?>" <?php if( $instance['popular_count'] == $i ) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
    		<?php } // end for ?>
    	</select>
    	<span><?php _e( 'most commented posts', 'standard' ); ?></span>
    </div>
    
    <div class="option">
	    <span><?php _e( 'Show', 'standard' ); ?></span>
    	<select name="<?php echo $this->get_field_name( 'comment_count' ); ?>" id="<?php echo $this->get_field_id( 'comment_count' ); ?>">
    		<?php for($i = 0; $i <= 10; $i++) { ?>
    			<option value="<?php echo $i; ?>" <?php if( $instance['comment_count'] == $i ) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
    		<?php } // end for ?>
    	</select>
		<span><?php _e( 'recent comments', 'standard' ); ?></span>	
    </div>
    
	 <div class="option">
	    <span><?php _e( 'Show', 'standard' ); ?></span>
    	<select name="<?php echo $this->get_field_name( 'tag_count' ); ?>" id="<?php echo $this->get_field_id( 'tag_count' ); ?>">
    		<?php for( $i = 0; $i <= 50; $i += 10 ) { ?>
    			<option value="<?php echo $i; ?>" <?php if( $instance['tag_count'] == $i ) echo 'selected="selected"'; ?>><?php echo $i; ?></option>
    		<?php } // end for ?>
    	</select>
		<span><?php _e( 'most used tags', 'standard' ); ?></span>	
    </div>
    
</div><!-- /wrapper -->