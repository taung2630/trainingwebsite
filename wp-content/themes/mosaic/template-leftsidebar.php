<?php 
/**
 * Template Name: Left Sidebar
 * 
 * The template for displaying page with sidebar on the left side.
 * 
 * @package Mosaic
 * @author Wild Web Lab - www.wildweblab.com 
 * @since Mosaic 1.6
 */

function mosaic_nosidebar_hompage() {
	return array('left-sidebar');
}
add_filter('mosaic_layout_classes', 'mosaic_nosidebar_hompage');

get_header();
mosaic_before_content( $columns='' );
get_template_part( 'loop', 'page' );
mosaic_after_content();
get_sidebar();
get_footer();
?>