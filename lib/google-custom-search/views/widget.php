<?php
/**
 * Renders the the Google Custom Search widget.
 *
 * @package		Standard
 * @subpackage	Google Custom Search
 * @version 	2.0
 * @since		3.0
 */
?>
<?php if( '' != $gcse_content ) { ?>
	<?php echo $args['before_widget']; ?>
	<script type="text/javascript">
	  (function() {
	    var cx = '<?php echo $gcse_content; ?>';
	    var gcse = document.createElement('script'); gcse.type = 'text/javascript'; gcse.async = true;
	    gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
	        '//www.google.com/cse/cse.js?cx=' + cx;
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(gcse, s);
	  })();
	</script>
	<gcse:searchbox-only resultsUrl="<?php echo get_permalink( get_page_by_path( 'search-results' ) ); ?>" newWindow="false" queryParameterName="q"></gcse:searchbox-only>
	<?php echo $args['after_widget']; ?>
<?php } // end if ?>