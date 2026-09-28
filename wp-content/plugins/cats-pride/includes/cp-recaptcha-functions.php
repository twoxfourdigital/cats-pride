<?php

/**
 * Add in the recaptcha javascript code
 */
function cp_recaptcha_hook_javascript() {

    echo "<script src='https://www.google.com/recaptcha/api.js'></script>";

}
if ( cp_recaptcha_is_active() ) {
    add_action('wp_head', 'cp_recaptcha_hook_javascript');
}

/**
 * Add in the recaptcha div
 */
function cp_registration_captcha() {

    echo '<div class="g-recaptcha" style="margin-top:20px;" data-sitekey="' . GOOGLE_RECAPTCHA_SITE_KEY. '"></div>';

}
if ( cp_recaptcha_is_active() ) {
    add_action('woocommerce_register_form', 'cp_registration_captcha');
}

/**
 * @param $errors
 * @param $username
 * @param $email
 * @return mixed
 */
function cp_validate_recaptcha_register_fields( $errors, $username, $email ) {

    if( !isset( $_POST[ 'g-recaptcha-response' ] ) || empty( $_POST[ 'g-recaptcha-response' ] ) ) {

        $errors->add( 'recaptcha_error', __( 'Please complete the re-captcha to continue registration.', 'catspride' ) );

    } else {

        $data = array(
            'secret' => GOOGLE_RECAPTCHA_SECRET_KEY,
            'response' => $_POST[ 'g-recaptcha-response' ],
            'remoteip' => $_SERVER['REMOTE_ADDR']
        );

        $cp = curl_init();

        curl_setopt( $cp, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify' );
        curl_setopt( $cp, CURLOPT_POST, true);
        curl_setopt( $cp, CURLOPT_POSTFIELDS, http_build_query( $data ) );
        curl_setopt( $cp, CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $cp, CURLOPT_RETURNTRANSFER, true );

        $response = curl_exec($cp);

        if ( $response ) {

            $check = json_decode( $response );

            if ( !$check->success ) {
                $errors->add( 'recaptcha_error', __( 'Please complete the re-captcha to continue registration.', 'catspride' ) );
            }

        }

    }

    return $errors;
}
if ( cp_recaptcha_is_active() ) {
    add_filter('woocommerce_registration_errors', 'cp_validate_recaptcha_register_fields', 10, 3);
}

/**
 * @return bool
 */
function cp_recaptcha_is_active() {
    return ( defined( 'GOOGLE_RECAPTCHA_SITE_KEY') && !empty( GOOGLE_RECAPTCHA_SITE_KEY )
            && defined( 'GOOGLE_RECAPTCHA_SECRET_KEY') && !empty( GOOGLE_RECAPTCHA_SECRET_KEY ) );
}