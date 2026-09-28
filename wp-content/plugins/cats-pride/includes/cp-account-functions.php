<?php

/**
 * Cat's Pride Account Functions
 *
 * Functions for account specific things.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * @return array
 */
function cp_get_preferred_litter_types()
{
    return array(
        "Fresh & Light Ultimate Care Scented",
        "Fresh & Light Ultimate Care Unscented Hypoallergenic",
        "Fresh & Light Quick Action",
        "Fresh & Light Fragrance Free",
        "Fresh & Light All Day Odor Control",
        "Cat's Pride Scoopable Scented",
        "Cat's Pride Scoopable Unscented",
        "Cat's Pride Lightweight Scoopable Scented",
        "Cat's Pride Lightweight Scoopable Unscented",
        "Cat's Pride Complete Multi-Cat Scoop",
        "Cat's Pride Natural Unscented Scoop",
        "Cat's Pride Fresh & Clean",
        "Cat's Pride Complete Multi-Cat",
        "Cat's Pride Natural",
        "Other"
    );
}

/**
 * Account menu items
 *
 * @param arr $items
 * @return arr
 */
function cp_account_menu_items( $items )
{

    $items['shelter-resources'] = __( 'Shelter Resources', 'catspride' );
    $items['edit-shelter']      = __( 'Edit Shelter', 'catspride' );
    $items['nominate-shelter']  = __( 'Nominate Shelter', 'catspride' );
    $items['optout-shelter']    = __( 'Opt-Out Shelter', 'catspride' );
    $items['choose-shelter']    = __( 'Choose Shelter', 'catspride' );

    return $items;

}
add_filter( 'woocommerce_account_menu_items', 'cp_account_menu_items', 10, 1 );

/**
* Add in another page associated with the my account area - Nominate a Shelter Page
*/
function cp_add_my_account_nominate_shelter_page_endpoint()
{
    add_rewrite_endpoint( 'shelter-resources', EP_PAGES );
    add_rewrite_endpoint( 'edit-shelter', EP_PAGES );
    add_rewrite_endpoint( 'nominate-shelter', EP_PAGES );
    add_rewrite_endpoint( 'optout-shelter', EP_PAGES );
    add_rewrite_endpoint( 'choose-shelter', EP_PAGES );
}
add_action( 'init', 'cp_add_my_account_nominate_shelter_page_endpoint' );

/**
 * Output content for the shelter resources page
 */
function cp_shelter_resources_endpoint_content()
{
    require_once( CP_TEMPLATES_PATH . '/myaccount/page-shelter-resources.php');
}
add_action( 'woocommerce_account_shelter-resources_endpoint', 'cp_shelter_resources_endpoint_content' );

/**
 * Output content for the edit shelter page
 */
function cp_edit_shelter_endpoint_content()
{
    require_once( CP_TEMPLATES_PATH . '/myaccount/form-edit-shelter.php');
}
add_action( 'woocommerce_account_edit-shelter_endpoint', 'cp_edit_shelter_endpoint_content' );


/**
 * Output content for the nominate shelter page
 */
function cp_nominate_shelter_endpoint_content()
{
    require_once( CP_TEMPLATES_PATH . '/myaccount/form-nominate-shelter.php');
}
add_action( 'woocommerce_account_nominate-shelter_endpoint', 'cp_nominate_shelter_endpoint_content' );

/**
 * Output content for the nominate shelter page
 */
function cp_optout_shelter_endpoint_content()
{
    require_once( CP_TEMPLATES_PATH . '/myaccount/form-optout-shelter.php');
}
add_action( 'woocommerce_account_optout-shelter_endpoint', 'cp_optout_shelter_endpoint_content' );

/**
 * Output content for the choose shelter page
 */
function cp_choose_shelter_endpoint_content()
{
    require_once( CP_TEMPLATES_PATH . '/myaccount/page-choose-shelter.php');
}
add_action( 'woocommerce_account_choose-shelter_endpoint', 'cp_choose_shelter_endpoint_content' );

