<?php
/**
 * The template for displaying link post formats.
 *
 * @package Standard
 * @since 	3.0
 * @version	3.1
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class( 'post format-link clearfix' ); ?>>

	<div class="post-header clearfix">


		<?php

			// Read the attribute of the anchor from the post format
			$title = standard_get_link_post_format_attribute( 'title' );
			$href = standard_get_link_post_format_attribute( 'href' );
			$target = strlen( standard_get_link_post_format_attribute( 'target' ) ) > 0 ? standard_get_link_post_format_attribute( 'target' ) : '_blank';

			// And attempt to read the link from the post meta
			$href = ( '' == get_post_meta( get_the_ID(), 'standard_link_url_field', true ) ) ? $href : get_post_meta( get_the_ID(), 'standard_link_url_field', true );
			$post_title = strip_tags( stripslashes( get_the_title() ) );
			$content = strip_tags( get_the_content() );

		?>

		<?php if( is_single() && '' !== get_the_title() ) { ?>
			<h1 class="post-title entry-title">
				<?php if( function_exists( 'get_the_post_format_url' ) ) { ?>
					<a href="<?php echo standard_get_link_url(); ?>" title="<?php echo $post_title; ?>" target="_blank" rel="bookmark">
						<?php echo $post_title; ?>
					</a>
				<?php } else { ?>
					<a href="<?php echo $href; ?>" title="<?php echo strlen( trim( $title ) ) > 0 ? $title : $post_title; ?>" target="<?php echo $target; ?>" rel="bookmark">
						<?php if( strlen( trim( $post_title ) ) > 0 ) { ?>
							<?php echo $post_title; ?>
						<?php } elseif( strlen( trim( $title ) ) > 0 ) { ?>
							<?php echo $title; ?>
						<?php } elseif( '' != $meta_href ) { ?>
							<?php the_content(); ?>
						<?php } else { ?>
							<?php echo $content; ?>
						<?php } // end if ?>
					</a>
				<?php } // end if/else ?>
			</h1>
		<?php } else { ?>
			<h2 class="post-title entry-title">
				<a href="<?php echo $href; ?>" title="<?php echo strlen( trim( $title ) ) > 0 ? $title : $post_title; ?>" target="<?php echo $target; ?>" rel="bookmark">
					<?php if( strlen( trim( $post_title ) ) > 0 ) { ?>
						<?php echo $post_title; ?>
					<?php } elseif( strlen( trim( $title ) ) > 0 ) { ?>
						<?php echo $title; ?>
					<?php } elseif( '' != $meta_href ) { ?>
						<?php the_content(); ?>
					<?php } else { ?>
						<?php echo $content; ?>
					<?php } // end if ?>
				</a>
			</h2>
		<?php } // end if ?>

	</div><!-- /.post-header -->

	<div id="content-<?php the_ID(); ?>"  class="entry-content clearfix">
		<?php if ( 0 < strlen( trim( get_the_content() ) ) ) { ?>
			<p>
				<?php the_content(); ?>
			</p>
		<?php } // end if ?>
	</div><!-- /.entry-content -->

	<div class="post-meta clearfix">

			<div class="meta-date-cat-tags pull-left">

				<?php if( is_multi_author() ) { ?>
					<span class="the-author">&nbsp;<?php _e( 'Posted by', 'standard' ); ?> <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php echo get_the_author_meta( 'display_name' ); ?>"><?php echo the_author_meta( 'display_name' ); ?></a></span>
					<span class="the-time updated"><?php _e( 'on', 'standard' ); ?>&nbsp;<?php echo get_the_time( get_option( 'date_format' ) ); ?></span>
				<?php } else { ?>
					<?php printf( '<span class="the-time updated">' . __( 'Posted on %1$s', 'standard' ) . '</span>', get_the_time( get_option( 'date_format' ) ) ); ?>
				<?php } // end if ?>

				<?php $category_list = get_the_category_list( __( ', ', 'standard' ) ); ?>
				<?php if( $category_list ) { ?>
					<?php printf( '<span class="the-category">' . __( 'In %1$s', 'standard' ) . '</span>', $category_list ); ?>
				<?php } // end if ?>

				<?php $tag_list = get_the_tag_list( '', __( ', ', 'standard' ) ); ?>
				<?php if( $tag_list ) { ?>
					<?php printf( '<span class="the-tags">' . __( '%1$s', 'standard' ) . '</span>', $tag_list ); ?>
				<?php } // end if ?>

			</div><!-- /.meta-date-cat-tags -->

			<div class="meta-comment-link pull-right">
				<a class="pull-right post-link" href="<?php the_permalink(); ?>" title="<?php esc_attr_e( 'permalink', 'standard' ); ?>">&nbsp;<img src="<?php echo esc_url( get_template_directory_uri() . '/images/icn-permalink.png' ); ?>" alt="<?php esc_attr_e( 'permalink', 'standard' ); ?>" /></a>
				<?php if ( '' != get_post_format() ) { ?>
					<span class="the-comment-link"><?php comments_popup_link( __( 'Leave a comment', 'standard' ), __( '1 Comment', 'standard' ), __( '% Comments', 'standard' ), '', ''); ?></span>
				<?php } // end if ?>
			</div><!-- /meta-comment-link -->

	</div><!-- /.post-meta -->
</div> <!-- /#post -->