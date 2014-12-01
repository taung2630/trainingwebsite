<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 *
 * @package Mosaic
 * @author Wild Web Lab - www.wildweblab.com 
 * @since Mosaic 1.0
 */
 
 
function optionsframework_option_name() {
	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = 'mosaic_theme_options';
	update_option( 'optionsframework', $optionsframework_settings );
}


/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 */
function optionsframework_options() {
	
	$imagepath =  get_template_directory_uri() . '/images/';
	
	$typography_defaults = array(
		'size' => '15px',
		'face' => 'georgia',
		'style' => 'normal',
		'color' => '' 
	);

	
	$options = array();

	$options[] = array(
		'name' => __('General', 'mosaic'),
		'type' => 'heading'
	);
	
	$options['theme_layout'] = array(
		'name' => "Layout",
		'desc' => "Select main content and sidebar alignment.",
		'id' => "theme_layout",
		'std' => "content-sidebar",
		'type' => "images",
		'options' => array(
			'content-sidebar' => $imagepath . '2cr.png',
			'sidebar-content' => $imagepath . '2cl.png',
			'content' => $imagepath . '1col.png',
		)
	);
	
	$options[] = array(
		'name' => __('Custom Logo', 'mosaic'),
		'desc' => __('Upload a logo, or specify an image URL directly.', 'mosaic'),
		'id' => 'custom_logo',
		'type' => 'upload'
	);
	
	$options[] = array(
		'name' => __('Custom Favicon', 'mosaic'),
		'desc' => __('Upload a 16px x 16px Png / Gif / Ico image.', 'mosaic'),
		'id' => 'custom_favicon',
		'type' => 'upload'
	);
	
	$options[] = array(
		'name' => __('Pagination Style', 'mosaic'),
		'id' => 'pagination_style',
		'std' => '1',
		'type' => 'select',
		'options' => array(
			'1' => 'Numbers',
			'2' => 'Older posts / Newer posts',
		)
	);
	
	$options[] = array(
		'name' => __('Advanced', 'mosaic'),
		'type' => 'heading'
	);

	$options[] = array(
		'name' => __('Post Content', 'mosaic'),
		'id' => 'post_content',
		'std' => '1',
		'type' => 'select',
		'options' => array(
			'1' => 'Full Content',
			'2' => 'The Excerpt',
		)
	);

	$options[] = array(
		'name' => __('Show Featured Image On', 'mosaic'),
		'desc' => __('', 'mosaic'),
		'id' => 'featured_image',
		'std' => array(),
		'type' => 'multicheck',
		'options' => array(
			'front_page' => 'Front Page',
			'archive_pages' => 'Archive Pages',
			'single_posts' => 'Single Posts',
			'search_results' => 'Search Results',
		)
	);

	$options[] = array(
		'name' => __('Featured Image Size', 'mosaic'),
		'id' => 'featured_image_size',
		'std' => 'medium',
		'type' => 'select',
		'options' => array(
			'thumbnail' => 'Thumbnail (150px x 150px)',
			'medium' => 'Medium (300px x 200px)',
			'large' => 'Large (640px x 640px)',
		)
	);

	$options[] = array(
		'name' => __('Post Info', 'mosaic'),
		'desc' => __('Data above the content of blog post.', 'mosaic'),
		'id' => 'post_info',
		'std' => '[post_date] by [post_author] [post_comments] [post_edit]',
		'type' => 'text'
	);
	
	$options[] = array(
		'name' => __('Post Meta', 'mosaic'),
		'desc' => __('Data below each blog post.', 'mosaic'),
		'id' => 'post_meta',
		'std' => '[post_categories before="Posted in " after="."] [post_tags]',
		'type' => 'text'
	);

	$options['footer_content'] = array(
		'name' => __('Footer', 'mosaic'),
		'desc' => __('Content of the footer (copyright and credits).', 'mosaic'),
		'id' => 'footer_content',
		'std' => "<div id=\"copyright\">\n\t[footer_copyright]\n</div>\n\n<div id=\"credits\">\n\tPowered by [footer_wordpress_link]. \n\tDesign by [footer_wildweblab_link]\n</div>",
		'type' => 'textarea'
	);
	
	$options[] = array(
		'name' => __('Header Scripts', 'mosaic'),
		'desc' => __('Enter scripts or code you would like output to wp_head().', 'mosaic'),
		'id' => 'header_scripts',
		'std' => '',
		'type' => 'textarea'
	);
	
	$options[] = array(
		'name' => __('Footer Scripts', 'mosaic'),
		'desc' => __('Enter scripts or code you would like output to wp_footer().', 'mosaic'),
		'id' => 'footer_scripts',
		'std' => '',
		'type' => 'textarea'
	);
	
	$options[] = array(
		'name' => __('Styling', 'mosaic'),
		'type' => 'heading'
	);
	
	$options['body_background'] = array(
		'name' =>  __('Body Background', 'mosaic'),
		'desc' => __('Pick a custom color for body background or add a image.', 'mosaic'),
		'id' => 'body_background',
		'std' => array(
			'color' => '#ffffff'
		),
		'type' => 'background' 
	);
	
	$options['header_background'] = array(
		'name' =>  __('Header Background', 'mosaic'),
		'desc' => __('Pick a custom color for header background or add a image.', 'mosaic'),
		'id' => 'header_background',
		'std' => array(
			'color' => '#F5F5F5',
			'image' => $imagepath . 'header-footer-bg.png',
			'repeat' => 'repeat',
			'position' => 'top left',
			'attachment' => 'scroll'
		),
		'type' => 'background' 
	);
	
	$options['footer_background'] = array(
		'name' =>  __('Footer Background', 'mosaic'),
		'desc' => __('Pick a custom color for footer background or add a image.', 'mosaic'),
		'id' => 'footer_background',
		'std' => array(
			'color' => '#F5F5F5',
			'image' => $imagepath . 'header-footer-bg.png',
			'repeat' => 'repeat',
			'position' => 'top left',
			'attachment' => 'scroll'
		),
		'type' => 'background' 
	);
	
	$options['link_color'] = array(
		'name' => __('Link Color', 'mosaic'),
		'desc' => __('Pick a custom color for links.', 'mosaic'),
		'id' => 'link_color',
		'std' => '#62A6E4',
		'type' => 'color' 
	);
	
	$options['link_hover_color'] = array(
		'name' => __('Link Hover Color', 'mosaic'),
		'desc' => __('Pick a custom color for hover links.', 'mosaic'),
		'id' => 'link_hover_color',
		'std' => '',
		'type' => 'color' 
	);
	
	$options[] = array(
		'name' => __('Custom CSS', 'mosaic'),
		'desc' => __('Add custom CSS code.', 'mosaic'),
		'id' => 'custom_css',
		'std' => 'body {}',
		'type' => 'textarea'
	);
	
	$options[] = array(
		'name' => __('Typography', 'mosaic'),
		'type' => 'heading'
	);
	
	$options['general_font'] = array( 
		'name' => __('General Font', 'mosaic'),
		'id' => "general_font_typography",
		'std' => array(
			'size' => '15px',
			'face' => 'georgia',
			'style' => 'normal',
			'color' => '#575757' 
		),
		'type' => 'typography' 
	);
	
	$options['site_title'] = array( 
		'name' => __('Site Title', 'mosaic'),
		'id' => "site_title_typography",
		'std' => array(
			'size' => '40px',
			'face' => 'georgia',
			'style' => 'normal',
			'color' => '#696969' 
		),
		'type' => 'typography' 
	);
	
	$options['site_tagline'] = array( 
		'name' => __('Site Tagline', 'mosaic'),
		'id' => "site_tagline_typography",
		'std' => array(
			'size' => '15px',
			'face' => 'georgia',
			'style' => 'normal',
			'color' => '#949494' 
		),
		'type' => 'typography' 
	);
	
	$options['navigation'] = array( 
		'name' => __('Navigation', 'mosaic'),
		'id' => "navigation_typography",
		'std' => array(
			'size' => '16px',
			'face' => 'georgia',
			'style' => 'normal',
			'color' => '#62A6E4' 
		),
		'type' => 'typography' 
	);
	
	$options['post_title'] = array( 
		'name' => __('Post Title', 'mosaic'),
		'id' => "post_title_typography",
		'std' => array(
			'size' => '30px',
			'face' => 'georgia',
			'style' => 'normal',
			'color' => '#505050' 
		),
		'type' => 'typography' 
	);
	
	$options['post_info'] = array( 
		'name' => __('Post Info', 'mosaic'),
		'id' => "post_info_typography",
		'std' => array(
			'size' => '12px',
			'face' => 'georgia',
			'style' => 'normal',
			'color' => '#8a8888' 
		),
		'type' => 'typography' 
	);
	
	$options['post_meta'] = array( 
		'name' => __('Post Meta', 'mosaic'),
		'id' => "post_meta_typography",
		'std' => array(
			'size' => '12px',
			'face' => 'georgia',
			'style' => 'normal',
			'color' => '#8a8888' 
		),
		'type' => 'typography' 
	);
	
	$options['widget_title'] = array( 
		'name' => __('Widget Title', 'mosaic'),
		'id' => "widget_title_typography",
		'std' => array(
			'size' => '18px',
			'face' => 'georgia',
			'style' => 'normal',
			'color' => '' 
		),
		'type' => 'typography' 
	);
	
	
	return $options;
}


add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function($) {

	$('#example_showhidden').click(function() {
  		$('#section-example_text_hidden').fadeToggle(400);
	});

	if ($('#example_showhidden:checked').val() !== undefined) {
		$('#section-example_text_hidden').show();
	}

});
</script>

<?php
}