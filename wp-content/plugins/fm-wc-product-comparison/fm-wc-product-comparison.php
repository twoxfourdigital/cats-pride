<?php
/*
Plugin Name: FM Product Comparison
Description: An Extension for WooCommerce that lets you display a product comparison chart.
Plugin URI: https://www.futuramicmedia.com
Author: Futuramic Media
Author URI: https://www.futuramicmedia.com
Version: 1.0.0
License: http://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
WC requires at least: 3.0.0
WC tested up to: 3.6.4
Text Domain: fm-wc-product-comparison
Domain Path: /languages
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( !defined('FM_WC_PRODUCT_COMPARISON_DIR') ){
	define('FM_WC_PRODUCT_COMPARISON_DIR', dirname(__FILE__));
}

if ( !defined('FM_WC_PRODUCT_COMPARISON_FILE') ){
	define('FM_WC_PRODUCT_COMPARISON_FILE', __FILE__);
}

if ( !function_exists('is_woocommerce_active') ){
	require_once('includes/woo-functions.php');
}

if ( is_woocommerce_active() ){
	require_once('classes/class-fm-wc-product-comparison.php');
}

function fm_wc_product_comparison_load_text_domain() {
    load_plugin_textdomain( 'fm-wc-product-comparison', FALSE, plugin_basename( dirname( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'fm_wc_product_comparison_load_text_domain' );