<?php
/**
 * Cat's Pride Core Functions
 *
 * General core functions available on both the front-end and admin.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

include( CP_ABSPATH . 'includes/cp-account-functions.php' );
include( CP_ABSPATH . 'includes/cp-shelter-functions.php' );
include( CP_ABSPATH . 'includes/cp-store-locator-functions.php' );
include( CP_ABSPATH . 'includes/cp-gtm-functions.php' );
include( CP_ABSPATH . 'includes/cp-recaptcha-functions.php' );
include( CP_ABSPATH . 'includes/cp-active-campaign-functions.php' );
include( CP_ABSPATH . 'includes/cp-download-tracking-functions.php' );

if( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
        'page_title' 	=> 'General Settings',
        'menu_title'	=> 'General Settings',
        'menu_slug' 	=> 'general-settings',
        'capability'	=> 'edit_posts',
        'redirect'		=> false
    ));

}

/**
 * @param $string
 * @return mixed
 */
function cp_convert_youtube_url_to_embed( $string, $height = 400 ) {
    return preg_replace(
        "/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
        "<iframe src=\"//www.youtube.com/embed/$2\" height=\"{$height}\" allowfullscreen></iframe>",
        $string
    );
}

/**
 * Define a constant if it is not already defined.
 *
 * @param string $name  Constant name.
 * @param string $value Value.
 */
function cp_maybe_define_constant( $name, $value ) {
    if ( ! defined( $name ) ) {
        define( $name, $value );
    }
}

/**
 * Retrieve the full list of products and BazaarVoice IDs associated with those products
 */
function cp_get_product_bv_ids()
{
    global $wpdb;
    exit();
    $products = maybe_unserialize( get_transient( 'cp_bazaarvoice_products' ) );

    if( $products === false ) {

        $query = "SELECT p.ID as product_id, 
                         pm.meta_value as external_product_id
                  FROM {$wpdb->posts} p 
                  INNER JOIN {$wpdb->postmeta} pm 
                    ON (p.ID = pm.post_id AND pm.meta_key = 'bazaarvoice_product_id' AND pm.meta_value != '')
                  WHERE p.post_type = 'product' AND p.post_status = 'publish'";

        $results = $wpdb->get_results($query, ARRAY_A);
        $products = array();

        foreach ($results as $product) {
            $products[$product['product_id']] = $product['external_product_id'];
        }

        // Save for an hour
        set_transient( 'cp_bazaarvoice_products', $products, 60 * 60);

    }
    return $products;

}

/**
 * Registers the default log handler.
 *
 * @param array $handlers
 * @return array
 */
function cp_register_default_log_handler( $handlers ) {

    if ( defined( 'BCPP_LOG_HANDLER' ) && class_exists( BCPP_LOG_HANDLER ) ) {

        $handler_class = BCPP_LOG_HANDLER;
        $default_handler = new $handler_class();

    } else {

        $default_handler = new CP_Log_Handler_DB();

    }

    array_push( $handlers, $default_handler );

    return $handlers;

}
add_filter( 'cp_register_log_handlers', 'cp_register_default_log_handler' );

/**
 * Get a shared logger instance.
 *
 * Use the cp_logging_class filter to change the logging class. You may provide one of the following:
 *     - a class name which will be instantiated as `new $class` with no arguments
 *     - an instance which will be used directly as the logger
 * In either case, the class or instance *must* implement CP_Logger_Interface.
 *
 * @see CP_Logger_Interface
 *
 * @return CP_Logger
 */
function cp_get_logger() {
    static $logger = null;
    if ( null === $logger ) {
        $class = apply_filters( 'cp_logging_class', 'CP_Logger' );
        $implements = class_implements( $class );
        if ( is_array( $implements ) && in_array( 'CP_Logger_Interface', $implements ) ) {
            if ( is_object( $class ) ) {
                $logger = $class;
            } else {
                $logger = new $class();
            }
        } else {
            wc_doing_it_wrong(
                __FUNCTION__,
                sprintf(
                    __( 'The class %1$s provided by %2$s filter must implement %3$s.', 'catspride' ),
                    '<code>' . esc_html( is_object( $class ) ? get_class( $class ) : $class ) . '</code>',
                    '<code>cp_logging_class</code>',
                    '<code>CP_Logger_Interface</code>'
                ),
                '3.0'
            );
            $logger = new CP_Logger();
        }
    }
    return $logger;
}

