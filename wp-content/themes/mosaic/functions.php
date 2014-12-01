<?php
/**
 *
 * Layout Functions:
 * 
 * mosaic_header  // Opening header tag and logo/header text
 * mosaic_header_extras // Additional content may be added to the header
 * mosaic_navbar // Opening navigation element and WP3 menus
 * mosaic_before_content // Opening content wrapper 
 * mosaic_after_content // Closing content wrapper 
 * mosaic_before_sidebar // Opening sidebar wrapper 
 * mosaic_after_sidebar // Closing sidebar wrapper 
 * mosaic_before_footer // Opening footer wrapper 
 * mosaic_footer // The footer (includes sidebar-footer.php)
 * mosaic_after_footer // The closing footer wrapper 
 *
 * @package Mosaic
 * @author Wild Web Lab - www.wildweblab.com 
 * @since Mosaic 1.0
 */

/*-----------------------------------------------------------------------------------*/
/* Set Proper Parent/Child theme paths for inclusion
/*-----------------------------------------------------------------------------------*/
define( 'MOSAIC_PARENT_DIR', get_template_directory() );
define( 'MOSAIC_CHILD_DIR', get_stylesheet_directory() );

define( 'MOSAIC_PARENT_URL', get_template_directory_uri() );
define( 'MOSAIC_CHILD_URL', get_stylesheet_directory_uri() );


/*-----------------------------------------------------------------------------------*/
/* Initialize the Options Framework
/* http://wptheming.com/options-framework-theme/
/*-----------------------------------------------------------------------------------*/

define( 'OPTIONS_FRAMEWORK_URL', MOSAIC_PARENT_URL . '/admin/' );
define( 'OPTIONS_FRAMEWORK_DIRECTORY', MOSAIC_PARENT_DIR . '/admin/' );

require_once( OPTIONS_FRAMEWORK_DIRECTORY . 'options-framework.php' );


// Include Theme Options
require_once( MOSAIC_PARENT_DIR . '/options.php' );


// Include Shordcodes
require_once( MOSAIC_PARENT_DIR . '/shortcodes.php' );


/**
 * Enqueue scripts and styles
 */
function mosaic_header_scripts() {
	$theme  = wp_get_theme();
	$version = $theme->Version;
	
	wp_enqueue_style( 'mosaic-skeleton', get_template_directory_uri() . '/skeleton.css', false, $version, 'screen, projection' );
	wp_enqueue_style( 'mosaic-style', get_stylesheet_uri(), 'mosaic', $version, 'screen, projection' );
	wp_enqueue_style( 'mosaic-superfish', get_template_directory_uri() . '/superfish.css', 'theme', $version, 'screen, projection' );
	wp_enqueue_style( 'mosaic-layout', get_template_directory_uri() . '/layout.css', 'theme', $version, 'screen, projection' );
	
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'mosaic-app', get_template_directory_uri() . "/javascripts/app.js", array('jquery'), $version, true );
	wp_enqueue_script( 'mosaic-superfish', get_template_directory_uri() . "/javascripts/superfish.js", array('jquery'), $version, true );
}
add_action( 'wp_enqueue_scripts', 'mosaic_header_scripts' );


/**
 * Enqueue comment reply script
 */
function mosaic_comment_reply_script() {
	if ( comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'comment_form_before', 'mosaic_comment_reply_script' );


/**
 * Add custom Favicon
 */
function mosaic_custom_favicon() {
	if( $custom_favicon = of_get_option('custom_favicon') ) {
		echo '<link rel="shortcut icon" href="' . $custom_favicon . '">';
	}
}
add_action( 'wp_head', 'mosaic_custom_favicon' );



/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * @since Mosaic 1.0
 */
function mosaic_setup() {

	if ( ! isset( $content_width ) ) $content_width = 640;

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'post-thumbnails' );

	add_editor_style( 'editor-style.css' );

	add_image_size( 'large', 640, 640 );
	
	// Register the available menus
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'mosaic' ),
	));

	/**
	 *	Make theme available for translation
	 *	Translations can be filed in the /languages/ directory
	 */ 
	load_theme_textdomain( 'mosaic', MOSAIC_PARENT_DIR . '/languages' );
}
add_action( 'after_setup_theme', 'mosaic_setup' );


/**
 * Creates a nicely formatted and more specific title element text
 * for output in head of document, based on current view.
 *
 * @since Mosaic 1.1
 */
