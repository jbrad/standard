<?php
/**
 * The template for displaying standard post formats.
 * 
 * @package Standard
 * @since 	3.0
 * @version	3.1
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class( 'post clearfix' ); ?>>

	<div class="aside-date">
		<span class="the-date"><?php the_time('M'); ?></span>
		<span class="the-time"><?php the_time('j'); ?></span>
	</div><!--/aside-date -->

	<div id="content-<?php the_ID(); ?>" class="entry-content clearfix">
	
		<p class="aside-post-title"><?php the_title(); ?></p>
	
		<?php if( ( is_category() || is_archive() || is_home() ) && has_excerpt() ) { ?>
			<?php the_excerpt( ); ?>
			<a href="<?php echo get_permalink(); ?>"><?php _e( 'Continue Reading...', 'standard' ); ?></a>
		<?php } else { ?>
			<?php the_content( __( 'Continue Reading...', 'standard' ) ); ?>
		<?php } // end if/else ?>
		<?php 
			wp_link_pages( 
				array( 
					'before' 	=> '<div class="page-link"><span>' . __( 'Pages:', 'standard' ) . '</span>', 
					'after' 	=> '</div>' 
				) 
			); 
		?>
	</div><!-- /.entry-content -->
	
	<div class="post-meta clearfix">
		
		<div class="meta-comment-link pull-right">
			<a class="pull-right post-link" href="<?php the_permalink(); ?>" title="<?php esc_attr_e( 'permalink', 'standard' ); ?>">&nbsp;<img src="<?php echo esc_url( get_template_directory_uri() . '/images/icn-permalink.png' ); ?>" alt="<?php esc_attr_e( 'permalink', 'standard' ); ?>" /></a>
			<?php if ( '' != get_post_format() ) { ?>
				<span class="the-comment-link"><?php comments_popup_link( __( 'Leave a comment', 'standard' ), __( '1 Comment', 'standard' ), __( '% Comments', 'standard' ), '', ''); ?></span>
			<?php } // end if ?>
		</div><!-- /meta-comment-link -->

	</div><!-- /.post-meta -->
</div><!-- /#post -->