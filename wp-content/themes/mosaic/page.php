<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the wordpress construct of pages
 * and that other 'pages' on your wordpress site will use a
 * different template.
 *
 * @package Mosaic
 * @author Wild Web Lab - www.wildweblab.com 
 * @since Mosaic 1.0
 */
// You can override via functions.php conditionals or define:
// $columns = 'four';

get_header();
mosaic_before_content($columns='');
get_template_part( 'loop', 'page' );
mosaic_after_content();
get_sidebar();
get_footer();
?>