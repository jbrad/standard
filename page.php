<?php
/**
 * The template for displaying single pages.
 *
 * @package Standard
 * @since 	3.0
 * @version	3.1
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
							
				<div id="main" class="<?php echo 'full_width_layout' == $presentation_options['layout'] ? 'span12 fullwidth' : 'span8'; ?> clearfix" role="main">
				
					<?php 
						if( ! is_front_page() ) {
							get_template_part( 'breadcrumbs' );
						} // end if
					?>
				
					<?php if ( have_posts() ) { ?>
						<?php while ( have_posts() ) { ?>
							<?php the_post(); ?>
							<div id="post-<?php the_ID(); ?> format-standard" <?php post_class( 'post' ); ?>>
								<div class="post-header clearfix">
									<h1 class="post-title entry-title"><?php the_title(); ?></h1>	
								</div> <!-- /.post-header -->						
								<div id="content-<?php the_ID(); ?>" class="entry-content clearfix">
									<div class="content">
										<?php the_content(); ?>
									</div><!-- /.entry-content -->
								</div><!-- /.entry-content -->
							</div> <!-- /#post -->
						<?php } // end while ?>
					<?php } // end if ?>
					<?php comments_template( '', true ); ?>
				</div><!-- /#main -->
			
				<?php if ( 'right_sidebar_layout' == $presentation_options['layout'] ) {  ?>
					<?php get_sidebar(); ?>
				<?php } // end if ?>
				
		</div><!--/ row -->
	</div><!--/container -->
</div> <!-- /#wrapper -->
<?php get_footer(); ?>