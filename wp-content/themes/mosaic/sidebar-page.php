<?php
/**
 * The Sidebar containing the secondary Page widget area.
 *
 * @package Mosaic
 * @author Wild Web Lab - www.wildweblab.com 
 * @since Mosaic 1.0
 */
?>
<?php do_action('mosaic_before_sidebar');?>

<?php // secondary widget area
	if ( is_active_sidebar( 'secondary-widget-area' ) ) : ?>
	<ul>
		<?php dynamic_sidebar( 'secondary-widget-area' ); ?>
	</ul>
	<?php endif; // end secondary widget area ?>

<?php do_action('mosaic_after_sidebar');?>

