<?php
/*
Plugin Name: FM Preview Emails
Description: An Extension for WooCommerce that lets you Preview Emails, without having to send them.
Plugin URI: https://www.futuramicmedia.com
Author: Futuramic Media
Author URI: https://www.futuramicmedia.com
Version: 1.0.0
License: http://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
WC requires at least: 3.0.0
WC tested up to: 3.5.1
Text Domain: fm-wc-preview-emails
Domain Path: /languages
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if( !defined('FM_WC_PREVIEW_EMAILS_DIR') ){
	define('FM_WC_PREVIEW_EMAILS_DIR', dirname(__FILE__));
}

if( !defined('FM_WC_PREVIEW_EMAILS_FILE') ){
	define('FM_WC_PREVIEW_EMAILS_FILE', __FILE__);
}

if( !function_exists('is_woocommerce_active') ){
	require_once('includes/woo-functions.php');
}

if( is_woocommerce_active() ){
	require_once('classes/class-fm-wc-preview-emails.php');
}

function FM_WC_PREVIEW_EMAILS_load_text_domain() {
    load_plugin_textdomain( 'fm-wc-preview-emails', FALSE, plugin_basename( dirname( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'FM_WC_PREVIEW_EMAILS_load_text_domain' );