/**
 * @param bool $endpoint
 * @return bool
 */
function cp_is_endpoint( $endpoint = false ) {
    global $wp_query;
    if (  !$wp_query ) {
        return false;
    }
    return isset( $wp_query->query[ $endpoint ] );
}

/**
 * @param $args
 */
function cp_validate_custom_my_account_fields( $errors, $user )
{

    if ( isset($_POST['gender']) && !in_array($_POST['gender'], array('Male', 'Female'))) {
       $errors->add( 'error', __( 'Invalid gender provided.', 'catspride' ),'');
    }

    if ( isset($_POST['pet_information']) && count($_POST['pet_information']) > 0) {
        foreach($_POST['pet_information'] as $key => $pet) {

            // If the row is empty, we will remove it from the $_POST data
            if ( isset($pet['age']) && empty($pet['age'])
                && isset($pet['name']) && empty($pet['name'])
                && isset($pet['date']) && empty($pet['date'])) {
                unset($_POST['pet_information'][$key]);
                continue;
            }

            if ( !isset($pet['age']) || !is_numeric($pet['age']) || $pet['age'] < 0 || $pet['age'] > 50) {
                $errors->add( 'error', __( 'Invalid age provided for your pet. Enter an age from 0-50.', 'catspride' ),'');
            }
            if ( !isset($pet['name']) || empty($pet['name'])) {
                $errors->add( 'error', __( 'Invalid name provided for your pet.', 'catspride' ),'');
            }

            if ( !isset($pet['date']) || empty($pet['date'])) {
                $errors->add( 'error', __( 'Invalid adoption date provided for your pet.', 'catspride' ),'');
            } else if ( isset($pet['date']) && !empty($pet['date'])) {

                $pet_date = date('Y-m-d', strtotime($pet['date']));
                $validate_date = DateTime::createFromFormat('Y-m-d', $pet_date);

                if ( ! ($validate_date && $validate_date->format('Y-m-d') == $pet_date && $pet_date <= date('Y-m-d' ) ) ) {
                    $errors->add( 'error', __( 'Invalid adoption date provided for your pet.', 'catspride' ),'');
                }
            }

        }

        if( count($_POST['pet_information']) === 0 ) {
            $errors->add('error', __('Invalid pet information provided.', 'catspride'), '');
        }

    } else if ( !isset($_POST['pet_information']) ) {
        $errors->add('error', __('Invalid pet information provided.', 'catspride'), '');
    }

    if ( isset( $_POST['preferred_litter_type'] ) && $_POST['preferred_litter_type'] != 0 && ! in_array( wp_unslash( $_POST['preferred_litter_type'] ), cp_get_preferred_litter_types() ) ) {
        $errors->add( 'error', __( 'Invalid litter type selected.', 'catspride' ),'');
    }

    if ( isset($_POST['preferred_purchase_outlet']) && !in_array($_POST['preferred_purchase_outlet'], array('Online', 'In-store'))) {
        $errors->add( 'error', __( 'Invalid purchase outlet selected.', 'catspride' ),'');
    }

    if ( isset( $_POST['birthdate'] ) && !empty( $_POST['birthdate'] ) ) {

        $birthdate = DateTime::createFromFormat('m/d', $_POST['birthdate']);

        if ( ! ( $birthdate && $birthdate->format('m/d') === $_POST[ 'birthdate' ] ) ) {
            $errors->add( 'error', __( 'Invalid birthday provided.', 'catspride' ),'');
        }
    }

}
add_action( 'woocommerce_save_account_details_errors','cp_validate_custom_my_account_fields', 10, 2 );

/**
 * Save custom account fields
 * User gender, Pet information, preferred litter type, preferred purchase outlet
 */
