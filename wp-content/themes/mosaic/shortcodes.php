<?php
/**
 * @package Mosaic
 * @author Wild Web Lab - www.wildweblab.com 
 * @since Mosaic 1.0
 */

function mosaic_one_third( $atts, $content = null ) {
   return '<div class="one_third">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_third', 'mosaic_one_third');

function mosaic_one_third_last( $atts, $content = null ) {
   return '<div class="one_third last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_third_last', 'mosaic_one_third_last');

function mosaic_two_thirds( $atts, $content = null ) {
   return '<div class="two_thirds">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_thirds', 'mosaic_two_thirds');

function mosaic_two_thirds_last( $atts, $content = null ) {
   return '<div class="two_thirds last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('two_thirds_last', 'mosaic_two_thirds_last');

// 1-4 col 

function mosaic_one_half( $atts, $content = null ) {
   return '<div class="one_half">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_half', 'mosaic_one_half');


function mosaic_one_half_last( $atts, $content = null ) {
   return '<div class="one_half last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_half_last', 'mosaic_one_half_last');


function mosaic_one_fourth( $atts, $content = null ) {
   return '<div class="one_fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fourth', 'mosaic_one_fourth');


function mosaic_one_fourth_last( $atts, $content = null ) {
   return '<div class="one_fourth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_fourth_last', 'mosaic_one_fourth_last');

function mosaic_three_fourths( $atts, $content = null ) {
   return '<div class="three_fourths">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fourths', 'mosaic_three_fourths');


function mosaic_three_fourths_last( $atts, $content = null ) {
   return '<div class="three_fourths last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('three_fourths_last', 'mosaic_three_fourths_last');


function mosaic_one_fifth( $atts, $content = null ) {
   return '<div class="one_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fifth', 'mosaic_one_fifth');

function mosaic_two_fifth( $atts, $content = null ) {
   return '<div class="two_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_fifth', 'mosaic_two_fifth');

function mosaic_three_fifth( $atts, $content = null ) {
   return '<div class="three_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fifth', 'mosaic_three_fifth');

function mosaic_four_fifth( $atts, $content = null ) {
   return '<div class="four_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('four_fifth', 'mosaic_four_fifth');

//

function mosaic_one_fifth_last( $atts, $content = null ) {
   return '<div class="one_fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_fifth_last', 'mosaic_one_fifth_last');

function mosaic_two_fifth_last( $atts, $content = null ) {
   return '<div class="two_fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('two_fifth_last', 'mosaic_two_fifth_last');

function mosaic_three_fifth_last( $atts, $content = null ) {
   return '<div class="three_fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('three_fifth_last', 'mosaic_three_fifth_last');

function mosaic_four_fifth_last( $atts, $content = null ) {
   return '<div class="four_fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('four_fifth_last', 'mosaic_four_fifth_last');

// 1-6 col 

// one_sixth
function mosaic_one_sixth( $atts, $content = null ) {
   return '<div class="one_sixth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_sixth', 'mosaic_one_sixth');

function mosaic_one_sixth_last( $atts, $content = null ) {
   return '<div class="one_sixth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('one_sixth_last', 'mosaic_one_sixth_last');

// five_sixth
function mosaic_five_sixth( $atts, $content = null ) {
   return '<div class="five_sixth">' . do_shortcode($content) . '</div>';
}
add_shortcode('five_sixth', 'mosaic_five_sixth');

function mosaic_five_sixth_last( $atts, $content = null ) {
   return '<div class="five_sixth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('five_sixth_last', 'mosaic_five_sixth_last');


// Callouts

function mosaic_callout( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'width' => '',
		'align' => ''
    ), $atts));
	$style;
	if ($width || $align) {
	 $style .= 'mosaic_yle="';
	 if ($width) $style .= 'width:'.$width.'px;';
	 if ($align == 'left' || 'right') $style .= 'float:'.$align.';';
	 if ($align == 'center') $style .= 'margin:0px auto;';
	 $style .= '"';
	}
   return '<div class="cta" '.$style.'>' . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('callout', 'mosaic_callout');



// Buttons
function mosaic_button( $atts, $content = null ) {
	extract(shortcode_atts(array(
		'link' => '',
		'size' => 'medium',
		'color' => '',
		'target' => '_self',
		'caption' => '',
		'align' => 'right'
    ), $atts));	
	$button;
	$button .= '<div class="button '.$size.' '. $align.'">';
	$button .= '<a target="'.$target.'" class="button '.$color.'" href="'.$link.'">';
	$button .= $content;
	if ($caption != '') {
	$button .= '<br /><span class="btn_caption">'.$caption.'</span>';
	};
	$button .= '</a></div>';
	return $button;
}
add_shortcode('button', 'mosaic_button');


// Tabs
add_shortcode( 'tabgroup', 'mosaic_tabgroup' );

function mosaic_tabgroup( $atts, $content ){
	
$GLOBALS['tab_count'] = 0;
do_shortcode( $content );

if( is_array( $GLOBALS['tabs'] ) ){
	
foreach( $GLOBALS['tabs'] as $tab ){
$tabs[] = '<li><a href="#'.$tab['id'].'">'.$tab['title'].'</a></li>';
$panes[] = '<li id="'.$tab['id'].'Tab">'.$tab['content'].'</li>';
}
$return = "\n".'<!-- the tabs --><ul class="tabs">'.implode( "\n", $tabs ).'</ul>'."\n".'<!-- tab "panes" --><ul class="tabs-content">'.implode( "\n", $panes ).'</ul>'."\n";
}
return $return;

}

add_shortcode( 'tab', 'mosaic_tab' );
function mosaic_tab( $atts, $content ){
extract(shortcode_atts(array(
	'title' => '%d',
	'id' => '%d'
), $atts));

$x = $GLOBALS['tab_count'];
$GLOBALS['tabs'][$x] = array(
	'title' => sprintf( $title, $GLOBALS['tab_count'] ),
	'content' =>  do_shortcode($content),
	'id' =>  $id );

$GLOBALS['tab_count']++;
}


// Toggle
function mosaic_toggle( $atts, $content = null ) {
	extract(shortcode_atts(array(
		 'title' => '',
		 'mosaic_yle' => 'list'
    ), $atts));
	output;
	$output .= '<div class="'.$style.'"><p class="trigger"><a href="#">' .$title. '</a></p>';
	$output .= '<div class="toggle_container"><div class="block">';
	$output .= do_shortcode($content);
	$output .= '</div></div></div>';

	return $output;
	}
add_shortcode('toggle', 'mosaic_toggle');


/*-----------------------------------------------------------------------------------*/
// Latest Posts
// Example Use: [latest excerpt="true" thumbs="true" width="50" height="50" num="5" cat="8,10,11"]
/*-----------------------------------------------------------------------------------*/
function mosaic_latest($atts, $content = null) {
	extract(shortcode_atts(array(
	"offset" => '',
	"num" => '5',
	"thumbs" => 'false',
	"excerpt" => 'false',
	"length" => '50',
	"morelink" => '',
	"width" => '100',
	"height" => '100',
	"type" => 'post',
	"parent" => '',
	"cat" => '',
	"orderby" => 'date',
	"order" => 'ASC'
	), $atts));
	global $post;
	
	$do_not_duplicate[] = $post->ID;
	$args = array(
	  'post__not_in' => $do_not_duplicate,
		'cat' => $cat,
		'post_type' => $type,
		'post_parent'	=> $parent,
		'showposts' => $num,
		'orderby' => $orderby,
		'offset' => $offset,
		'order' => $order
		);
	// query
	$myposts = new WP_Query($args);
	
	// container
	$result='<div id="category-'.$cat.'" class="latestposts">';

	while($myposts->have_posts()) : $myposts->the_post();
		// item
		$result.='<div class="latest-item clearfix">';
		// title
		if ($excerpt == 'true') {
			$result.='<h4><a href="'.get_permalink().'">'.the_title("","",false).'</a></h4>';
		} else {
			$result.='<div class="latest-title"><a href="'.get_permalink().'">'.the_title("","",false).'</a></div>';			
		}
		
		
		// thumbnail
		if (has_post_thumbnail() && $thumbs == 'true') {
			$result.= '<img alt="'.get_the_title().'" class="alignleft latest-img" src="'.get_bloginfo('template_directory').'/thumb.php?src='.get_image_path().'&amp;h='.$height.'&amp;w='.$width.'"/>';
		}

		// excerpt		
		if ($excerpt == 'true') {
			// allowed tags in excerpts
			$allowed_tags = '<a>,<i>,<em>,<b>,<strong>,<ul>,<ol>,<li>,<blockquote>,<img>,<span>,<p>';
		 	// filter the content
			$text = preg_replace('/\[.*\]/', '', strip_tags(get_the_excerpt(), $allowed_tags));
			// remove the more-link
			$pattern = '/(<a.*?class="more-link"[^>]*>)(.*?)(<\/a>)/';
			// display the new excerpt
			$content = preg_replace($pattern,"", $text);
			$result.= '<div class="latest-excerpt">'.st_limit_words($content,$length).'</div>';
		}
		
		// excerpt		
		if ($morelink) {
			$result.= '<a class="more-link" href="'.get_permalink().'">'.$morelink.'</a>';
		}
		
		// item close
		$result.='</div>';
  
	endwhile;
		wp_reset_postdata();
	
	// container close
	$result.='</div>';
	return $result;
}
add_shortcode("latest", "st_latest");

// Example Use: [latest excerpt="true" thumbs="true" width="50" height="50" num="5" cat="8,10,11"]

/*-----------------------------------------------------------------------------------*/
// Creates an additional hook to limit the excerpt
/*-----------------------------------------------------------------------------------*/

function mosaic_limit_words($string, $word_limit) {
	// creates an array of words from $string (this will be our excerpt)
	// explode divides the excerpt up by using a space character
	$words = explode(' ', $string);
	// this next bit chops the $words array and sticks it back together
	// starting at the first word '0' and ending at the $word_limit
	// the $word_limit which is passed in the function will be the number
	// of words we want to use
	// implode glues the chopped up array back together using a space character
	return implode(' ', array_slice($words, 0, $word_limit));
}


// Related Posts - [related_posts]
add_shortcode('related_posts', 'mosaic_related_posts');
function mosaic_related_posts( $atts ) {
	extract(shortcode_atts(array(
	    'limit' => '5',
	), $atts));

	global $wpdb, $post, $table_prefix;

	if ($post->ID) {
		$retval = '<div class="st_relatedposts">';
		$retval .= __( '<h4>Related Posts</h4>', 'mosaic' );
		$retval .= '<ul>';
 		// Get tags
		$tags = wp_get_post_tags($post->ID);
		$tagsarray = array();
		foreach ($tags as $tag) {
			$tagsarray[] = $tag->term_id;
		}
		$tagslist = implode(',', $tagsarray);

		// Do the query
		$q = "SELECT p.*, count(tr.object_id) as count
			FROM $wpdb->term_taxonomy AS tt, $wpdb->term_relationships AS tr, $wpdb->posts AS p WHERE tt.taxonomy ='post_tag' AND tt.term_taxonomy_id = tr.term_taxonomy_id AND tr.object_id  = p.ID AND tt.term_id IN ($tagslist) AND p.ID != $post->ID
				AND p.post_status = 'publish'
				AND p.post_date_gmt < NOW()
 			GROUP BY tr.object_id
			ORDER BY count DESC, p.post_date_gmt DESC
			LIMIT $limit;";

		$related = $wpdb->get_results($q);
 		if ( $related ) {
			foreach($related as $r) {
				$retval .= '<li><a title="'.wptexturize($r->post_title).'" href="'.get_permalink($r->ID).'">'.wptexturize($r->post_title).'</a></li>';
			}
		} else {
			$retval .= __( '<li>No related posts found</li>', 'mosaic' );
		}
		$retval .= '</ul>';
		$retval .= '</div>';
		return $retval;
	}
	return;
}

// Break
function mosaic_break( $atts, $content = null ) {
	return '<div class="clear"></div>';
}
add_shortcode('clear', 'mosaic_break');


// Line Break
function mosaic_linebreak( $atts, $content = null ) {
	return '<hr /><div class="clear"></div>';
}
add_shortcode('clearline', 'mosaic_linebreak');


// Return Full Copyright
function mosaic_footer_copyright( $atts ){
	return get_bloginfo('name') . ' &copy; ' . date('Y');
}
add_shortcode( 'footer_copyright', 'mosaic_footer_copyright' );


// Link to WordPress
function mosaic_footer_wordpress_link( $atts ){
	return '<a href="http://wordpress.org/">WordPress</a>';
}
add_shortcode( 'footer_wordpress_link', 'mosaic_footer_wordpress_link' );


// Link to WildWebLab
function mosaic_footer_wildweblab_link( $atts ){
	return '<a href="http://wildweblab.com/">WildWebLab</a>';
}
add_shortcode( 'footer_wildweblab_link', 'mosaic_footer_wildweblab_link' );


// Link to Post Autor
function mosaic_post_author( $atts ) {

	$defaults = array(
		'before' => '',
		'after'  => '',
	);
	$atts = shortcode_atts( $defaults, $atts );

	return sprintf( '%1$s<span class="author vcard"><a class="url fn n" href="%2$s" title="%3$s">%4$s</a></span>%5$s',
		$atts['before'],
		get_author_posts_url( get_the_author_meta( 'ID' ) ),
		sprintf( esc_attr__( 'View all posts by %s', 'mosaic' ), get_the_author() ),
		get_the_author(),
		$atts['after']
	);
}
add_shortcode( 'post_author', 'mosaic_post_author' );


// Post Date
function mosaic_post_date( $atts ) {

	$defaults = array(
		'before' => '',
		'after'  => '',
	);
	$atts = shortcode_atts( $defaults, $atts );
		
	return sprintf( '%1$s<span class="entry-date"><a href="%2$s" title="%3$s" rel="bookmark">%4$s</a></span>%5$s',
		$atts['before'],
		get_permalink(),
		esc_attr( get_the_time() ),
		get_the_date(),
		$atts['after']
	);
}
add_shortcode( 'post_date', 'mosaic_post_date' );


// Link Edit
function mosaic_post_edit( $atts ) {
	if($edit_link = get_edit_post_link()) {
		
		$defaults = array(
			'before' => '&middot; ',
			'after'  => '',
		);
		$atts = shortcode_atts( $defaults, $atts );
		
		return sprintf( '%1$s<span class="edit-link"><a href="%2$s">%3$s</a></span>%4$s',
			$atts['before'],
			$edit_link,
			__( 'Edit', 'mosaic' ),
			$atts['after']
		);
	}
}
add_shortcode( 'post_edit', 'mosaic_post_edit' );


// Post Tags
function mosaic_post_tags( $atts ) {
	if( $tags = get_the_tag_list( '', ', ' ) ) {
		
		$defaults = array(
			'before' => __( 'Tagged with ', 'mosaic' ),
			'after'  => '. ',
		);
		$atts = shortcode_atts( $defaults, $atts );
		
		return $atts['before'] . $tags . $atts['after'];
	}
}
add_shortcode( 'post_tags', 'mosaic_post_tags' );


// Post Categories
function mosaic_post_categories( $atts ) {
	if( $categories = get_the_category_list( ', ' ) ) {
	
		$defaults = array(
			'before' => __( 'Posted in ', 'mosaic' ),
			'after'  => '. ',
		);
		$atts = shortcode_atts( $defaults, $atts );
		
		return $atts['before'] . $categories . $atts['after'];
	}
}
add_shortcode( 'post_categories', 'mosaic_post_categories' );


// Link to Post Comments
function mosaic_post_comments( $atts ) {
	ob_start();
	comments_popup_link( __( 'Leave a comment', 'mosaic' ), __( '1 Comment', 'mosaic' ), __( '% Comments', 'mosaic' ) );
	$comments_link = ob_get_clean();
	
	$defaults = array(
		'before' => ' &middot; ',
		'after'  => '',
	);
	$atts = shortcode_atts( $defaults, $atts );
	
	return sprintf( '<span class="comments-link">%1$s</span>',
		$atts['before'] . $comments_link . $atts['after']
	);
}
add_shortcode( 'post_comments', 'mosaic_post_comments' );