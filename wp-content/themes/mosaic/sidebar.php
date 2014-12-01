<?php
/**
 * The Sidebar containing the primary blog sidebar
 *
 * @package Mosaic
 * @author Wild Web Lab - www.wildweblab.com 
 * @since Mosaic 1.0
 */
?>
<?php do_action('mosaic_before_sidebar');?>

<?php // primary widget area
	if ( is_active_sidebar( 'primary-widget-area' ) ) : ?>
	<ul>
		<?php dynamic_sidebar( 'primary-widget-area' ); ?>
	</ul>
<?php endif; // end primary widget area ?>


<?php do_action('mosaic_after_sidebar');?>