function cp_save_custom_my_account_fields( $user_id ) {

    if ( isset($_POST['gender']) && in_array($_POST['gender'], array('Male', 'Female'))) {
        update_user_meta( $user_id, 'gender', $_POST['gender'] );
    }

    if ( isset($_POST['preferred_litter_type']) && in_array( wp_unslash( $_POST['preferred_litter_type'] ), cp_get_preferred_litter_types() ) ) {
        update_user_meta( $user_id, 'preferred_litter_type', $_POST['preferred_litter_type'] );
    }

    if ( isset($_POST['preferred_purchase_outlet']) && in_array($_POST['preferred_purchase_outlet'], array('Online', 'In-store'))) {
        update_user_meta( $user_id, 'preferred_purchase_outlet', $_POST['preferred_purchase_outlet'] );
    }

    if ( isset( $_POST['birthdate'] ) && !empty( $_POST['birthdate'] ) ) {
        $birthdate = date( 'm/d', strtotime( $_POST['birthdate'] ) );
    } else {
        $birthdate = null;
    }

    update_user_meta( $user_id, 'birthdate', $birthdate );

    //Bug fix: to allow  marketing_emails to only be set once to true
    if ( isset( $_POST['allow_marketing_emails'] ) ) {
      // If the user has enabled marketing emails, let's make sure that they have an active subscription, otherwise let's opt them out
      update_user_meta( $user_id, '_cp_marketing_opted_in', (isset($_POST['allow_marketing_emails'])) ? 1 : 0);
    }

    if ( isset($_POST['pet_information'])) {
        $pet_information = get_user_meta( $user_id, 'pet_information', true );
        if ( ($pet_information && count($pet_information) > 0) || count($_POST['pet_information']) > 0) {
            // Let's ensure that the keys reset from a zero count
            $_POST['pet_information'] = array_values( $_POST['pet_information'] );
            update_user_meta( $user_id, 'pet_information', $_POST['pet_information'] );
        }
    }

    cp_sync_active_campaign_data( $user_id );


}
add_action('woocommerce_save_account_details', 'cp_save_custom_my_account_fields');

/**
 * @param $errors WP_Error
 * @param $username
 * @param $email
 * @return mixed
 */
