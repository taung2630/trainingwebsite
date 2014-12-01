<?php
/**
 * The template for displaying Tag Archive pages.
 *
 * @package Mosaic
 * @author Wild Web Lab - www.wildweblab.com 
 * @since Mosaic 1.0
 */

get_header();
mosaic_before_content($columns='');

?>
<h1 id="archive-title"><?php printf( __( 'Tag Archives: %s', 'mosaic' ), single_tag_title( '', false ) );?></h1>
<?php
/* Run the loop for the tag archive to output the posts
 * If you want to overload this in a child theme then include a file
 * called loop-tag.php and that will be used instead.
 */
get_template_part( 'loop', 'tag' );
mosaic_after_content();
get_sidebar();
get_footer();
?>