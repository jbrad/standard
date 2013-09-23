<?php
/**
 * The page that is rendered to the public whenever the theme is set in offline mode.
 *
 * @package Standard
 * @since 	3.0
 * @version	3.1
 */
?>
<?php get_header(); ?>
	<div class="container">
	
		<?php $options = get_option( 'standard_theme_global_options' ); ?>
			<div class="row" role="main">
				<div class="span12">
					<div id="offline-wrapper">
						<div id="offline-container">
					
						<div id="offline-content">
							<div class="offline-message">
								<p><?php echo $options['offline_message']; ?></p> 
							</div><!--/offline-message -->
							
							<div class="offline-title-wrapper">
								<h1 id="offline-title"><?php bloginfo( 'name' ); ?> <small><?php bloginfo( 'description' ); ?></small></h1>
							</div><!--/offline-title -->
							
						</div><!--/offline-content -->
					</div><!--/offline-container -->
				</div><!--/offline-wrapper -->
			</div><!--/.span12 -->
		</div><!--/.row -->
	
	</div><!-- /container -->
<?php get_footer(); ?>