function mosaic_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the blog name.
	$title .= get_bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'mosaic' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'mosaic_wp_title', 10, 2 );


/** 
 * Add Viewport meta tag for mobile browsers 
 *
 * @since Mosaic 1.1
 */
function mosaic_viewport_meta_tag() {
    echo "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\" />\n";
}
add_action( 'wp_head', 'mosaic_viewport_meta_tag', 1 );


/**
 * Add IE conditional html5 shim to header
 *
 * @since Mosaic 1.1
 */
function mosaic_html5_shim() {
    global $is_IE;
	
    if ( $is_IE ) {
    ?>
		<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	<?php
    }
}
add_action( 'wp_print_scripts', 'mosaic_html5_shim' );


/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in mosaic_setup().
 *
 * @since Mosaic 1.0
*/
function mosaic_admin_header_style() {
	?>
	<style type="text/css">
	/* Shows the same border as on front end */
	#headimg {
		border-bottom: 100px solid #000;
		border-top: 4px solid #000;
	}
	/* If NO_HEADER_TEXT is false, you would style the text with these selectors:
		#headimg #name { }
		#headimg #desc { }
	*/
	</style>
	<?php
}


/**
 * Sets the post excerpt length to 110 characters.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 * @since Mosaic 1.0
 * @return int
 */
function mosaic_excerpt_length( $length ) {
	return 110;
}
add_filter( 'excerpt_length', 'mosaic_excerpt_length' );



/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since Mosaic 1.0
 * @return string "Continue Reading" link
 */
function mosaic_continue_reading_link() {
	global $post;
	return ' <p><a href="'. get_permalink() . '#more-' . $post->ID . '" class="more-link">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'mosaic' ) . '</a></p>';
}


/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and mosaic_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @since Mosaic 1.0
 * @return string An ellipsis
 */
function mosaic_auto_excerpt_more( $more ) {
	return ' &hellip;' . mosaic_continue_reading_link();
}
add_filter( 'excerpt_more', 'mosaic_auto_excerpt_more' );


/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @since Mosaic 1.0
 * @return string Excerpt with a pretty "Continue Reading" link
 */
function mosaic_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= mosaic_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'mosaic_custom_excerpt_more' );


/**
 * Removes inline styles printed when the gallery shortcode is used.
 *
 * Galleries are styled by the theme in Skeleton's style.css. This is just
 * a simple filter call that tells WordPress to not use the default styles.
 *
 * @since Mosaic 1.0
 */
add_filter( 'use_default_gallery_style', '__return_false' );


/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * To override mosaic_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @uses register_sidebar
 */