function cp_validate_custom_register_fields( $errors, $username, $email ) {

    if (!isset( $_POST['newformtest']) && (!isset( $_POST['first_name'] ) || empty( $_POST['first_name'] ))) {
        $errors->add( 'first_name_error', __( 'First name is required.', 'catspride' ) );
    }
    if (!isset( $_POST['newformtest']) && (!isset( $_POST['last_name'] ) || empty( $_POST['last_name'] ))) {
        $errors->add( 'last_name_error', __( 'Last name is required.', 'catspride' ) );
    }
    if ( !isset( $_POST['terms_conditions'] ) ) {
        $errors->add( 'terms_conditions_error', __( 'You must accept the terms and conditions to sign up.', 'catspride' ) );
    }

    /*
     * Shelter registration, coming from a 3rd party provider. Shelter does not yet exist in the system.
     */
    if ( isset( $_POST['new_shelter'] ) ) {

        if ( !isset( $_POST['shelter_name'] ) || empty( $_POST['shelter_name'] ) ) {
            $errors->add( 'shelter_name_error', 'Invalid shelter name provided.', 'error' );
        }

        if ( !isset( $_POST['shelter_address_1'] ) || empty( $_POST['shelter_address_1'] ) ) {
            $errors->add( 'shelter_address_1', 'Invalid shelter address provided.', 'error' );
        }

        if ( !isset( $_POST['shelter_ein'] ) || strlen(preg_replace('/[^0-9]/', '', $_POST['shelter_ein'] ) ) !== 9 ) {
            $errors->add( 'shelter_ein_error', 'Invalid shelter EIN provided.', 'error' );
        }

        if ( !isset( $_POST['shelter_city'] ) || empty( $_POST['shelter_city'] ) ) {
            $errors->add( 'shelter_city_error', 'Invalid shelter city provided.', 'error' );
        }

        if ( !isset( $_POST['shelter_state'] ) || empty( $_POST['shelter_state'] ) ) {
            $errors->add( 'shelter_state_error', 'Invalid shelter state provided.', 'error' );
        }

        if ( !isset( $_POST['shelter_zip_code'] ) || empty( $_POST['shelter_zip_code'] ) ) {
            $errors->add( 'shelter_zip_code_error', 'Invalid shelter zip code provided.', 'error' );
        }

        // Field is not required, but if it is present and not empty, validate that it is an email address
        if ( isset( $_POST['shelter_email'] ) && !empty( $_POST['shelter_email'] ) && !filter_var( $_POST['shelter_email'], FILTER_VALIDATE_EMAIL ) ) {
            $errors->add( 'shelter_email_error', 'Invalid shelter email provided.', 'error' );
        }

        if ( !isset( $_POST['reg_litter_for_good'] ) ) {
            $errors->add( 'reg_litter_for_good_error', __( 'You must agree to the Litter for Good program.', 'catspride' ) );
        }

        // Perform shelter duplication check. If the shelter appears to already exist, display an error message.
        $duplicate_shelter = cp_get_duplicate_shelters( $_POST );

        // We only want to display a duplicate if there is a published shelter found among the duplicate records.
        // There should only be drafts or publish status shelters among this group.
        if ( $duplicate_shelter['status'] === 'duplicates_found' ) {

            foreach( $duplicate_shelter['shelters'] as $shelter) {

                if ( $shelter->post_status === 'publish' ) {

                    $errors->add('shelter_duplicate_error', 'This shelter appears to already be registered with us. If you believe this is incorrect, please contact us at litterforgood@catspride.com.', 'error');
                    break;
                }

            }

        }

    }

    /*
     * Pre-entered shelter, coming from an invitation email.
     */
    if ( isset( $_POST['shelter_token'] ) ) {

        if ( cp_get_shelter_by_token( $_POST['shelter_token'] ) === false ) {
            $errors->add( 'shelter_token_error', __( 'Invalid shelter token provided. Please try clicking the link in your email again.', 'catspride' ) );
        }

        // Retrieve the shelter that is associated with the token provided
        $manage_shelter_id = cp_get_shelter_by_token( $_POST['shelter_token'] );

        if ( $manage_shelter_id === false ) {
            $errors->add( 'shelter_token_error', __( 'Invalid shelter token provided. Please try clicking the link in your email again.', 'catspride' ) );
        } else {
            // Ensure there is only one manager assigned to a shelter.
            $shelter_manager_id = cp_get_shelter_manager_id( $manage_shelter_id );

            if (  $shelter_manager_id !== false) {
                $errors->add( 'shelter_manager_error', __( 'This shelter is already assigned a manager.', 'catspride' ) );
            }
        }

    }

    /**
     * @var $logger CP_Logger
     */
    $logger = cp_get_logger();

    $logger->info(
        'Account registration validation ' . ( ( count( $errors->errors ) > 0 ) ? 'failed.' : 'was successful.' ),
        array( 'params' => $_POST, 'errors' => $errors ),
        ( ( isset( $_POST['shelter_token'] ) || isset( $_POST['new_shelter'] ) ) ? 'shelter_registration' : 'user_registration' )
    );

    return $errors;
}
add_filter( 'woocommerce_registration_errors', 'cp_validate_custom_register_fields', 10, 3 );

/**
 * If the user already has an account, but is trying to register as a shelter. We want a different error to display.
 *
 * @param $error_message
 * @param $email
 * @return mixed|string
 */
function cp_validate_registration_email_exists( $error_message, $email ) {

    // The user already has an account, but is trying to register as a shelter. We want a different error to display.
    if ( isset( $_POST['new_shelter'] ) ) {
        $error_message = __( 'This email address is already associated with a Cat\'s Pride Club account. Please use a new email address to register as a shelter, or contact Cat\'s Pride at 800-645-3741 for assistance.', 'catspride' );
    }

    return $error_message;

}
add_filter( 'woocommerce_registration_error_email_exists', 'cp_validate_registration_email_exists', 10, 2 );

