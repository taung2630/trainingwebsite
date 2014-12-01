<?php
/**
 * The template for displaying attachments.
 *
 * @package Mosaic
 * @author Wild Web Lab - www.wildweblab.com 
 * @since Mosaic 1.0
 */

get_header();
mosaic_before_content('sixteen');
/* 
 * Run the loop to output the attachment.
 * If you want to overload this in a child theme then include a file
 * called loop-attachment.php and that will be used instead.
 */
get_template_part( 'loop', 'attachment' );
mosaic_after_content();
/*
 * Close #content-sidebar-wrap when there is no sidebar.
 */
echo '</div><!-- /#content-sidebar-wrap -->';
get_footer();
?>