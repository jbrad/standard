<?php
/**
 * Template Name: Full-Width Template 
 *
 * The template for rendering pages without sidebars.
 * 
 * @package Standard
 * @since 	3.0
 * @version	3.1
 */
?>
<?php get_header(); ?>

<div id="wrapper">
	<div class="container">
		<div class="row">
			<div id="main" class="span12 clearfix" role="main">
				
				<?php get_template_part( 'breadcrumbs' ); ?>
			
				<?php if ( have_posts() ) { ?>
					<?php while ( have_posts() ) { ?>
						<?php the_post(); ?>
						<div id="post-<?php the_ID(); ?> format-standard" <?php post_class( 'post' ); ?>>
							<div class="post-header clearfix">
								<h1 class="post-title entry-title"><?php the_title(); ?></h1>	
							</div> <!-- /.post-header -->						
							<div id="content-<?php the_ID(); ?>" class="entry-content">
								<?php the_content(); ?>
							</div><!-- /.entry-content -->
						</div> <!-- /#post -->
					<?php } // end while ?>
				<?php } // end if ?>
				<?php comments_template( '', true ); ?>
			</div><!-- /#main -->
			
		</div><!--/row -->
	</div><!-- /container -->
</div> <!-- /#wrapper -->
<?php get_footer(); ?>