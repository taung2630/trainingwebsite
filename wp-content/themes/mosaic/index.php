<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query. 
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Mosaic
 * @author Wild Web Lab - www.wildweblab.com 
 * @since Mosaic 1.0
 */
get_header();
mosaic_before_content($columns='');
get_template_part( 'loop', 'index' );
mosaic_after_content();
get_sidebar();
get_footer();
?>