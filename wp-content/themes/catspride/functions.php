<?php

/**
 * Require file where we can set theme config values
 */
require get_template_directory() . '/theme-config.php';

/**
 ** DON'T TOUCH THIS. This is the file that's requiring all the needed
 ** files for the theme to function correctly.
 */
require get_template_directory() . '/core/index.php';

/***********************************************************************
 ** START EDITING FROM HERE
 */

/**
 * Require file where we can include different scripts (plugins...)
 */
require get_template_directory() . '/includes/enqueue_scripts_and_styles.php';


/**
 * Require file where we can define custom image sizes
 */
require get_template_directory() . '/includes/custom_image_sizes.php';

/**
 * Autoloader
 */

require_once get_template_directory() . '/vendor/autoload.php';

/**
 * Require file where we can write custom functions per project
 */
require get_template_directory() . '/includes/theme_functions.php';

add_action('user_register', 'send_social_login_welcome_email', 10, 1);
function send_social_login_welcome_email($user_id) {
    $user = get_userdata($user_id);

    // Avoid double emails — only send if this is the first login
    if (get_user_meta($user_id, '_social_login_welcome_sent', true)) {
        return;
    }

    // Mark welcome email as sent
    update_user_meta($user_id, '_social_login_welcome_sent', true);

    // Send welcome email
    $to = $user->user_email;
    $subject = 'Welcome to Cat’s Pride!';
    $message = "Hi " . $user->display_name . ",\n\nThanks for joining Cat’s Pride! You can access your member dashboard any time at https://catspride.com/member-dashboard.";

    wp_mail($to, $subject, $message);
}

add_filter( 'woocommerce_social_login_get_redirect_url', function( $url ) {
    return preg_replace( '/^http:/i', 'https:', $url );
});
add_filter( 'woocommerce_social_login_get_redirect_url', function( $url, $provider ) {
    // Force HTTPS only for Google login
    if ( isset( $provider->slug ) && $provider->slug === 'google' ) {
        $url = preg_replace( '/^http:/i', 'https:', $url );
    }
    return $url;
}, 10, 2 );

add_filter( 'woocommerce_social_login_provider_google_args', function( $args ) {
    $args['redirect_url'] = 'https://catspride.com/?wc-api=auth&done=google';
    return $args;
});

add_filter( 'woocommerce_social_login_provider_google_args', function( $args ) {
    $args['redirect_url'] = 'https://catspride.com/?wc-api=auth&done=google';
    error_log('Google login redirect override: ' . $args['redirect_url']);
    return $args;
});

add_action('init', function() {
    update_option( 'wc_social_login_force_ssl_callback_url', 'yes' );
});
