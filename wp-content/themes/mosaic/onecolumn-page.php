<?php
/**
 * No Sidebar or Page Title
 *
 * @package Mosaic
 * @author Wild Web Lab - www.wildweblab.com 
 * @since Mosaic 1.0
*/

get_header();
mosaic_before_content($columns='');
get_template_part( 'loop', 'page' );
mosaic_after_content();
get_footer();
?>
