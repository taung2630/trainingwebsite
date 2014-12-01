<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Mosaic
 * @author Wild Web Lab - www.wildweblab.com 
 * @since Mosaic 1.0
 */

get_header();
mosaic_before_content($columns='');
?>
	<h1><?php _e( 'Not Found', 'mosaic' ); ?></h1>
	<p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'mosaic' ); ?></p>
	<?php get_search_form(); ?>
	
	<script type="text/javascript">
		// focus on search field after it has loaded
		document.getElementById('s') && document.getElementById('s').focus();
	</script>

<?php
mosaic_after_content();
get_sidebar();
get_footer();
?>