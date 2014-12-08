<?php
/*
Plugin Name: User Profile
Plugin URI: 
Description: Creating unlimited user profile field.
Version: 1.0
Author: paratheme
Author URI: http://paratheme.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

define('up_paratheme_plugin_url', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );
define('up_paratheme_plugin_dir', plugin_dir_path( __FILE__ ) );
define('up_paratheme_wp_url', 'http://wordpress.org/plugins/user-profile/' );
define('up_paratheme_pro_url', '' );
define('up_paratheme_demo_url', '' );
define('up_paratheme_conatct_url', 'http://paratheme.com/contact' );
define('up_paratheme_plugin_name', 'User Profile' );
define('up_paratheme_share_url', 'http://wordpress.org/plugins/user-profile/' );


require_once( plugin_dir_path( __FILE__ ) . 'includes/up-paratheme-functions.php');
require_once( plugin_dir_path( __FILE__ ) . 'includes/up-paratheme-shortcodes.php');


//Themes php files
require_once( plugin_dir_path( __FILE__ ) . 'themes/flat/index.php');




function up_paratheme_init_scripts()
	{
		wp_enqueue_script('jquery');
		wp_enqueue_script('up_paratheme_js', plugins_url( '/js/up-paratheme-scripts.js' , __FILE__ ) , array( 'jquery' ));	
		
		wp_localize_script('up_paratheme_js', 'up_paratheme_ajax', array( 'up_paratheme_ajaxurl' => admin_url( 'admin-ajax.php')));
		wp_enqueue_style('font-awesome', up_paratheme_plugin_url.'css/font-awesome.css');		
		wp_enqueue_style('up_paratheme_style', up_paratheme_plugin_url.'css/style.css');
		wp_enqueue_style('ParaAdmin', up_paratheme_plugin_url.'ParaAdmin/css/ParaAdmin.css');	
		wp_enqueue_script('ParaAdmin', plugins_url( 'ParaAdmin/js/ParaAdmin.js' , __FILE__ ) , array( 'jquery' ));	

		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'up_paratheme_color_picker', plugins_url('/js/color-picker.js', __FILE__ ), array( 'wp-color-picker' ), false, true );

		
		// Style for themes
		wp_enqueue_style('up_paratheme-style-flat', up_paratheme_plugin_url.'themes/flat/style.css');



		
	}
add_action("init","up_paratheme_init_scripts");


add_action( 'admin_enqueue_scripts', 'wp_enqueue_media' ); // to work upload button on user profile




register_activation_hook(__FILE__, 'up_paratheme_activation');


function up_paratheme_activation()
	{
		$up_paratheme_version= "1.1";
		update_option('up_paratheme_version', $up_paratheme_version); //update plugin version.
		
		$up_paratheme_customer_type= "free"; //customer_type "free"
		update_option('up_paratheme_customer_type', $up_paratheme_customer_type); //update plugin version.
	}





add_action('admin_menu', 'up_paratheme_menu_init');


	
function up_paratheme_menu_help(){
	include('up-paratheme-help.php');	
}

function up_paratheme_menu_settings(){
	include('up-paratheme-settings.php');	
}

function up_paratheme_menu_init()
	{
		add_menu_page(__('up-paratheme','up-paratheme'), __('User Profile','author_box'), 'manage_options', 'up_paratheme_menu_settings', 'up_paratheme_menu_settings');


		add_submenu_page('up_paratheme_menu_settings', __('Help & Upgrade','menu-up_paratheme'), __('Help & Upgrade','menu-up_paratheme'), 'manage_options', 'up_paratheme_menu_help', 'up_paratheme_menu_help');

	}





?>