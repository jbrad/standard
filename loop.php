<?php
/**
 * The template for displaying standard post formats.
 *
 * @package Standard
 * @since 	3.0
 * @version	3.2
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class( 'post format-standard clearfix' ); ?>>

	<div class="post-header clearfix">

		<?php $presentation_options = get_option( 'standard_theme_presentation_options' ); ?>
		<?php if ( '' != get_the_post_thumbnail() ) { ?>
			<?php if( $presentation_options['display_featured_images'] == 'always' || ( $presentation_options['display_featured_images'] == 'single-post' && is_single() ) || ( $presentation_options['display_featured_images'] == 'index' && is_home() ) ) { ?>
				<div class="thumbnail alignleft">
					<a class="thumbnail-link fademe" href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( '%s', 'standard' ), the_title_attribute( 'echo=0' ) ); ?>">
						<?php the_post_thumbnail( 'thumbnail' );	?>
					</a>
				</div> <!-- /.thumbnail -->
			<?php } // end if ?>
		<?php } // end if ?>
		<div class="title-wrap clearfix">
			<?php if( '' !== get_the_title() ) { ?>
				<?php if( is_single() || is_page() ) { ?>
					<h1 class="post-title entry-title"><?php the_title(); ?></h1>
				<?php } else { ?>
					<h2 class="post-title entry-title">
						<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf( esc_attr__( '%s', 'standard' ), the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a>
					</h2>
				<?php } // end if ?>
			<?php } // end if ?>
			<div class="post-header-meta">
				<span class="the-author author vcard">
					<span class="fn">
						<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php echo get_the_author_meta( 'display_name' ); ?>">
							<?php echo the_author_meta( 'display_name' ); ?>
						</a>
					</span><!-- /.fn -->
					&nbsp;&mdash;&nbsp;
				</span><!-- /.the-author -->
				<?php if( strlen( trim( get_the_title() ) ) == 0 ) { ?>
					<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf( esc_attr__( '%s', 'standard' ), the_title_attribute( 'echo=0' ) ); ?>"><span class="the-time updated"><?php the_time( get_option( 'date_format' ) ); ?></span></a>
				<?php } else { ?>
					<span class="the-time updated"><?php the_time( get_option( 'date_format' ) ); ?></span>
				<?php } // end if/else ?>
				<?php if( comments_open() ) { ?>
					<span class="the-comment-link">&mdash;&nbsp;<?php comments_popup_link( __( 'Leave a comment', 'standard' ), __( '1 Comment', 'standard' ), __( '% Comments', 'standard' ), '', '' ); ?></span>
				<?php } // end if ?>
			</div><!-- /.post-header-meta -->
		</div><!-- /.title-wrap -->

	</div><!-- /.post-header -->

	<div id="content-<?php the_ID(); ?>" class="entry-content clearfix">
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

		<div class="meta-date-cat-tags pull-left">

			<?php $category_list = get_the_category_list( __( ', ', 'standard' ) ); ?>
			<?php if( $category_list ) { ?>
				<?php printf( '<span class="the-category">' . __( 'In %1$s', 'standard' ) . '</span>', $category_list ); ?>
			<?php } // end if ?>

			<?php $tag_list = get_the_tag_list( '', __( ', ', 'standard' ) ); ?>
			<?php if( $tag_list ) { ?>
				<?php printf( '<span class="the-tags">' . __( '%1$s', 'standard' ) . '</span>', $tag_list ); ?>
			<?php } // end if ?>

		</div><!-- /meta-date-cat-tags -->

		<div class="meta-comment-link pull-right">
			<a class="pull-right post-link" href="<?php the_permalink(); ?>" title="<?php esc_attr_e( 'permalink', 'standard' ); ?>">&nbsp;<img src="<?php echo esc_url( get_template_directory_uri() . '/images/icn-permalink.png' ); ?>" alt="<?php esc_attr_e( 'permalink', 'standard' ); ?>" /></a>
			<?php if ( '' != get_post_format() ) { ?>
				<span class="the-comment-link"><?php comments_popup_link( __( 'Leave a comment', 'standard' ), __( '1 Comment', 'standard' ), __( '% Comments', 'standard' ), '', ''); ?></span>
			<?php } // end if ?>
		</div><!-- /meta-comment-link -->

	</div><!-- /.post-meta -->
</div><!-- /#post -->