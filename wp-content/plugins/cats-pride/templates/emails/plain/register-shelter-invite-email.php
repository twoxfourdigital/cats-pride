<?php
/**
 * Register shelter invite email
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

echo "= " . $email_heading . " =\n\n";

_e( 'Your shelter has been nominated by supporters to participate in the Cat\'s Pride Litter for ' .
    'Good&trade; donation program.', 'catspride' ) . "\n\n";

printf( __(
    'Litter for Good™ is a Cat\'s Pride initiative through which we donate a pound of litter to shelters' .
    ' for every jug of Fresh & Light litter sold. And now, your shelter is eligible to receive a ' .
    'share of that litter. No asterisk. No charge.  All you need to do is go to: %s and complete ' .
    'your registration.', 'catspride' ), make_clickable( esc_url( $registration_url ) ) ) . "\n\n";

_e('The more nominations you receive, the more litter you can claim!', 'catspride') . "\n\n";

printf( __(
        'Want to inspire more of your supporters to increase your nominations?  Once you\'re registered, you can ' .
        'download email and social media messaging templates here: %s ', 'catspride' ), make_clickable( esc_url( wc_get_account_endpoint_url( 'shelter-resources' ) ) ) );

printf( __(
        'Or, just share this video, %s, on your social channels and let them know about the program and how to ' .
        'nominate you!', 'catspride' ), make_clickable( esc_url( 'https://youtu.be/-M6bn4_aELc' ) ) ) . "\n\n";

echo "\n=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=\n\n";

echo apply_filters( 'woocommerce_email_footer_text', get_option( 'woocommerce_email_footer_text' ) );