/**
 * @param null $group
 * @param null $object_type
 * @param null $object_type_id
 * @return array|null|object
 */
function cp_get_logs( $group = null, $object_type = null, $object_type_id = null )
{
    global $wpdb;

    $where = '';
    $params = [];

    if ( $group !== null ) {
        $where .= ' AND `log_group` = %s ';
        $params[] = $group;
    }

    if ( $object_type !== null ) {
        $where .= ' AND `object_type` = %s ';
        $params[] = $object_type;
    }

    if ( $object_type_id !== null ) {
        $where .= ' AND `object_type_id` = %s ';
        $params[] = $object_type_id;
    }

    return $wpdb->get_results( $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}cp_logs WHERE 1=1 {$where} ORDER BY `log_timestamp` ASC", $params ), ARRAY_A );
}

/**
 * @param $content
 * @param bool $exit
 */
function cp_dd( $content, $exit = true ) {
    echo '<pre>';
    var_dump( $content );
    echo '</pre>';

    if ( $exit === true )
        exit;
}

/**
 * @param $version
 * @return array|null|object|void
 */
function cp_get_migration_by_version( $version )
{
    global $wpdb;

    return $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}cp_migrations WHERE migration_version = %s", [ $version ] ) );
}

/**
 * @param $date
 * @param string $format
 * @return bool
 */
function cp_validate_date($date, $format = 'Y-m-d H:i:s')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

/**
 * @return string
 */
function cp_get_store_address()
{
    $countries = new WC_Countries();
    $address = array();

    $address[] = 'Oil-Dri';
    $address[] = $countries->get_base_address();
    $address[] = $countries->get_base_address_2();
    $address[] = $countries->get_base_city();
    $address[] = $countries->get_base_state();
    $address[] = $countries->get_base_postcode();

    return implode(', ', $address);
}

/**
 * Set a cookie - wrapper for setcookie using WP constants.
 *
 * @param  string  $name   Name of the cookie being set.
 * @param  string  $value  Value of the cookie.
 * @param  integer $expire Expiry of the cookie.
 * @param  string  $secure Whether the cookie should be served only over https.
 */
function cp_setcookie( $name, $value, $expire = 0, $secure = false ) {
    if ( ! headers_sent() ) {
        setcookie( $name, $value, $expire, COOKIEPATH ? COOKIEPATH : '/', COOKIE_DOMAIN, $secure );
    } elseif ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
        headers_sent( $file, $line );
        trigger_error( "{$name} cookie cannot be set - headers already sent by {$file} on line {$line}", E_USER_NOTICE );
    }
}


/**
 * Apparently, WordPress does not save the post_date_gmt/post_modified_gmt on post inserts that are pending or draft. It will only set
 * this value if a post is published. This does not make any sense to me, and is causing issues with the date display
 * when exporting shelters with a creation date showing up as -42 in Excel due to the date not being set correctly for
 * these shelters. This function will update any shelter records that are missing the date value and set it.
 */
function cp_force_create_date_gmt_sync() {

    if ( 'GET' !== strtoupper( $_SERVER['REQUEST_METHOD'] ) || !isset( $_GET['_cp_force_create_date_gmt_sync'] ) || !is_admin() ) {
        return;
    }

    global $wpdb;

    $wpdb->query("UPDATE {$wpdb->posts} SET post_date_gmt = CONVERT_TZ(post_date, @@session.time_zone, '+00:00') WHERE post_type = 'cp_shelter' AND (post_date_gmt IS NULL OR post_date_gmt = '0000-00-00 00:00:00')");
    $wpdb->query("UPDATE {$wpdb->posts} SET post_modified_gmt = CONVERT_TZ(post_modified, @@session.time_zone, '+00:00') WHERE post_type = 'cp_shelter' AND (post_modified_gmt IS NULL OR post_modified_gmt = '0000-00-00 00:00:00')");

}

add_action( 'wp_loaded', 'cp_force_create_date_gmt_sync', 20 );

/**
 * Disable Admin Notification of User Password Change
 *
 * @see pluggable.php
 */
if ( ! function_exists( 'wp_password_change_notification' ) ) {
    function wp_password_change_notification( $user ) {
        return;
    }
}