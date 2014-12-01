<?php 
/**
 * Template Name: Full Width
 * 
 * The template for displaying the full width page. It removes the sidebar area.
 * 
 * @package Mosaic
 * @author Wild Web Lab - www.wildweblab.com 
 * @since Mosaic 1.5
 */

function mosaic_nosidebar_hompage() {
	return array('no-sidebar');
}
add_filter('mosaic_layout_classes', 'mosaic_nosidebar_hompage');

get_header();
mosaic_before_content( $columns='' );
get_template_part( 'loop', 'page' );
mosaic_after_content();
?> 
</div> <!--/#content-sidebar-wrap-->
<?php
get_footer();
?>