function mosaic_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Sidebar', 'mosaic' ),
		'id' => 'primary-widget-area',
		'description' => __( '', 'mosaic' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	
	// Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
	register_sidebar( array(
		'name' => __( 'Header Right', 'mosaic' ),
		'id' => 'header-widget-area',
		'description' => __( 'This is the widget area in the header.', 'mosaic' ),
		'before_widget' => '<div class="widget-content"> ',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	// Area 3, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Footer 1', 'mosaic' ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'The first footer widget area', 'mosaic' ),
		'before_widget' => '<div class="widget-container %1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	// Area 4, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Footer 2', 'mosaic' ),
		'id' => 'second-footer-widget-area',
		'description' => __( 'The second footer widget area', 'mosaic' ),
		'before_widget' => '<div class="widget-container %1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	// Area 5, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Footer 3', 'mosaic' ),
		'id' => 'third-footer-widget-area',
		'description' => __( 'The third footer widget area', 'mosaic' ),
		'before_widget' => '<div class="widget-container %1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Area 6, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'Footer 4', 'mosaic' ),
		'id' => 'fourth-footer-widget-area',
		'description' => __( 'The fourth footer widget area', 'mosaic' ),
		'before_widget' => '<div class="widget-container %1$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'mosaic_widgets_init' );


/** Comment Styles */
function mosaic_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		<div id="comment-<?php comment_ID(); ?>" class="single-comment clearfix">
			<div class="comment-author vcard"> <?php echo get_avatar( $comment, $size='64' ); ?></div>
			<div class="comment-meta commentmetadata">
					<?php if ($comment->comment_approved == '0') : ?>
					<em><?php _e('Comment is awaiting moderation','mosaic');?></em> <br />
					<?php endif; ?>
					<span class="comment-author"><?php echo get_comment_author_link(); ?></span>
					<span class="comment-time"><?php echo get_comment_date(). ' at ' . get_comment_time(); ?></span>
					<?php comment_text() ?>
					<?php comment_reply_link(array_merge( $args, array('reply_text' => __('Reply','mosaic'),'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
					<?php edit_comment_link(__('Edit','mosaic'),'  ',''); ?>
			</div>
		</div>
<?php  
}


/**
 * Prints the thumbnail of a post if exists and is enabled in the Theme Options.
 * 
 * @since Mosaic 1.4
 */
function mosaic_post_thumbnail() {
	if ( has_post_thumbnail() ) :
		
		$featured_image = of_get_option('featured_image');
		$size = of_get_option('featured_image_size');

		if( is_home() && $featured_image['front_page'] ||
		is_archive() && $featured_image['archive_pages'] ||
		is_search() && $featured_image['search_results'] ) :
		?>

		<a href="<?php the_permalink(); ?>">

		<?php the_post_thumbnail($size); ?>

		</a>

		<?php
		elseif( is_single() && $featured_image['single_posts'] ) :

			the_post_thumbnail($size);

		endif;

	endif;
}


/**
 * Prints The Excerpt or Full Content of a post depending on the theme settings.
 * 
 * @since Mosaic 1.4
 */
function mosaic_post_content() {
	if ( of_get_option('post_content') == 2 || is_search() ) :
	?>
		<div class="entry-summary">
			<?php mosaic_post_thumbnail(); ?>
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
	<?php else : ?>
		<div class="entry-content">
			<?php mosaic_post_thumbnail(); ?>
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'mosaic' ) ); ?>
			<div class="clear"></div>
			<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'mosaic' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
	<?php endif;
}



/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since Mosaic 1.0
 */
function mosaic_posted_on() {
	echo do_shortcode(of_get_option('post_info'));
}


/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 * @since Mosaic 1.0
 */
function mosaic_posted_in() {
	echo do_shortcode(of_get_option('post_meta'));
}


// Header Functions

// Hook to add content before header
function mosaic_above_header() {
	do_action('mosaic_above_header');
}


// Primary Header Function
function mosaic_header() {
	do_action('mosaic_header');
}


// Opening #header div with flexible grid
function mosaic_header_open() {
	echo '<div id="header"><div class="inner container">';
}
add_action('mosaic_header','mosaic_header_open', 1);


// Build the logo
// Child Theme Override: child_logo();
function mosaic_logo() {
	// Displays H1 or DIV based on whether we are on the home page or not (SEO)
	$heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div';
	
	if ($custom_logo = of_get_option('custom_logo')) {
		$logo  = '<'.$heading_tag.' id="site-title"><a href="'.esc_url( home_url( '/' ) ).'" title="'.esc_attr( get_bloginfo('name','display')).'"><img src="' . $custom_logo . '" alt="'.get_bloginfo('name').'" /></a></'.$heading_tag.'>'. "\n";
	} else {
		$logo  = '<'.$heading_tag.' id="site-title"><a href="'.esc_url( home_url( '/' ) ).'" title="'.esc_attr( get_bloginfo('name','display')).'">'.get_bloginfo('name').'</a></'.$heading_tag.'>'. "\n";
		$logo .= '<span class="site-desc">'.get_bloginfo('description').'</span>'. "\n";
	}
	
	echo '<div id="logo">' . apply_filters ( 'child_logo' , $logo) . '</div>';
}
add_action('mosaic_header','mosaic_logo', 2);


// Hookable theme option field to add add'l content to header
// Child Theme Override: child_header_extras();
function mosaic_header_extras() {
	echo  '<div id="header-extras">';
	dynamic_sidebar( 'header-widget-area' );
	echo  '</div>';
}
add_action('mosaic_header','mosaic_header_extras', 3);


// Close Header
function mosaic_header_close() {
	echo "</div></div><!--/#header-->";
}
add_action('mosaic_header','mosaic_header_close', 4);



// Hook to Add Content After Header
function mosaic_below_header() {
	do_action('mosaic_below_header');
}


// Generate select menu for mobile
class mosaic_walker_nav_menu_dropdown extends walker_nav_menu {
    function start_lvl(&$output, $depth){
		$indent = str_repeat("\t", $depth);
    }

    function end_lvl(&$output, $depth){
		$indent = str_repeat("\t", $depth); 
    }

    function start_el(&$output, $item, $depth, $args){
		$item->title = str_repeat("&nbsp;", $depth * 4) . $item->title;
		$output .= '<option value="' . $item->url . '">' . $item->title . "</option>\n";
    }
	
    function end_el(&$output, $item, $depth){
    }
}


// Navigation (menu)
function mosaic_navbar() {
	echo '<div id="navigation"><div class="inner container">';
	wp_nav_menu( array( 'container_class' => 'menu', 'theme_location' => 'primary', 'fallback_cb' => false));
	wp_nav_menu(array(
		'container_class' => 'select-menu', 
		'theme_location' => 'primary',
		'walker' => new mosaic_walker_nav_menu_dropdown(),
		'items_wrap' => '<select><option value="">Select a page</option>%3$s</select>',
		'fallback_cb' => false
	));
	echo '</div></div><!--/#navigation-->';
}


// Before Content - mosaic_before_content($columns);
// Child Theme Override: child_before_content();
function mosaic_before_content($columns) {
	// Specify the number of columns in conditional statements
	// See http://codex.wordpress.org/Conditional_Tags for a full list
	//
	// If necessary, you can pass $columns as a variable in your template files:
	// mosaic_before_content('six');
	//
	// Set the default
	
	if (empty($columns)) {
		$columns = 'eleven';
	} else {
		// Check the function for a returned variable
		$columns = $columns;
	}
	
	// Example of further conditionals:
	// (be sure to add the excess of 16 to mosaic_before_sidebar as well)
	
	if (is_page_template('onecolumn-page.php')) {
		$columns = 'sixteen';
	}
	
	// Apply the markup
	echo '
	<div id="content-sidebar-wrap">
		<a id="top"></a>
	<div id="content" class="' . $columns . ' columns">
	';
}



// After Content
function mosaic_after_content() {
   	echo "\t\t</div><!-- /.columns (#content) -->\n";
}


// Before Sidebar - do_action('mosaic_before_sidebar')
function before_sidebar($columns) {
	// You can specify the number of columns in conditional statements
	// See http://codex.wordpress.org/Conditional_Tags for a full list
	//
	// If necessary, you can also pass $columns as a variable in your template files:
	// do_action('mosaic_before_sidebar','six');
	//
	if (empty($columns)) {
		// Set the default
		$columns = 'five';
	} else {
		// Check the function for a returned variable
		$columns = $columns;
	}
	
	// Example of further conditionals:
	// (be sure to add the excess of 16 to mosaic_before_content as well)
	// if (is_page() || is_single()) {
	// $columns = 'five';
	// } else {
	// $columns = 'four';
	// }
	// Apply the markup
	echo '<div id="sidebar" class="'.$columns.' columns" role="complementary">';
}
add_action( 'mosaic_before_sidebar', 'before_sidebar');  



// After Sidebar
function after_sidebar() {
	// Additional Content could be added here
	echo '
		</div><!-- /#sidebar -->
		<div class="clear"></div>
	</div><!-- /#content-sidebar-wrap -->
	';
}
add_action( 'mosaic_after_sidebar', 'after_sidebar');  


// Before Footer
function mosaic_before_footer() {
	echo "</div><!--/#wrap.container-->"."\n";
	
	$footerwidgets = is_active_sidebar('first-footer-widget-area') + is_active_sidebar('second-footer-widget-area') + is_active_sidebar('third-footer-widget-area') + is_active_sidebar('fourth-footer-widget-area');
	$class = ($footerwidgets == '0' ? 'noborder' : 'normal');
	echo '<div class="clear"></div><div id="footer"><div class="inner container">';
}


// The Footer

function mosaic_footer() {
	//loads sidebar-footer.php
	get_sidebar( 'footer' );
	
	echo '<div id="credits-wrap">';
	
	if( !$footer_content = of_get_option('footer_content') ) {
		$options = optionsframework_options();
		$footer_content = $options['footer_content']['std'];
	}
		
	echo do_shortcode($footer_content);

	echo '</div><!-- /#credits-wrap -->';
}


// After Footer
function mosaic_after_footer() {
	echo '</div>';
	echo "</div><!--/#footer-->"."\n";
	
	// Add custom scripts in footer
	if ($footer_scripts = of_get_option('footer_scripts')) {
		echo $footer_scripts;
	}
}


/**
 * Post navigation
 */
function mosaic_pagination() {
	global $wp_query;
	
	if(of_get_option('pagination_style') == 1) {
		mosaic_numeric_pagination();
	} else {
		if (  $wp_query->max_num_pages > 1 ) {
		?>
				<div id="nav-below" class="navigation">
				<div class="nav-previous"><?php next_posts_link(__( '<span class="meta-nav">&larr;</span> Older posts', 'mosaic' ) ); ?> </div>
				<div class="nav-next"><?php previous_posts_link(__( 'Newer posts <span class="meta-nav">&rarr;</span>', 'mosaic' ) ); ?> </div>
				</div><!-- #nav-below -->
		<?php
		}
	}
}


/**
 * Generates Numbered Navigation
 */
function mosaic_numeric_pagination($before = '', $after = '') {
	global $wpdb, $wp_query;
	
	$request = $wp_query->request;
	$posts_per_page = intval(get_query_var('posts_per_page'));
	$paged = intval(get_query_var('paged'));
	$numposts = $wp_query->found_posts;
	$max_page = $wp_query->max_num_pages;
	
	if ( $numposts <= $posts_per_page ) { return; }
	
	if(empty($paged) || $paged == 0) {
		$paged = 1;
	}
	
	$pages_to_show = 7;
	$pages_to_show_minus_1 = $pages_to_show-1;
	$half_page_start = floor($pages_to_show_minus_1/2);
	$half_page_end = ceil($pages_to_show_minus_1/2);
	$start_page = $paged - $half_page_start;
	
	if($start_page <= 0) {
		$start_page = 1;
	}
	
	$end_page = $paged + $half_page_end;
	
	if(($end_page - $start_page) != $pages_to_show_minus_1) {
		$end_page = $start_page + $pages_to_show_minus_1;
	}
	
	if($end_page > $max_page) {
		$start_page = $max_page - $pages_to_show_minus_1;
		$end_page = $max_page;
	}
	
	if($start_page <= 0) {
		$start_page = 1;
	}
	
	echo $before.'<div class="page-navigation">'."";
	
	if ($start_page >= 2 && $pages_to_show < $max_page) {
		$first_page_text = "first";
		echo '<a class="first-page-link" href="'.get_pagenum_link().'" title="'.$first_page_text.'">'.$first_page_text.'</a>';
	}
	
	echo '<span class="prev-link">';
	previous_posts_link('&larr; previous');
	echo '</span>';
	
	for($i = $start_page; $i  <= $end_page; $i++) {
		if($i == $paged) {
			echo '<span class="current">'.$i.'</span>';
		} else {
			echo '<a href="'.get_pagenum_link($i).'">'.$i.'</a>';
		}
	}
	
	echo '<span class="next-link">';
	next_posts_link('next &rarr;');
	echo '</span>';
	
	if ($end_page < $max_page) {
		$last_page_text = "last";
		echo '<a class="last-page-link" href="'.get_pagenum_link($max_page).'" title="'.$last_page_text.'">'.$last_page_text.'</a>';
	}
	
	echo '</div>'.$after."";
}


// Enable Shortcodes in excerpts and widgets
add_filter('widget_text', 'do_shortcode');
add_filter( 'the_excerpt', 'do_shortcode');
add_filter('get_the_excerpt', 'do_shortcode');


function get_image_path() {
	global $post;
	$id = get_post_thumbnail_id();
	
	// check to see if NextGen Gallery is present
	if(stripos($id,'ngg-') !== false && class_exists('nggdb')){
		$nggImage = nggdb::find_image(str_replace('ngg-','',$id));
		$thumbnail = array(
		$nggImage->imageURL,
		$nggImage->width,
		$nggImage->height
	);
	// otherwise, just get the wp thumbnail
	} else {
		$thumbnail = wp_get_attachment_image_src($id,'full', true);
	}
	
	$theimage = $thumbnail[0];
	return $theimage;
}


/**
 * override default filter for 'textarea' sanitization.
 */ 
add_action('admin_init', 'optionscheck_change_santiziation', 100);
 
function optionscheck_change_santiziation() {
    remove_filter( 'of_sanitize_textarea', 'of_sanitize_textarea' );
    add_filter( 'of_sanitize_textarea', 'mosaic_custom_sanitize_textarea' );
}

function mosaic_custom_sanitize_textarea($input) {
    global $allowedposttags;
	
    $custom_allowedtags["embed"] = array(
		"src" => array(),
		"type" => array(),
		"allowfullscreen" => array(),
		"allowscriptaccess" => array(),
		"height" => array(),
		"width" => array()
	);
	  
	$custom_allowedtags["script"] = array('src' => array(), 'type' => array());
	$custom_allowedtags["link"] = array('href' => array(), 'rel' => array(), 'type' => array(), 'media' => array());
	$custom_allowedtags["a"] = array('href' => array(),'title' => array());
	$custom_allowedtags["img"] = array('src' => array(),'title' => array(),'alt' => array());
	$custom_allowedtags["br"] = array();
	$custom_allowedtags["em"] = array();
	$custom_allowedtags["strong"] = array();
	$custom_allowedtags = array_merge($custom_allowedtags, $allowedposttags);
	$output = wp_kses( $input, $custom_allowedtags);
	
    return $output;
}


/**
 * Add support for Theme Options in the Customizer
 */
function mosaic_customize_register( $wp_customize ) {
	$options = optionsframework_options();

	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	$wp_customize->add_section( 'colors', array(
		'title'          => __( 'Basic Colors', 'mosaic' ),
		'priority'       => 35,
	));
	
	// Body Background Color
	$wp_customize->add_setting( 'mosaic_theme_options[body_background][color]', array(
		'default'           => $options['body_background']['std']['color'],
		'type'              => 'option',
		'sanitize_callback' => 'sanitize_hex_color',
		'capability'        => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'body_background[color]', array(
		'label'    => $options['body_background']['name'],
		'section'  => 'colors',
		'settings' => 'mosaic_theme_options[body_background][color]',
		'type'    => 'color',
	) ) );
	
	// Navigation Color
	$wp_customize->add_setting( 'mosaic_theme_options[navigation_typography][color]', array(
		'default'           => $options['navigation']['std']['color'],
		'type'              => 'option',
		'sanitize_callback' => 'sanitize_hex_color',
		'capability'        => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'navigation_color', array(
		'label'    => $options['navigation']['name'],
		'section'  => 'colors',
		'settings' => 'mosaic_theme_options[navigation_typography][color]',
		'type'    => 'color',
	) ) );
	
	
	// Link Color
	$wp_customize->add_setting( 'mosaic_theme_options[link_color]', array(
		'default'           => $options['link_color']['std'],
		'type'              => 'option',
		'sanitize_callback' => 'sanitize_hex_color',
		'capability'        => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
		'label'    => $options['link_color']['name'],
		'section'  => 'colors',
		'settings' => 'mosaic_theme_options[link_color]',
		'type'    => $options['link_color']['type'],
	) ) );
	
	// Link Hover Color
	$wp_customize->add_setting( 'mosaic_theme_options[link_hover_color]', array(
		'default'           => $options['link_hover_color']['std'],
		'type'              => 'option',
		'sanitize_callback' => 'sanitize_hex_color',
		'capability'        => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_hover_color', array(
		'label'    => $options['link_hover_color']['name'],
		'section'  => 'colors',
		'settings' => 'mosaic_theme_options[link_hover_color]',
		'type'    => $options['link_hover_color']['type'],
	) ) );
	
	
	// Typography Colors
	$wp_customize->add_section( 'typography_colors', array(
		'title'          => __( 'Typography Colors', 'mosaic' ),
		'priority'       => 38,
	));
	
	// General Font Color
	$wp_customize->add_setting( 'mosaic_theme_options[general_font_typography][color]', array(
		'default'           => $options['general_font']['std']['color'],
		'type'              => 'option',
		'sanitize_callback' => 'sanitize_hex_color',
		'capability'        => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'general_font_color', array(
		'label'    => $options['general_font']['name'],
		'section'  => 'typography_colors',
		'settings' => 'mosaic_theme_options[general_font_typography][color]',
		'type'    => 'color',
	) ) );
	
	// Site Title Color
	$wp_customize->add_setting( 'mosaic_theme_options[site_title_typography][color]', array(
		'default'           => $options['site_title']['std']['color'],
		'type'              => 'option',
		'sanitize_callback' => 'sanitize_hex_color',
		'capability'        => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'site_title_color', array(
		'label'    => $options['site_title']['name'],
		'section'  => 'typography_colors',
		'settings' => 'mosaic_theme_options[site_title_typography][color]',
		'type'    => 'color',
	) ) );
	
	// Site Title Color
	$wp_customize->add_setting( 'mosaic_theme_options[site_tagline_typography][color]', array(
		'default'           => $options['site_tagline']['std']['color'],
		'type'              => 'option',
		'sanitize_callback' => 'sanitize_hex_color',
		'capability'        => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'site_tagline_color', array(
		'label'    => $options['site_tagline']['name'],
		'section'  => 'typography_colors',
		'settings' => 'mosaic_theme_options[site_tagline_typography][color]',
		'type'    => 'color',
	) ) );
	
	// Post Title Color
	$wp_customize->add_setting( 'mosaic_theme_options[post_title_typography][color]', array(
		'default'           => $options['post_title']['std']['color'],
		'type'              => 'option',
		'sanitize_callback' => 'sanitize_hex_color',
		'capability'        => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'post_title_color', array(
		'label'    => $options['post_title']['name'],
		'section'  => 'typography_colors',
		'settings' => 'mosaic_theme_options[post_title_typography][color]',
		'type'    => 'color',
	) ) );
	
	// Post Info Color
	$wp_customize->add_setting( 'mosaic_theme_options[post_info_typography][color]', array(
		'default'           => $options['post_info']['std']['color'],
		'type'              => 'option',
		'sanitize_callback' => 'sanitize_hex_color',
		'capability'        => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'post_info_color', array(
		'label'    => $options['post_info']['name'],
		'section'  => 'typography_colors',
		'settings' => 'mosaic_theme_options[post_info_typography][color]',
		'type'    => 'color',
	) ) );
	
	// Post Meta Color
	$wp_customize->add_setting( 'mosaic_theme_options[post_meta_typography][color]', array(
		'default'           => $options['post_meta']['std']['color'],
		'type'              => 'option',
		'sanitize_callback' => 'sanitize_hex_color',
		'capability'        => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'post_meta_color', array(
		'label'    => $options['post_meta']['name'],
		'section'  => 'typography_colors',
		'settings' => 'mosaic_theme_options[post_meta_typography][color]',
		'type'    => 'color',
	) ) );
	
	// Widget Title Color
	$wp_customize->add_setting( 'mosaic_theme_options[widget_title_typography][color]', array(
		'default'           => $options['widget_title']['std']['color'],
		'type'              => 'option',
		'sanitize_callback' => 'sanitize_hex_color',
		'capability'        => 'edit_theme_options',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'widget_title_color', array(
		'label'    => $options['widget_title']['name'],
		'section'  => 'typography_colors',
		'settings' => 'mosaic_theme_options[widget_title_typography][color]',
		'type'    => 'color',
	) ) );
	
	// Layout
	$wp_customize->add_section( 'layout', array(
		'title'          => __( 'Layout', 'mosaic' ),
		'priority'       => 40,
	));
	
	$wp_customize->add_setting( 'mosaic_theme_options[theme_layout]', array(
        'default' => $options['theme_layout']['std'],
        'type' => 'option'
    ) );
	
    $wp_customize->add_control( 'mosaic_theme_options_theme_layout', array(
        'label' => $options['theme_layout']['name'],
        'section' => 'layout',
        'settings' => 'mosaic_theme_options[theme_layout]',
        'type' => 'radio',
        'choices' => array(
			'content-sidebar' => 'Content on left',
			'sidebar-content' => 'Content on right',
			'content' => 'One-column, no sidebar',
		)
    ) );
	
}
add_action( 'customize_register', 'mosaic_customize_register' );


