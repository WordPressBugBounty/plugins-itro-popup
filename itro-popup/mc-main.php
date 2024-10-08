<?php
/*
Plugin Name: ITRO Popup Plugin
Plugin URI: https://www.itroteam.com
Description: EN - Show a perfecly centered customizable popup and a popup-system for age-restricted site and allow to insert own HTML code. IT - Visualizza un popup perfettamente centrato e personalizzabile con possibile blocco per i siti con restrizioni di eta' e permette di inserire il proprio codice HTML.
Author: ITRO Team
E-mail: support@itroteam.com
Text Domain: itro-popup
Version: 5.2.6
Author URI: https://www.itroteam.com
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $ITRO_VER;
$ITRO_VER = '5.2.6';

global $popup_fired; //it check if there is a popup visualization via shortcode or via automatic visualization
$popup_fired = false;

define('ippRootPath', basename( dirname( __FILE__ ) ) . "/");
define('ippitroPath', plugins_url() . '/' . ippRootPath);
define('ippitroImages', plugins_url() . '/' . ippRootPath . 'images/');

include_once ('functions/core-function.php');
include_once ('functions/database-function.php');
include_once ('functions/js-function.php');
include_once ('templates/itro-popup-template.php');
include_once ('css/itro-style-functions.php');

load_plugin_textdomain('itro-plugin', false, basename( dirname( __FILE__ ) ) . '/languages' );

global $post;

register_activation_hook( __FILE__, 'ipp_itro_init');

function itro_admin_scripts()
{
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_enqueue_script('jquery-effects-highlight');
	wp_enqueue_script('jquery-effects-fade');
	wp_enqueue_script('jquery-effects-blind');
	wp_register_script( 'itro-admin-scripts', ippitroPath . 'scripts/itro-admin-scripts.js', array( 'jquery' ) );
	wp_enqueue_script( 'itro-admin-scripts' );
}

function itro_load_admin_styles() 
{
	wp_enqueue_style('thickbox');
	wp_enqueue_style('itro-admin-style', ippitroPath . 'css/itro-admin-style.css');
}

function itro_load_script()
{
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'itro-scripts', ippitroPath . 'scripts/itro-scripts.js', array( 'jquery' ) );
}

function itro_get_woo_shop_id(): void
{
	ipp_update_option('woo_shop_id', get_the_id());
}



/* check current version for db update: forced with init function due register_activation_hook not working with automatic updates */
add_action( 'init', 'ipp_check_ver');

add_action( 'woocommerce_before_shop_loop' , 'itro_get_woo_shop_id' );

add_action( 'wp_footer', 'ipp_display_popup');
add_action( 'wp_enqueue_scripts' , 'itro_load_script' );

add_action('admin_print_scripts', 'itro_admin_scripts');
add_action('admin_print_styles', 'itro_load_admin_styles');
add_action('admin_menu', 'ipp_itro_plugin_menu');
?>