/**
 * @param $customer_id
 */
function cp_save_custom_register_fields( $customer_id ) {

    if ( isset( $_POST['first_name'] ) ) {
        update_user_meta( $customer_id, 'first_name', sanitize_text_field( $_POST['first_name'] ) );
    }
    if ( isset( $_POST['last_name'] ) ) {
        update_user_meta( $customer_id, 'last_name', sanitize_text_field( $_POST['last_name'] ) );
    }

    if ( defined( 'REQUIRE_EMAIL_VERIFICATION_ON_REGISTER' ) && REQUIRE_EMAIL_VERIFICATION_ON_REGISTER === true ) {
        // Set a token that will be included in the verify email address email
        add_user_meta( $customer_id, '_cp_verify_email_token', md5( uniqid(null, true ) ), true );
    }

    if ( isset( $_POST['allow_marketing_emails'] ) ) {
        update_user_meta( $customer_id, '_cp_marketing_opted_in', 1 );
    }

    if ( isset( $_POST['reg_litter_for_good'] ) ) {
        update_user_meta( $customer_id, '_cp_accept_litter_for_good', 1 );
    }

    if( isset( $_POST['new_shelter'] ) ) {

        $meta = array(
            'name' => sanitize_text_field( trim( $_POST['first_name'] ) ) . ' ' . trim( sanitize_text_field( $_POST['last_name'] ) ),
            'address_1' => ucwords( strtolower( sanitize_text_field( trim( $_POST['shelter_address_1'] ) ) ) ),
            'address_2' => ucwords( strtolower( sanitize_text_field( trim( $_POST['shelter_address_2'] ) ) ) ),
            'city' => ucwords( strtolower( sanitize_text_field( trim( $_POST['shelter_city'] ) ) ) ),
            'state' => sanitize_text_field( trim( $_POST['shelter_state'] ) ),
            'zip_code' => sanitize_text_field( trim( $_POST['shelter_zip_code'] ) ),
            'website' => strtolower( sanitize_text_field( rtrim( trim( $_POST['shelter_website'] ), '/' ) ) ),
            // 'email' => strtolower( sanitize_text_field( trim( $_POST['shelter_email'] ) ) ),
            'phone' => sanitize_text_field( trim( $_POST['shelter_phone'] ) ),
            'ein' => sanitize_text_field( trim( $_POST['shelter_ein'] ) ),
            '_cp_new_shelter' => 1
        );

        $shelter_id = wp_insert_post( array (
            'post_title' => ucwords( strtolower( sanitize_text_field( trim( $_POST['shelter_name'] ) ) ) ),
            'post_type' => 'cp_shelter',
            'post_status' => 'publish',
            'meta_input' => $meta
        ) );

        /**
         * @var $logger CP_Logger
         */
        $logger = cp_get_logger();

        $logger->info(
            'Shelter registered successfully through direct registration form.',
            array( 'params' => $_POST, 'meta' => $meta ),
            'shelter_account',
            'cp_shelter',
            $shelter_id
        );

        // Force an update on the shelter being registered to lookup the lat/lon values
        cp_update_shelter_lat_lon( $shelter_id );

        // Instantiate the email classes so they are ready to send
        $mailer = WC()->mailer();
        $emails = $mailer->get_emails();

        if ( isset( $emails['CP_Litter_For_Good_Congratulations_Email'] ) ) {
            $emails['CP_Litter_For_Good_Congratulations_Email']->recipient = strtolower( sanitize_text_field( trim( $_POST['email'] ) ) );
            $emails['CP_Litter_For_Good_Congratulations_Email']->trigger( $shelter_id );
        }

    } else if ( isset( $_POST['shelter_token'] ) ) {

        /*
         * Add the shelter that this user is allowed to manage, if a shelter_token was passed in the request
         */
        $shelter_id = cp_get_shelter_by_token( $_POST['shelter_token'] );

        if ( $shelter_id ) {

            // Now that the shelter has been claimed, let's publish it so it can now be nominated by others.
            wp_update_post(array(
                'ID' => $shelter_id,
                'post_status' => 'publish'
            ));

            /**
             * @var $logger CP_Logger
             */
            $logger = cp_get_logger();

            $logger->info(
                'Shelter claimed successfully via shelter token registration.',
                array( 'params' => $_POST ),
                'shelter_account',
                'cp_shelter',
                $shelter_id
            );

        }

    }

    if ( isset( $shelter_id ) && $shelter_id ) {

        $user = get_user_by( 'ID', $customer_id );

        if ( $user ) {

            // Assign them as manager to a specific shelter
            cp_set_user_as_shelter_manager( $customer_id, $shelter_id );

        }

    }

    if ( !defined( 'REQUIRE_EMAIL_VERIFICATION_ON_REGISTER' ) || REQUIRE_EMAIL_VERIFICATION_ON_REGISTER === false ) {

        // They won't be going through the verification process, let's get them added in to Active Campaign now.
        cp_add_user_to_active_campaign( $customer_id );

    }

    // Set the display name to be the first/last name.
    wp_update_user( array( 'ID' => $customer_id, 'display_name' => sanitize_text_field( $_POST['first_name'] . ' ' . $_POST['last_name'] ) ) );

}
add_action( 'woocommerce_created_customer', 'cp_save_custom_register_fields' );