/**
 * Add custom styling
 */
function mosaic_print_style() {
	$style = '';
	
	// BACKGROUNDS
	
	if ( $body_background = of_get_option('body_background') ) {
		$style .= 'body {';
		if( $body_background['image'] ) {
			$style .= 'background: ' . $body_background['color'] . ' url(' . $body_background['image'] . ') ' . $body_background['repeat'] . ' ' . $body_background['position'] . ' ' . $body_background['attachment'] ;
		} elseif( $body_background['color'] ) {
			$style .= 'background-color: ' . $body_background['color'];
		}
		$style .= '}';
	}
	
	if ( $header_background = of_get_option('header_background') ) {
		$style .= '#header {';
		if( $header_background['image'] ) {
			$style .= 'background: ' . $header_background['color'] . ' url(' . $header_background['image'] . ') ' . $header_background['repeat'] . ' ' . $header_background['position'] . ' ' . $header_background['attachment'] ;
		} elseif( $header_background['color'] ) {
			$style .= 'background-color: ' . $header_background['color'];
		}
		$style .= '}';
	}
	
	if ( $footer_background = of_get_option('footer_background') ) {
		$style .= '#footer {';
		if( $footer_background['image'] ) {
			$style .= 'background: ' . $footer_background['color'] . ' url(' . $footer_background['image'] . ') ' . $footer_background['repeat'] . ' ' . $footer_background['position'] . ' ' . $footer_background['attachment'] ;
		} elseif( $footer_background['color'] ) {
			$style .= 'background-color: ' . $footer_background['color'];
		}
		$style .= '}';
	}
	
	// COLORS
	
	if ( $link_color = of_get_option('link_color') ) {
		$style .= 'a, a:link, a:visited, a:active, #content .gist .gist-file .gist-meta a:visited, .entry-title a:hover{color:' . $link_color . ';}';
		$style .= '.page-navigation .current, .page-navigation a:hover {background-color: ' . $link_color . '; border-color: ' . $link_color . '; }';
	}
	
	if ( $link_hover_color = of_get_option('link_hover_color') )
		$style .= 'a:hover, .entry-title a:hover{color:' . $link_hover_color . ';}';
		
	// TYPOGRAPHY
	
	if ( $general_font_typography = of_get_option('general_font_typography') )
		$style .= 'body{' . mosaic_generate_font_css($general_font_typography) . ';line-height:150%}';
	
	if ( $site_title_typography = of_get_option('site_title_typography') )
		$style .= '#site-title a{' . mosaic_generate_font_css($site_title_typography) . '}';
		
	if ( $site_tagline_typography = of_get_option('site_tagline_typography') )
		$style .= '#header span.site-desc{' . mosaic_generate_font_css($site_tagline_typography) . '}';
	
	if ( $navigation_typography = of_get_option('navigation_typography') ) {
		$style .= '#navigation ul li a{' . mosaic_generate_font_css($navigation_typography) . '}';
		
		if( $navigation_typography['color'] ) {
			$style .= '#navigation {border-color:' . $navigation_typography['color'] . '}';
			$style .= '#navigation ul li.active > a, #navigation ul li.active > a:hover {background:' . $navigation_typography['color'] . '}';
		}
	}
	
	if ( $post_title_typography = of_get_option('post_title_typography') )
		$style .= '.entry-title, .entry-title a{' . mosaic_generate_font_css($post_title_typography) . '}';
	
	if ( $post_info_typography = of_get_option('post_info_typography') )
		$style .= '.entry-meta, .entry-meta span{' . mosaic_generate_font_css($post_info_typography) . '}';
	
	if ( $post_meta_typography = of_get_option('post_meta_typography') )
		$style .= '.entry-utility, .entry-utility span{' . mosaic_generate_font_css($post_meta_typography) . '}';
		
	if ( $widget_title_typography = of_get_option('widget_title_typography') )
		$style .= '.widget-title{' . mosaic_generate_font_css($widget_title_typography) . '}';
	
	$style .= of_get_option('custom_css');
	
	echo '<style type="text/css" id="custom-css">' . $style . '</style>';
}
add_action( 'wp_head', 'mosaic_print_style' );


function mosaic_generate_font_css($options) {
	$color = ($options['color']) ? 'color:' . $options['color'] : '';
	return $color . ';font:' . $options['style'] . ' ' . $options['size'] . ' ' . $options['face'];
}


/**
 * Add custom CSS class to the <body> tag to change layout
 */
function mosaic_layout_classes( $existing_classes ) {
	$layout = of_get_option('theme_layout');
	$classes = array();
	
	if ( 'content-sidebar' == $layout )
		$classes[] = 'right-sidebar';
	elseif ( 'sidebar-content' == $layout )
		$classes[] = 'left-sidebar';
	elseif ( 'content' == $layout )
		$classes[] = 'no-sidebar';

	$classes = apply_filters( 'mosaic_layout_classes', $classes, $layout );

	return array_merge( $existing_classes, $classes );
}
add_filter( 'body_class', 'mosaic_layout_classes' );


/**
 * Add custom scripts in header
 */
function mosaic_custom_header_scripts() {
	if($header_scripts = of_get_option('header_scripts'))
		echo $header_scripts;
}
add_action('wp_head', 'mosaic_custom_header_scripts');

