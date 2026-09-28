<?php
/**
 * Register shelter invite email
 */

if ( ! defined( 'ABSPATH' ) && !isset($_GET['test']) ) {
    exit; // Exit if accessed directly
}

?>

<?php do_action( 'woocommerce_email_header', $email_heading, $email ); ?>

    <p><strong><?php  _e( 'We received a request from your account for your shelter to be opted out of the Litter for ' .
                'Good&trade; program. By opting-out of the program, you understand ' .
                'that you will no longer be eligible for litter donations.', 'catspride' ); ?></strong></p>

    <p><?php printf( __(
            'To confirm that you would like to opt-out of this program, ' .
            'please click the following link, or copy it into your web ' .
            'browser: %s', 'catspride' ), make_clickable( esc_url( $optout_url ) ) ); ?></p>

    <p><?php _e('If you would like to opt back in, please contact Cat\'s Pride at litterforgood@catspride.com or call 1-800-645-3741.', 'catspride'); ?></p>

<?php do_action( 'woocommerce_email_footer', $email );