/*
 * We don't want to require the display name
 */
function cp_save_account_details_required_fields( $required_fields ){
    unset( $required_fields['account_display_name'] );
    return $required_fields;
}

add_filter('woocommerce_save_account_details_required_fields', 'cp_save_account_details_required_fields' );


/**
 * If the verification email is not enabled, we want to ensure that we re-direct shelter managers to their shelter
 * resource page, rather than just sending them to the standard dashboard.
 *
 * @param $redirect
 * @return string
 */
function cp_redirect_after_registration( $redirect ) {

    if ( is_user_logged_in() ) {
        $user = wp_get_current_user();

        if ( isset( $user->roles ) && is_array( $user->roles ) ) {
            // Re-direct them to the shelter resources page if they are a shelter manager and are assigned a shelter
            if ( in_array( 'shelter_manager', $user->roles )
                && get_user_meta( $user->ID, '_cp_manage_shelter_id', true ) !== '' ) {
                $redirect = wc_get_page_permalink('myaccount' ) . wc_get_endpoint_url('shelter-resources' );
            }
        }
    }

    return $redirect;
}

/**
 * After registration, add params to the redirect to display the notice to verify email and show the login tab
 *
 * @param $redirect
 * @return string
 */
function cp_add_notice_message_after_registration( $redirect )
{
    // Let's ensure that any tokens are cleared out
    $redirect = remove_query_arg( array( 'cp_st', 'cp_et', 'cp_sr' ), $redirect);

    return add_query_arg( array(
       'cp_verify_sent' => '1',
       'tab' => 'login'
    ), $redirect );
}
if ( defined( 'REQUIRE_EMAIL_VERIFICATION_ON_REGISTER' ) && REQUIRE_EMAIL_VERIFICATION_ON_REGISTER === true ) {
    add_filter( 'woocommerce_registration_redirect', 'cp_add_notice_message_after_registration' );
} else {
    add_filter( 'woocommerce_registration_redirect', 'cp_redirect_after_registration' );
}

/**
 * Set the user's username to be their email address during registration
 */
add_filter( 'woocommerce_new_customer_data', function( $data ) {
    $data['user_login'] = $data['user_email'];
    return $data;
} );

/**
 *
 * After a user signs up for a new account, we don't want to automatically log them in. They must confirm
 * their email address before we allow them access to the account area.
 *
 * @param $auth bool
 * @param $user
 * @return bool
 */
