<?php
/**
 * Register shelter invite email
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

echo "= " . $email_heading . " =\n\n";

_e( 'We received a request from your account for your shelter to be opted out of the Litter for ' .
    'Good program. By opting-out of the program, you understand ' .
    'that you will no longer be eligible for litter donations.', 'catspride' ) . "\n\n";

printf( __(
    'To confirm that you would like to opt-out of this program, ' .
    'please click the following link, or copy it into your web ' .
    'browser: %s', 'catspride' ),  $optout_url ) . "\n\n";

 _e('If you would like to opt back in, please contact Cat\'s Pride at litterforgood@catspride.com or call 1-800-645-3741.', 'catspride');

echo "\n=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=\n\n";

echo apply_filters( 'woocommerce_email_footer_text', get_option( 'woocommerce_email_footer_text' ) );