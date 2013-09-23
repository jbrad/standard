<?php
/**
 * The template for rendering images and attached images.
 *
 * @package Standard
 * @since 	3.0
 * @version	3.0
 */
?>
<?php get_header(); ?>
<?php $presentation_options = get_option( 'standard_theme_presentation_options' ); ?>

<div id="wrapper">
	<div class="container">
		<div class="row">
 
			<?php if ( 'left_sidebar_layout' == $presentation_options['layout'] ) { ?>
				<?php get_sidebar(); ?>
			<?php } // end if ?>
			
			<div id="main" class="<?php echo 'full_width_layout' == $presentation_options['layout'] ? 'span12 fullwidth' : 'span8'; ?>" role="main">
			
				<?php get_template_part( 'breadcrumbs' ); ?>
				
				<?php if ( have_posts() ) { ?>
					<?php while ( have_posts() ) { ?>
						<?php the_post(); ?>
						
						<div id="post-<?php the_ID(); ?>" <?php post_class( 'post format-standard' ); ?>>
						
							<div class="post-header clearfix">
								<div class="title-wrap">
									<h1 class="post-title entry-title"><?php the_title(); ?></h1>	
									<div class="post-header-meta">
										<?php if( strlen( trim( get_the_title() ) ) == 0 ) { ?>
											<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf( esc_attr__( 'Permalink to %s', 'standard' ), the_title_attribute( 'echo=0' ) ); ?>"><span class="the-time updated"><?php the_time( get_option( 'date_format' ) ); ?></span></a>
										<?php } else { ?>
											<span class="the-time updated"><?php the_time( get_option( 'date_format' ) ); ?></span>
										<?php } // end if/else ?>
									</div><!-- /.post-header-meta -->
								</div><!-- /.title-wrap -->
							</div> <!-- /.post-header -->
						
							<div id="content-<?php the_ID(); ?>" class="entry-content">	
								<div class="content">
									<?php $image_attributes = wp_get_attachment_image_src( $attachment_id, 'large' ); ?>
									<img src="<?php echo esc_url( $image_attributes[0] ); ?>" width="<?php echo $image_attributes[1]; ?>" height="<?php echo $image_attributes[2]; ?>" />
								</div><!-- ./content -->
								<div id="image-thumbnails" class="clearfix">
									<div class="fl">
										<?php previous_image_link(); ?>
									</div>
									<div class="fr">
										<?php next_image_link(); ?>
									</div>
								</div><!-- /#image-thumbmails -->
							</div><!-- /.entry-content -->
						</div> <!-- /#post -->						
						<?php comments_template( '', true ); ?>
						<?php get_template_part( 'pagination' ); ?>
						
					<?php } // end while ?>
				<?php } // end if  ?>
			</div><!-- /#main -->
		
			<?php if ( 'right_sidebar_layout' == $presentation_options['layout'] ) { ?>
				<?php get_sidebar(); ?>
			<?php } // end if ?>
	
		</div><!-- /.row -->
	</div><!-- /.container -->
</div><!-- /#wrapper -->

<?php get_footer(); ?>