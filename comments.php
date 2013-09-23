<?php
/**
 * The template for displaying comments, pings, and trackbacks on posts, pages, and attachments.
 * 
 * @package Standard
 * @since 	3.1
 * @version	3.0
 */
?>
<?php 
	if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
		die ( __( 'This file cannot be loaded directly.', 'standard' ) );
	} // end if
?>

<?php if ( post_password_required() ) { ?>
	<div id="comments">
		<h3 class="nopassword"><?php _e( 'This post is password protected. Enter the password to view comments.', 'standard' ); ?></h3>
	</div><!-- #comments -->
	<?php return; ?>
<?php } // end if	?>

<?php if ( have_comments() ) { ?>

	<?php if ( ! empty( $comments_by_type['comment'] ) ) { ?>
		<div id="comments" class="clearfix">
			<h3><?php comments_number( __( 'No responses', 'standard' ), __( 'One response', 'standard' ), __( '% responses', 'standard' ) );?> <?php _e( 'to',  'standard' ); ?> <em><?php the_title(); ?></em></h3>
			<ol class="commentlist">
				<?php wp_list_comments( 'avatar_size=50&callback=standard_custom_comment&type=comment' ); ?>
			</ol>    
			<div class="comment-navigation clearfix">
				<div class="comment-prev-nav">
					<?php previous_comments_link( '<i class="icon-chevron-left"></i>' . __( 'Previous Comments', 'standard' ) ); ?>
				</div>
				<div class="comment-next-nav">
					<?php next_comments_link( __( 'Next Comments', 'standard' ) . '<i class="icon-chevron-right"></i>'); ?>
				</div>
			</div>
		</div><!-- /#comments -->
	<?php } // end if ?>

	<?php if ( ! empty( $comments_by_type['pings'] ) ) { ?>
		<div id="pings">
			<h3>
				<?php _e( 'Trackbacks and Pingbacks:', 'standard' ); ?>
			</h3>
			<ol class="pinglist">
				<?php wp_list_comments( 'type=pings&callback=list_pings&per_page=-1' ); ?>
			</ol>
		</div><!-- /#pings -->
	<?php } // end if ?>	
	
<?php } else { ?>

	<?php if( comments_open() ) { ?>
		<div id="no-comments" class="clearfix">
			<p class="title"><?php _e( 'No Comments', 'standard' ); ?></p>
			<p><?php _e( 'Be the first to start the conversation.', 'standard' ); ?></p>
		</div><!-- /#no-comments -->
	<?php } // end if ?>
	
<?php } // end if ?>

<?php standard_comment_form(); ?>