function cp_disable_auth_after_registration( $auth )
{
    return false;
}
if ( defined( 'REQUIRE_EMAIL_VERIFICATION_ON_REGISTER' ) && REQUIRE_EMAIL_VERIFICATION_ON_REGISTER === true ) {
    add_filter( 'woocommerce_registration_auth_new_customer', 'cp_disable_auth_after_registration' );
}

/**
 * If the user has the token set in their URL, we will attempt to validate it and enable their account.
 */
function cp_verify_user_account_from_token( )
{
    if ( isset( $_GET['cp_et'] ) && !empty( $_GET['cp_et'] ) ) {

        $user_id = reset(get_users(
            array(
                'meta_key' => '_cp_verify_email_token',
                'meta_value' => $_GET['cp_et'],
                'number' => 1,
                'count_total' => false,
                'fields' => 'ids'
            ))
        );

        if (  $user_id ) {

            // Delete the meta key, their account is now confirmed.
            delete_user_meta( $user_id, '_cp_verify_email_token' );

            // Add a message for display
            wc_add_notice( __( 'Your account has been verified. Please login to manage your profile!', 'catspride'), 'success' );

            // Add user into Active Campaign now that they are verified
            cp_add_user_to_active_campaign( $user_id );

        } else {

            // Add a message for display
            wc_add_notice( __( 'We were unable to confirm your account. Please try again or contact support for assistance.', 'catspride'), 'error' );

        }

    }

}
if ( defined( 'REQUIRE_EMAIL_VERIFICATION_ON_REGISTER' ) && REQUIRE_EMAIL_VERIFICATION_ON_REGISTER === true ) {
    add_action( 'init', 'cp_verify_user_account_from_token' );
}

/**
 * Confirm that the shelter's opt-out token is valid and trash the shelter post. Log the user out and display a message.
 */
function cp_confirm_shelter_optout_from_token()
{
    if ( isset( $_GET['cp_ot'] ) && !empty( $_GET['cp_ot'] ) ) {

        $shelter_id = cp_get_shelter_by_token( $_GET['cp_ot'] );

        if (  $shelter_id !== false ) {

            $user_id = cp_get_shelter_manager_id( $shelter_id );

            // Change the shelter manager role to a customer role
            if (  $user_id ) {
                wp_update_user( array( 'ID' => $user_id, 'role' => 'customer' ) );
            }

            // Move the shelter to the trash
            wp_trash_post( $shelter_id );

            // Add a message for display
            wc_add_notice( __( 'Your shelter has been opted-out of the Litter for Good program.', 'catspride'), 'error' );

        } else {

            // Add a message for display
            wc_add_notice( __( 'We were unable to opt-out your shelter. Please try again or contact support for assistance.', 'catspride'), 'error' );

        }

    }
}
add_action( 'init', 'cp_confirm_shelter_optout_from_token' );

/**
 * Before we allow the user to login, we need to ensure that they no longer have a meta entry
 * for _cp_verify_email_token.
 *
 * @param $user
 * @param $username
 * @param $password
 * @return null|WP_Error
 */
function cp_login_check_has_user_been_verified( $user, $username, $password ){

    $user = get_user_by('login', $username );
    $verification_token = null;

    // Get _cp_verify_email_token
    $verification_token = get_user_meta( $user->ID, '_cp_verify_email_token', true );

    if (!$user || !empty( $verification_token ) ) {

        remove_action('authenticate', 'wp_authenticate_username_password', 20);
        remove_action('authenticate', 'wp_authenticate_email_password', 20);

        // Create an error to return to user
        return new WP_Error( 'denied', __("<strong>Your account has not been verified.</strong> Please check your email and click the verification link to activate your account.") );
    }

    // Everything looks good, allow auth to continue
    return null;

}

if ( defined( 'REQUIRE_EMAIL_VERIFICATION_ON_REGISTER' ) && REQUIRE_EMAIL_VERIFICATION_ON_REGISTER === true ) {
    add_filter( 'authenticate', 'cp_login_check_has_user_been_verified', 10, 3 );
}
