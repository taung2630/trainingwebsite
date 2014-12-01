<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package Mosaic
 * @author Wild Web Lab - www.wildweblab.com 
 * @since Mosaic 1.0
 */

get_header();
mosaic_before_content($columns='');

?>
	
<h1 id="archive-title">
<?php
	printf( __( 'Category Archives: %s', 'mosaic' ), single_cat_title( '', false ) );
?>
</h1>
	<?php
		$category_description = category_description();
		if ( ! empty( $category_description ) )
			echo '' . $category_description . '';
  
	/* Run the loop for the category page to output the posts.
	 * If you want to overload this in a child theme then include a file
	 * called loop-category.php and that will be used instead.
	 */
	get_template_part( 'loop', 'category' );
	mosaic_after_content();
	get_sidebar();
	get_footer();
?>
