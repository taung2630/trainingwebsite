<?php




if ( ! defined('ABSPATH')) exit; // if direct access 



function up_paratheme_query_single_field($atts) {
		$atts = shortcode_atts(
			array(
				'id' => "",  //Author ID
				'meta_key' => "",
				'icon' => "",
				), $atts);


			$author_id = $atts['id'];
			$meta_key = $atts['meta_key'];
			$icon = $atts['icon'];
			
			
			$html = '';
			if($meta_key=="user_pass")
				{
					$html .= 'This field is restricted.';
				}
			else
				{
					if(!empty($icon))
						{
							$html .= '<i class="fa fa-'.$icon.'"></i>  ';
						}
					
					$html .= get_the_author_meta( $meta_key, $author_id );
				}
			
			
			
			
			echo $html;	
							
							





}

add_shortcode('up_single', 'up_paratheme_query_single_field');










function up_paratheme_author_profile($atts) {
		$atts = shortcode_atts(
			array(
				'id' => "", //author id
				'themes' => "flat", //author id				

				), $atts);


			$author_id = $atts['id'];
			$themes = $atts['themes'];

			$html = '';

			if($themes== "flat")
				{
					$html.= up_paratheme_ap_theme_flat($author_id);
				}
			

			return $html;



		}

add_shortcode('up_author_profile', 'up_paratheme_author_profile');
















