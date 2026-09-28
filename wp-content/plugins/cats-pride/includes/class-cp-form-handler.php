<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Handle frontend forms.
 */
class CP_Form_Handler {

    /**
     * Hook in methods.
     */
    public static function init() {

        add_action( 'wp_loaded', array( __CLASS__, 'process_choose_shelter' ), 20 );
        add_action( 'wp_loaded', array( __CLASS__, 'process_nominate_shelter' ), 20 );
        add_action( 'wp_loaded', array( __CLASS__, 'process_edit_shelter' ), 20 );
        add_action( 'wp_loaded', array( __CLASS__, 'process_edit_shelter_page' ), 20 );
        add_action( 'wp_loaded', array( __CLASS__, 'process_store_locator' ), 20 );
        add_action( 'wp_loaded', array( __CLASS__, 'process_optout_shelter' ), 20 );
        add_action( 'wp_loaded', array( __CLASS__, 'process_marketing_opt_in' ), 20 );
        add_action( 'wp_loaded', array( __CLASS__, 'process_friend_share' ), 20 );
        add_action( 'wp_loaded', array( __CLASS__, 'process_transfer_shelter' ), 20 );
        add_action( 'wp_loaded', array( __CLASS__, 'process_transfer_shelter_response' ), 20 );
        add_action( 'wp_loaded', array( __CLASS__, 'process_transfer_shelter_cancel' ), 20 );
        add_action( 'wp_loaded', array( __CLASS__, 'process_shelter_bonus_code' ), 20 );

        /**
         * Overriding WooCommerce Lost Password and Reset Password form processors
         */
        add_action( 'wp_loaded', array( __CLASS__, 'process_lost_password' ), 10 );
        add_action( 'woocommerce_loaded', array( __CLASS__, 'remove_process_hooks' ), 20 );

    }

    /**
     * Remove WooCommerce Lost Password form processor as we are now handling them within this class
     */
    public static function remove_process_hooks() {

        remove_action('wp_loaded', array( 'WC_Form_Handler', 'process_lost_password' ), 20 );

    }

    /**
     * Process the marketing communications opt-in form
     */
    public static function process_marketing_opt_in() {

        if ( 'POST' !== strtoupper( $_SERVER['REQUEST_METHOD'] ) ) {
            return;
        }

        if ( empty( $_POST['action'] ) || 'marketing_opt_in' !== $_POST['action'] || empty( $_POST['_wpnonce'] ) || ! wp_verify_nonce( $_POST['_wpnonce'], 'catspride-marketing_opt_in' ) ) {
            return;
        }

        if ( !isset( $_POST['email'] ) || empty( $_POST['email'] ) ) {
            wc_add_notice( 'Invalid email address.', 'error' );
            return;
        }

        if ( is_user_logged_in() ) {
            $user = wp_get_current_user();
            update_user_meta( $user->ID, '_cp_marketing_opted_in', 1 );
        }

        cp_sync_active_campaign_contact(null, [
            'email' => $_POST['email'],
            'field' => ['%OPTEDIN%,0' => 1]
        ]);

        wc_add_notice( __( 'Your communication preferences have been updated successfully.', 'catspride' ), 'success' );

    }

    /**
     * Process the shelter transfer cancellation
     */
    public static function process_transfer_shelter_cancel()
    {
        if ( 'POST' !== strtoupper( $_SERVER['REQUEST_METHOD'] ) ) {
            return;
        }

        if ( empty( $_POST['action'] ) || 'transfer_shelter_cancel' !== $_POST['action'] || empty( $_POST['_wpnonce_transfer_shelter_cancel'] ) || ! wp_verify_nonce( $_POST['_wpnonce_transfer_shelter_cancel'], 'catspride-transfer_shelter_cancel' ) ) {
            return;
        }

        $user_id = get_current_user_id();

        if ( $user_id ) {

            $transfer_to_user_id = get_user_meta( $user_id, '_cp_transfer_shelter_to_user_id', true);

            if ( !empty( $transfer_to_user_id ) ) {

                $transfer_request    = cp_get_shelter_transfer_request_to_user_by_id( $transfer_to_user_id );

                delete_user_meta( $user_id, '_cp_transfer_shelter_to_user_id' );
                delete_user_meta( $user_id, '_cp_transfer_shelter_date' );

                $logger = cp_get_logger();

                $logger->info('Transfer shelter manager request for "' . $transfer_request['shelter']->post_title . '"  to ' . $transfer_request['transfer_to_user']->user_email . ' was canceled.', [
                    'shelter_post_id' => $transfer_request['shelter']->ID,
                    'transfer_to_user_id' => $transfer_request['transfer_to_user_id']
                ], 'user_account', 'user', $user_id );

                $logger->info('Transfer shelter manager request for "' . $transfer_request['shelter']->post_title . '"  from ' . $transfer_request['transfer_from_user']->user_email . ' was canceled.', [
                    'shelter_post_id' => $transfer_request['shelter']->ID,
                    'transfer_from_user_id' => $transfer_request['transfer_from_user_id']
                ], 'user_account', 'user', $transfer_request['transfer_from_user_id'] );

                $logger->info('Transfer shelter manager for  request was canceled.', [
                    'transfer_to_user_id' => $transfer_request['transfer_to_user_id']
                ], 'shelter_account', 'cp_shelter', $transfer_request['shelter']->ID );

                wc_add_notice( __( 'Your shelter transfer request was canceled successfully.', 'catspride' ), 'success' );

            } else {

                wc_add_notice(__('We were not able to find a shelter transfer request.', 'catspride'), 'error');

            }

        }

    }

    /**
     * Process the shelter transfer form on the edit shelter page
     */
    public static function process_transfer_shelter()
    {

        if ( 'POST' !== strtoupper( $_SERVER['REQUEST_METHOD'] ) ) {
            return;
        }

        if ( empty( $_POST['action'] ) || 'transfer_shelter' !== $_POST['action'] || empty( $_POST['_wpnonce_transfer_shelter'] ) || ! wp_verify_nonce( $_POST['_wpnonce_transfer_shelter'], 'catspride-transfer_shelter' ) ) {
            return;
        }

        $user_id    = get_current_user_id();
        $user       = get_user_by( 'ID', $user_id);
        $shelter_id = cp_get_shelter_by_manager_id( $user_id );

        // Ensure that the user is assigned as a shelter manager
        if ( $shelter_id === false ) {
            wc_add_notice( 'You are not currently managing a shelter.', 'error' );
            return;
        }

        if ( !isset( $_POST['shelter_transfer_email'] ) || empty( $_POST['shelter_transfer_email'] ) ) {
            wc_add_notice( 'Please provide a valid email address for the member.', 'error' );
            return;
        }

        // Check to see if there is a user with that email address currently
        $transfer_to_user = get_user_by( 'email', sanitize_text_field( $_POST['shelter_transfer_email'] ) );

        if ( $transfer_to_user === false ) {
            wc_add_notice( 'We were unable to find a member with that email address.', 'error' );
            return;
        }

        // Check to see if the user already has an outstanding request to take over as owner for a shelter
        $has_request = cp_get_shelter_transfer_request_to_user_by_id( $transfer_to_user->ID );

        if ( $has_request !== false ) {
            wc_add_notice( 'This member currently has another shelter transfer request pending.', 'error' );
            return;
        }

        // Check to see if they user is already managing another shelter
        $shelter = cp_get_shelter_by_manager_id( $transfer_to_user->ID );

        if ( $shelter !== false ) {
            wc_add_notice( 'This member is already managing a shelter.', 'error' );
            return;
        }

        // Save the request and send an email notification
        update_user_meta( $user_id, '_cp_transfer_shelter_to_user_id', $transfer_to_user->ID );
        update_user_meta( $user_id, '_cp_transfer_shelter_date', date( 'Y-m-d' ) );

        // Instantiate the email classes so they are ready to send
        $mailer = WC()->mailer();
        $emails = $mailer->get_emails();

        if ( isset( $emails['CP_Transfer_Shelter_Request_Email'] ) ) {
            $emails['CP_Transfer_Shelter_Request_Email']->transfer_from_user = $user;
            $emails['CP_Transfer_Shelter_Request_Email']->transfer_to_user   = $transfer_to_user;
            $emails['CP_Transfer_Shelter_Request_Email']->shelter            = cp_get_shelter_by_id( $shelter_id );
            $emails['CP_Transfer_Shelter_Request_Email']->trigger();
        }

        $logger = cp_get_logger();

        $logger->info('Shelter manager transfer request submitted to ' . $transfer_to_user->user_email . ' from the current shelter manager, ' . $user->user_email . '.', [
            'transfer_from_user_id' => $user->ID,
            'transfer_to_user_id'   => $transfer_to_user->ID,
        ], 'shelter_account', 'cp_shelter', $shelter_id );

        wc_add_notice( 'We have notified the member of your request to transfer.', 'success' );

        wp_redirect( wc_get_page_permalink( 'myaccount' ) . '/shelter-resources/' );
        exit;

    }

    /**
     * Process the shelter transfer response from the
     */
    public static function process_transfer_shelter_response()
    {
        if ( 'POST' !== strtoupper( $_SERVER['REQUEST_METHOD'] ) ) {
            return;
        }

        if ( empty( $_POST['action'] ) || 'transfer_shelter_response' !== $_POST['action'] || empty( $_POST['_wpnonce'] ) || ! wp_verify_nonce( $_POST['_wpnonce'], 'catspride-transfer_shelter_response' ) ) {
            return;
        }

        if ( !isset( $_POST['button_action'] ) || !in_array( $_POST['button_action'], [ 'transfer_shelter_accept', 'transfer_shelter_decline' ] ) ) {
            return;
        }

        if ( isset( $_POST['transfer_shelter_accept'] ) && !isset( $_POST['terms_conditions'] ) ) {
            wc_add_notice( 'You must accept the terms and conditions to continue.', 'error' );
            return;
        }

        $status     = ( $_POST['button_action'] === 'transfer_shelter_accept' ) ? 'accepted' : 'declined';
        $user_id    = get_current_user_id();
        $transfer_request = cp_get_shelter_transfer_request_to_user_by_id( $user_id );

        if ( $transfer_request === false ) {
            wc_add_notice( 'We do not currently have a shelter transfer request available for you to accept. The request may have been canceled.', 'error' );
            return;
        }

        $logger = cp_get_logger();

        $logger->info('Transfer shelter request for shelter "' . $transfer_request['shelter']->post_title . '" was ' . $status . ' by ' . $transfer_request['transfer_to_user']->user_email . '.', [
            'transfer_from_user_id' => $transfer_request['transfer_from_user']->ID,
            'transfer_to_user_id' => $transfer_request['transfer_to_user']->ID,
            'shelter_post_id' => $transfer_request['shelter']->ID
        ], 'user_account', 'user', $transfer_request['transfer_from_user']->ID);

        $logger->info('Transfer shelter request from ' . $transfer_request['transfer_from_user']->user_email  . ' for shelter "' . $transfer_request['shelter']->post_title . '" was ' . $status . '.', [
            'transfer_from_user_id' => $transfer_request['transfer_from_user']->ID,
            'transfer_to_user_id' => $transfer_request['transfer_to_user']->ID,
            'shelter_post_id' => $transfer_request['shelter']->ID
        ], 'user_account', 'user', $transfer_request['transfer_to_user']->ID);

        if ( $status === 'accepted' ) {

            // Remove the older shelter manager
            cp_remove_user_as_shelter_manager( $transfer_request['transfer_from_user']->ID );

            // Re-assign shelter to the new manager, set them as a shelter manager, etc.
            cp_set_user_as_shelter_manager( $user_id, $transfer_request['shelter']->ID );

            // If the user has enabled marketing emails, let's make sure that they have an active subscription, otherwise let's opt them out
            update_user_meta( $user_id, '_cp_marketing_opted_in', (isset( $_POST['allow_marketing_emails'] )) ? 1 : 0 );

            // Insert the user into Active Campaign, if they accepted marketing emails they will also be opted-in
            cp_add_user_to_active_campaign( $user_id );

            // We will update their Active Campaign account to include a member tag if it does not currently, and not pass it as a shelter.
            cp_add_user_to_active_campaign( $transfer_request['transfer_from_user']->ID );

            // If the prior manager had a Shelter tag associated with their account, we will now remove it.
            cp_remove_tag_from_active_campaign_contact( $transfer_request['transfer_from_user']->ID, 'Shelter' );

            $logger->info('Shelter manager role successfully transferred from ' . $transfer_request['transfer_from_user']->user_email . ' to ' . $transfer_request['transfer_to_user']->user_email . '.', [
                'transfer_from_user_id' => $transfer_request['transfer_from_user']->ID,
                'transfer_to_user_id'   => $transfer_request['transfer_to_user']->ID,
            ], 'shelter_account', 'cp_shelter', $transfer_request['shelter']->ID );

        }

        // Save the request and send an email notification
        delete_user_meta( $transfer_request['transfer_from_user']->ID, '_cp_transfer_shelter_to_user_id' );
        delete_user_meta( $transfer_request['transfer_from_user']->ID, '_cp_transfer_shelter_date' );

        // Instantiate the email classes so they are ready to send
        $mailer = WC()->mailer();
        $emails = $mailer->get_emails();

        if ( isset( $emails['CP_Transfer_Shelter_Status_Update_Email'] ) ) {
            $emails['CP_Transfer_Shelter_Status_Update_Email']->transfer_from_user = $transfer_request['transfer_from_user'];
            $emails['CP_Transfer_Shelter_Status_Update_Email']->transfer_to_user   = $transfer_request['transfer_to_user'];
            $emails['CP_Transfer_Shelter_Status_Update_Email']->status             = $status;
            $emails['CP_Transfer_Shelter_Status_Update_Email']->shelter            = $transfer_request['shelter'];
            $emails['CP_Transfer_Shelter_Status_Update_Email']->trigger();
        }

        wc_add_notice( 'Shelter transfer request has been ' . $status . '.', 'success' );

        if ( $status === 'accepted' ) {
            wp_redirect( wc_get_page_permalink( 'myaccount' ) . '/shelter-resources/' );
            exit;
        }

    }

    /**
     * Process the edit shelter form
     */
    public static function process_edit_shelter() {

        if ( 'POST' !== strtoupper( $_SERVER['REQUEST_METHOD'] ) ) {
            return;
        }

        if ( empty( $_POST['action'] ) || 'edit_shelter' !== $_POST['action'] || empty( $_POST['_wpnonce'] ) || ! wp_verify_nonce( $_POST['_wpnonce'], 'catspride-edit_shelter' ) ) {
            return;
        }

        $user_id            = get_current_user_id();
        $user               = get_user_by( 'ID', $user_id );
        $manage_shelter_id  = get_user_meta( $user_id, '_cp_manage_shelter_id', true );
        $pass_cur           = ! empty( $_POST['password_current'] ) ? $_POST['password_current'] : '';
        $pass1              = ! empty( $_POST['password_1'] ) ? $_POST['password_1'] : '';
        $pass2              = ! empty( $_POST['password_2'] ) ? $_POST['password_2'] : '';
        $save_pass          = true;

        if ( !isset( $_POST['shelter_name'] ) || empty( $_POST['shelter_name'] ) ) {
            wc_add_notice( 'Invalid shelter name.', 'error' );
        }

        if ( !isset( $_POST['shelter_ein'] ) || empty( $_POST['shelter_ein'] ) ) {
            wc_add_notice( 'Invalid shelter EIN.', 'error' );
        }

        if ( !isset( $_POST['shelter_address_1'] ) || empty( $_POST['shelter_address_1'] ) ) {
            wc_add_notice( 'Invalid shelter address 1.', 'error' );
        }

        if ( !isset( $_POST['shelter_city'] ) || empty( $_POST['shelter_city'] ) ) {
            wc_add_notice( 'Invalid shelter city.', 'error' );
        }

        if ( !isset( $_POST['shelter_state'] ) || empty( $_POST['shelter_state'] ) ) {
            wc_add_notice( 'Invalid shelter state.', 'error' );
        }

        if ( !isset( $_POST['shelter_zip_code'] ) || empty( $_POST['shelter_zip_code'] ) ) {
            wc_add_notice( 'Invalid shelter zip code.', 'error' );
        }

        if ( !isset( $_POST['shelter_phone'] ) || empty( $_POST['shelter_phone'] ) ) {
            wc_add_notice( 'Invalid shelter phone.', 'error' );
        }

        if ( ! empty( $pass_cur ) && empty( $pass1 ) && empty( $pass2 ) ) {
            wc_add_notice( __( 'Please fill out all password fields.', 'woocommerce' ), 'error' );
            $save_pass = false;
        } elseif ( ! empty( $pass1 ) && empty( $pass_cur ) ) {
            wc_add_notice( __( 'Please enter your current password.', 'woocommerce' ), 'error' );
            $save_pass = false;
        } elseif ( ! empty( $pass1 ) && empty( $pass2 ) ) {
            wc_add_notice( __( 'Please re-enter your password.', 'woocommerce' ), 'error' );
            $save_pass = false;
        } elseif ( ( ! empty( $pass1 ) || ! empty( $pass2 ) ) && $pass1 !== $pass2 ) {
            wc_add_notice( __( 'New passwords do not match.', 'woocommerce' ), 'error' );
            $save_pass = false;
        } elseif ( ! empty( $pass1 ) && ! wp_check_password( $pass_cur, $user->user_pass, $user_id ) ) {
            wc_add_notice( __( 'Your current password is incorrect.', 'woocommerce' ), 'error' );
            $save_pass = false;
        }

        if ( isset( $_POST['shelter_donation_shipping_address_1'] ) && empty( $_POST['shelter_donation_shipping_address_1'] ) ) {
            wc_add_notice( __( 'Invalid shelter donation shipping address 1.', 'catspride' ), 'error' );
        }
        if ( isset( $_POST['shelter_donation_shipping_city'] ) && empty( $_POST['shelter_donation_shipping_city'] ) ) {
            wc_add_notice( __( 'Invalid shelter donation shipping city.', 'catspride' ), 'error' );
        }
        if ( isset( $_POST['shelter_donation_shipping_state'] ) && empty( $_POST['shelter_donation_shipping_state'] ) ) {
            wc_add_notice( __( 'Invalid shelter donation shipping state.', 'catspride' ), 'error' );
        }
        if ( isset( $_POST['shelter_donation_shipping_zip_code'] ) && empty( $_POST['shelter_donation_shipping_zip_code'] ) ) {
            wc_add_notice( __( 'Invalid shelter donation shipping zip code.', 'catspride' ), 'error' );
        }
        if ( isset( $_POST['shelter_donation_shipping_name'] ) && empty( $_POST['shelter_donation_shipping_name'] ) ) {
            wc_add_notice( __( 'Invalid shelter donation shipping contact name.', 'catspride' ), 'error' );
        }
        if ( isset( $_POST['shelter_donation_shipping_phone'] ) && empty( $_POST['shelter_donation_shipping_phone'] ) ) {
            wc_add_notice( __( 'Invalid shelter donation shipping phone.', 'catspride' ), 'error' );
        }
        if ( isset( $_POST['shelter_donation_shipping_email'] ) && empty( $_POST['shelter_donation_shipping_email'] ) ) {
            wc_add_notice( __( 'Invalid shelter donation shipping email.', 'catspride' ), 'error' );
        }
        if ( isset( $_POST['shelter_donation_pickup_from_warehouse'] ) && !in_array( $_POST['shelter_donation_pickup_from_warehouse'], [0, 1] ) ) {
            wc_add_notice( __( 'You must choose if you will be picking up the donation or needing it delivered.', 'catspride' ), 'error' );
        }
        if ( isset( $_POST['shelter_donation_pickup_location'] ) && $_POST['shelter_donation_pickup_from_warehouse'] == '1' && empty( $_POST['shelter_donation_pickup_location'] ) ) {
            wc_add_notice( __( 'You must choose if you will be picking up the donation or needing it delivered.', 'catspride' ), 'error' );
        }
        if ( isset( $_POST['shelter_donation_provide_freight_quote'] ) && $_POST['shelter_donation_pickup_from_warehouse'] == '0' && !in_array( $_POST['shelter_donation_provide_freight_quote'], [0, 1] ) ) {
            wc_add_notice( __( 'You must choose if you want us to provide you a freight quote.', 'catspride' ), 'error' );
        }
        if ( isset( $_POST['shelter_donation_has_loading_dock'] ) && $_POST['shelter_donation_provide_freight_quote'] == '1' && !in_array( $_POST['shelter_donation_has_loading_dock'], [0, 1] ) ) {
            wc_add_notice( __( 'You must tell us if you have a loading dock.', 'catspride' ), 'error' );
        }
        if ( isset( $_POST['shelter_donation_has_forklift'] ) && $_POST['shelter_donation_provide_freight_quote'] == '1' && !in_array( $_POST['shelter_donation_has_forklift'], [0, 1] ) ) {
            wc_add_notice( __( 'You must tell us if you have a forklift or pallet jack.', 'catspride' ), 'error' );
        }
        if ( isset( $_POST['shelter_donation_delivery_time'] ) && $_POST['shelter_donation_provide_freight_quote'] == '1' && !in_array( $_POST['shelter_donation_delivery_time'], ['appointment', 'business_hours'] ) ) {
            wc_add_notice( __( 'You must tell us if you need the delivery by appointment or anytime during business hours.', 'catspride' ), 'error' );
        }
        if ( isset( $_POST['shelter_donation_residential_delivery'] ) && $_POST['shelter_donation_provide_freight_quote'] == '1' && !in_array( $_POST['shelter_donation_residential_delivery'], [0, 1] ) ) {
            wc_add_notice( __( 'You must tell us if this is a residential or commercial delivery.', 'catspride' ), 'error' );
        }
        if ( isset( $_POST['shelter_donation_confirmation'] ) && !isset( $_POST['shelter_donation_confirmation'] ) ) {
            wc_add_notice( __( 'You must confirm that the donation shipping details are accurate by checking the confirmation box.', 'catspride' ), 'error' );
        }

        // If we have errors, let's return before we save anything
        if (wc_notice_count( 'error' ) > 0) {
            return;
        }

        if ( $pass1 && $save_pass ) {
            if ( $user ) {
                $user->user_pass = $pass1;
                wp_update_user( $user );
            }
        }

        // Update the shelter name
        wp_update_post( array( 'ID' => $manage_shelter_id, 'post_title' => sanitize_text_field( $_POST['shelter_name'] ) ) );

        // Update other details for the shelter
        update_field( 'ein', sanitize_text_field( $_POST['shelter_ein'] ), $manage_shelter_id );
        update_field( 'address_1', sanitize_text_field( $_POST['shelter_address_1'] ), $manage_shelter_id );
        update_field( 'address_2', sanitize_text_field( $_POST['shelter_address_2'] ), $manage_shelter_id );
        update_field( 'city', sanitize_text_field( $_POST['shelter_city'] ), $manage_shelter_id );
        update_field( 'state', sanitize_text_field( $_POST['shelter_state'] ), $manage_shelter_id );
        update_field( 'zip_code', sanitize_text_field( $_POST['shelter_zip_code'] ), $manage_shelter_id );
        update_field( 'phone', sanitize_text_field( $_POST['shelter_phone'] ), $manage_shelter_id );
        update_field( 'contact', sanitize_text_field( $_POST['shelter_contact'] ), $manage_shelter_id );
        update_field( 'website', sanitize_text_field( $_POST['shelter_website'] ), $manage_shelter_id );
        update_field( 'facebook', sanitize_text_field( $_POST['shelter_facebook'] ), $manage_shelter_id );
        update_field( 'instagram', sanitize_text_field( $_POST['shelter_instagram'] ), $manage_shelter_id );
        update_field( 'twitter', sanitize_text_field( $_POST['shelter_twitter'] ), $manage_shelter_id );

        /*
         * Handle the saving of the donation shipping information. We won't always have these fields coming in, so we
         * need to ensure they are set in the $_POST and not allow certain fields to be saved if they are empty.
         */
        if ( isset( $_POST['shelter_donation_shipping_address_1'] ) && !empty( $_POST['shelter_donation_shipping_address_1'] ) ) {
            update_field('donation_shipping_address_1', sanitize_text_field($_POST['shelter_donation_shipping_address_1']), $manage_shelter_id);
        }
        if ( isset( $_POST['shelter_donation_shipping_address_2'] ) && !empty( $_POST['shelter_donation_shipping_address_2'] ) ) {
            update_field('donation_shipping_address_2', sanitize_text_field($_POST['shelter_donation_shipping_address_2']), $manage_shelter_id);
        } else if ( isset( $_POST['donation_shipping_confirmation'] ) ) {
            update_field( 'donation_shipping_address_2', null, $manage_shelter_id );
        }
        if ( isset( $_POST['shelter_donation_shipping_city'] ) && !empty( $_POST['shelter_donation_shipping_city'] ) ) {
            update_field( 'donation_shipping_city', sanitize_text_field( $_POST['shelter_donation_shipping_city'] ), $manage_shelter_id );
        }
        if ( isset( $_POST['shelter_donation_shipping_state'] ) && !empty( $_POST['shelter_donation_shipping_state'] ) ) {
            update_field( 'donation_shipping_state', sanitize_text_field( $_POST['shelter_donation_shipping_state'] ), $manage_shelter_id );
        }
        if ( isset( $_POST['shelter_donation_shipping_zip_code'] ) && !empty( $_POST['shelter_donation_shipping_zip_code'] ) ) {
            update_field( 'donation_shipping_zip_code', sanitize_text_field( $_POST['shelter_donation_shipping_zip_code'] ), $manage_shelter_id );
        }
        if ( isset( $_POST['shelter_donation_shipping_name'] ) ) {
            update_field( 'donation_shipping_name', sanitize_text_field( $_POST['shelter_donation_shipping_name'] ), $manage_shelter_id );
        }
        if ( isset( $_POST['shelter_donation_shipping_phone'] ) && !empty( $_POST['shelter_donation_shipping_phone'] ) ) {
            update_field( 'donation_shipping_phone', sanitize_text_field( $_POST['shelter_donation_shipping_phone'] ), $manage_shelter_id );
        }
        if ( isset( $_POST['shelter_donation_shipping_email'] ) && !empty( $_POST['shelter_donation_shipping_email'] ) ) {
            update_field( 'donation_shipping_email', sanitize_text_field( $_POST['shelter_donation_shipping_email'] ), $manage_shelter_id );
        }
        if ( isset( $_POST['shelter_donation_pickup_from_warehouse'] ) ) {
            update_field( 'donation_pickup_from_warehouse', sanitize_text_field( $_POST['shelter_donation_pickup_from_warehouse'] ), $manage_shelter_id );
        }
        if ( isset( $_POST['shelter_donation_pickup_location'] ) && !empty( $_POST['shelter_donation_pickup_location'] ) ) {
            update_field( 'donation_pickup_location', sanitize_text_field( $_POST['shelter_donation_pickup_location'] ), $manage_shelter_id );
        } else if ( isset( $_POST['donation_shipping_confirmation'] ) ) {
            update_field( 'donation_pickup_location', null, $manage_shelter_id );
        }
        if ( isset( $_POST['shelter_donation_provide_freight_quote'] ) ) {
            update_field( 'donation_provide_freight_quote', sanitize_text_field( $_POST['shelter_donation_provide_freight_quote'] ), $manage_shelter_id );
        } else if ( isset( $_POST['donation_shipping_confirmation'] ) ) {
            update_field( 'donation_provide_freight_quote', null, $manage_shelter_id );
        }
        if ( isset( $_POST['shelter_donation_has_loading_dock'] ) ) {
            update_field( 'donation_has_loading_dock', sanitize_text_field( $_POST['shelter_donation_has_loading_dock'] ), $manage_shelter_id );
        } else if ( isset( $_POST['donation_shipping_confirmation'] ) ) {
            update_field( 'donation_has_loading_dock', null, $manage_shelter_id );
        }
        if ( isset( $_POST['shelter_donation_has_forklift'] ) ) {
            update_field( 'donation_has_forklift', sanitize_text_field( $_POST['shelter_donation_has_forklift'] ), $manage_shelter_id );
        } else if ( isset( $_POST['donation_shipping_confirmation'] ) ) {
            update_field( 'donation_has_forklift', null, $manage_shelter_id );
        }
        if ( isset( $_POST['shelter_donation_delivery_time'] ) && !empty( $_POST['shelter_donation_delivery_time'] ) ) {
            update_field( 'donation_delivery_time', sanitize_text_field( $_POST['shelter_donation_delivery_time'] ), $manage_shelter_id );
        } else if ( isset( $_POST['donation_shipping_confirmation'] ) ) {
            update_field( 'donation_delivery_time', null, $manage_shelter_id );
        }
        if ( isset( $_POST['shelter_donation_business_hours'] ) && !empty( $_POST['shelter_donation_business_hours'] ) ) {
            update_field( 'donation_business_hours', sanitize_text_field( $_POST['shelter_donation_business_hours'] ), $manage_shelter_id );
        } else if ( isset( $_POST['donation_shipping_confirmation'] ) ) {
            update_field( 'donation_business_hours', null, $manage_shelter_id );
        }
        if ( isset( $_POST['shelter_donation_residential_delivery'] ) ) {
            update_field( 'donation_residential_delivery', sanitize_text_field( $_POST['shelter_donation_residential_delivery'] ), $manage_shelter_id );
        } else if ( isset( $_POST['donation_shipping_confirmation'] ) ) {
            update_field( 'donation_residential_delivery', null, $manage_shelter_id );
        }
        if ( isset( $_POST['shelter_donation_confirmation'] ) && !empty( $_POST['shelter_donation_confirmation'] ) ) {
            update_field( 'donation_confirmation', date('Y-m-d' ), $manage_shelter_id );
        }

        // If the user has enabled marketing emails, let's make sure that they have an active subscription, otherwise let's opt them out
        update_user_meta( $user_id, '_cp_marketing_opted_in', (isset($_POST['allow_marketing_emails'])) ? 1 : 0);

        wc_add_notice( __( 'Shelter details updated successfully.', 'catspride' ) );

        $completed = get_post_meta( $manage_shelter_id, '_cp_shelter_profile_completed', true );

        /**
         * Update any current donations that the shelter is associated with and set that the shipping address is confirmed
         *
         * Set to PENDING DELIVERY status now that their address is confirmed
         */
        if ( isset( $_POST['shelter_donation_confirmation'] ) ) {

            $donations = cp_get_shelter_donations( $manage_shelter_id, [
                'current_only' => true, 'donation_status_id' => 2
            ] );

            if ( $donations ) {
                foreach( $donations as $donation ) {
                    cp_update_shelter_donation_status( $donation->donation_post_id, $donation->shelter_post_id, 3 );
                }
            }
        }

        if ( empty( $completed ) ) {
            // Mark the profile as having been completed
            add_post_meta( $manage_shelter_id, '_cp_shelter_profile_completed', date('c') );
        }

        cp_sync_active_campaign_data( $user_id );

        // Send them back to their shelter resources page
        wp_redirect( wc_get_page_permalink( 'myaccount' ) . '/shelter-resources/?tab=my-account' );
        exit;

    }

    /**
     * Process the edit shelter page form
     */
    public static function process_edit_shelter_page() {

        if ( 'POST' !== strtoupper( $_SERVER['REQUEST_METHOD'] ) ) {
            return;
        }

        if ( empty( $_POST['action'] ) || 'edit_shelter_page' !== $_POST['action'] || empty( $_POST['_wpnonce'] ) || ! wp_verify_nonce( $_POST['_wpnonce'], 'catspride-edit_shelter_page' ) ) {
            return;
        }

        $user_id            = get_current_user_id();
        $manage_shelter_id  = get_user_meta( $user_id, '_cp_manage_shelter_id', true );

        if ( isset( $_POST['page_header_type'] ) && $_POST['page_header_type'] === 'video' && empty( $_POST['page_header_video'] ) ) {
            wc_add_notice( 'Invalid YouTube video URL.', 'error' );
        }

        // If we have errors, let's return before we save anything
        if (wc_notice_count( 'error' ) > 0) {
            return;
        }

        // Update the shelter name
        wp_update_post( array( 'ID' => $manage_shelter_id, 'post_content' => sanitize_text_field( $_POST['our_mission_text'] ) ) );

        $page_header_type = ( isset( $_POST['page_header_type'] ) ) ? sanitize_text_field( $_POST['page_header_type'] ) : null;
        update_field( 'page_header_type', $page_header_type, $manage_shelter_id );

        $page_header_video = ( isset( $_POST['page_header_video'] ) ) ? sanitize_text_field( $_POST['page_header_video'] ) : null;
        update_field( 'page_header_video', $page_header_video, $manage_shelter_id );

        $page_header_slideshow = ( isset( $_POST['page_header_slideshow'] ) ) ? sanitize_text_field( $_POST['page_header_slideshow'] ) : null;
        update_field( 'page_header_slideshow', $page_header_slideshow, $manage_shelter_id );

        $page_visible = ( isset( $_POST['page_visible'] ) ) ? sanitize_text_field( $_POST['page_visible'] ) : 0;
        update_field( 'page_visible', $page_visible, $manage_shelter_id );

        $address_visible = ( isset( $_POST['address_visible'] ) ) ? sanitize_text_field( $_POST['address_visible'] ) : 0;
        update_field( 'address_visible', $address_visible, $manage_shelter_id );

        $contact_name_visible = ( isset( $_POST['contact_name_visible'] ) ) ? sanitize_text_field( $_POST['contact_name_visible'] ) : 0;
        update_field( 'contact_name_visible', $contact_name_visible, $manage_shelter_id );

        $phone_visible = ( isset( $_POST['phone_visible'] ) ) ? sanitize_text_field( $_POST['phone_visible'] ) : 0;
        update_field( 'phone_visible', $phone_visible, $manage_shelter_id );

        $email_visible = ( isset( $_POST['email_visible'] ) ) ? sanitize_text_field( $_POST['email_visible'] ) : 0;
        update_field( 'email_visible', $email_visible, $manage_shelter_id );

        $website_visible = ( isset( $_POST['website_visible'] ) ) ? sanitize_text_field( $_POST['website_visible'] ) : 0;
        update_field( 'website_visible', $website_visible, $manage_shelter_id );

        $facebook_visible = ( isset( $_POST['facebook_visible'] ) ) ? sanitize_text_field( $_POST['facebook_visible'] ) : 0;
        update_field( 'facebook_visible', $facebook_visible, $manage_shelter_id );

        $instagram_visible = ( isset( $_POST['instagram_visible'] ) ) ? sanitize_text_field( $_POST['instagram_visible'] ) : 0;
        update_field( 'instagram_visible', $instagram_visible, $manage_shelter_id );

        $twitter_visible = ( isset( $_POST['twitter_visible'] ) ) ? sanitize_text_field( $_POST['twitter_visible'] ) : 0;
        update_field( 'twitter_visible', $twitter_visible, $manage_shelter_id );

        $attachments = get_post_meta( $manage_shelter_id, 'slideshow_attachments', true );
        $attachments = ( empty( $attachments ) ) ? array() : $attachments;

        if ( isset( $_POST['remove_attachments'] ) && count( $_POST['remove_attachments'] ) ) {

            foreach( $_POST['remove_attachments'] as $attachment ) {
                $upload_dir = wp_upload_dir();
                $attachment_path = $upload_dir['basedir'] . '/cp_shelter_uploads/';
                unlink( $attachment_path . $attachment );
                $key = array_search( $attachment, $attachments );
                unset( $attachments[$key] );
            }

        }

        // We won't save more than 4 of the images
        if ( count( $attachments ) < 4 ) {

            if ( isset( $_POST['add_attachments'] ) && count( $_POST['add_attachments'] ) ) {

                foreach ( $_POST['add_attachments'] as $attachment ) {

                    $upload_dir          = wp_upload_dir();
                    $attachment_path     = $upload_dir['basedir'] . '/cp_shelter_uploads/';
                    $new_attachment_name = preg_replace('/_/', '', $attachment, 1);

                    if ( count( $attachments ) >= 4 ) {
                        if ( file_exists($attachment_path . $attachment ) ) {
                            unlink($attachment_path . $attachment );
                        }
                        continue;
                    }

                    if ( file_exists($attachment_path . $attachment ) ) {
                        rename($attachment_path . $attachment, $attachment_path . $new_attachment_name );
                    }
                    $attachments[] = $new_attachment_name;
                }

            }

        }

        // Mark that the shelter page settings have been saved
        update_post_meta( $manage_shelter_id, '_cp_shelter_page_saved', date('c') );

        $logger = cp_get_logger();

        $logger->info(
            'Running ' . __FUNCTION__ . ': Shelter page settings have been saved.',
            array(),
            'shelter_account',
            'cp_shelter',
            $manage_shelter_id
        );

        // Update the attachments
        update_post_meta( $manage_shelter_id, 'slideshow_attachments', $attachments );

        wc_add_notice( __( 'Shelter page details updated successfully.', 'catspride' ) );

        // Sync the active campaign data
        cp_sync_active_campaign_data( $user_id );

        wp_redirect( wc_get_page_permalink( 'myaccount' ) . '/shelter-resources/?tab=manage-my-shelter-page' );
        exit;

    }

    /**
     * Process the shelter bonus code form
     */
    public static function process_shelter_bonus_code() {

        if ( 'POST' !== strtoupper( $_SERVER['REQUEST_METHOD'] ) ) {
            return;
        }

        if ( empty( $_POST['action'] ) || 'shelter_bonus_code' !== $_POST['action'] || empty( $_POST['_wpnonce'] ) || ! wp_verify_nonce( $_POST['_wpnonce'], 'catspride-shelter_bonus_code' ) ) {
            return;
        }

        if ( !isset( $_POST['favorite_shelter'] ) || !is_numeric( $_POST['favorite_shelter'] ) || cp_get_shelter_by_id( $_POST['favorite_shelter'] ) === false ) {
            wc_add_notice( 'Invalid shelter provided. Please try again.', 'error' );
            return;
        }

        $user       = wp_get_current_user();
        $bonus_code = null;

        if ( isset( $_POST['bonus_code'] ) && !empty( $_POST['bonus_code'] ) ) {

            $bonus_code = cp_get_bonus_code( $_POST['bonus_code'] );

            if ( $bonus_code !== false ) {

                if ( !empty( $bonus_code['expiration_date'] ) && $bonus_code['expiration_date'] < date( 'Y-m-d' ) ) {

                    wc_add_notice( 'This bonus code has expired. Please try again.', 'error' );
                    return;

                }

                // Save the user's nomination
                cp_insert_user_shelter_nomination( $user->ID, (int) $_POST['favorite_shelter'], $bonus_code );

                wc_add_notice( 'Thank you. We have added your bonus code!', 'notice' );

            } else {

                wc_add_notice( 'Invalid bonus code provided. Please try again.', 'error' );
                return;

            }

        } else {

            wc_add_notice( 'Invalid bonus code provided. Please try again.', 'error' );
            return;

        }

        // Send them back to their account dashboard
        wp_redirect( wc_get_page_permalink( 'myaccount' ) );
        exit;

    }

    /**
     * Process the choose shelter form
     */
    public static function process_choose_shelter() {

        if ( 'POST' !== strtoupper( $_SERVER['REQUEST_METHOD'] ) ) {
            return;
        }

        if ( empty( $_POST['action'] ) || 'choose_shelter' !== $_POST['action'] || empty( $_POST['_wpnonce'] ) || ! wp_verify_nonce( $_POST['_wpnonce'], 'catspride-choose_shelter' ) ) {
            return;
        }

        if ( !isset( $_POST['favorite_shelter'] ) || !is_numeric( $_POST['favorite_shelter'] ) || cp_get_shelter_by_id( $_POST['favorite_shelter'] ) === false ) {
            wc_add_notice( 'Invalid shelter provided. Please try again.', 'error' );
            return;
        }

        $user = wp_get_current_user();

        if ( $user ) {

            $bonus_code = null;

            if (isset($_POST['bonus_code']) && !empty($_POST['bonus_code'])) {

                $bonus_code = cp_get_bonus_code($_POST['bonus_code']);

                if ($bonus_code !== false) {

                    if (!empty($bonus_code['expiration_date']) && $bonus_code['expiration_date'] < date('Y-m-d')) {

                        wc_add_notice('This bonus code has expired. Please try again.', 'error');

                        return;

                    }

                } else {

                    wc_add_notice('Invalid bonus code provided. Please try again.', 'error');

                    return;

                }
            }

            // Save the user's nomination
            cp_insert_user_shelter_nomination($user->ID, (int)$_POST['favorite_shelter'], $bonus_code);

            wc_add_notice('Thank you. We have updated your favorite shelter.', 'notice');

        }

        // Send them back to their account dashboard
        wp_redirect( wc_get_page_permalink( 'myaccount' ) );
        exit;

    }

    /**
     * Process the opt-out shelter form
     */
    public static function process_friend_share() {

        if ( 'POST' !== strtoupper( $_SERVER['REQUEST_METHOD'] ) ) {
            return;
        }

        if ( empty( $_POST['action'] ) || 'friend_share' !== $_POST['action'] || empty( $_POST['_wpnonce'] ) || ! wp_verify_nonce( $_POST['_wpnonce'], 'catspride-friend_share' ) ) {
            return;
        }

        $name = ( isset( $_POST[ 'friend_share_name' ] ) ) ? $_POST[ 'friend_share_name' ] : null;
        $email = ( isset( $_POST[ 'friend_share_email' ] ) ) ? $_POST[ 'friend_share_email' ] : null;
        $friend_email = ( isset( $_POST[ 'friend_share_friend_email' ] ) ) ? $_POST[ 'friend_share_friend_email' ] : null;

        if ( $name && $email && $friend_email && filter_var($email, FILTER_VALIDATE_EMAIL) && filter_var($friend_email, FILTER_VALIDATE_EMAIL)) {

            // Instantiate the email classes so they are ready to send
            $mailer = WC()->mailer();
            $emails = $mailer->get_emails();

            if ( isset( $emails['CP_Litter_For_Good_Friend_Share_Email'] ) ) {
                $emails['CP_Litter_For_Good_Friend_Share_Email']->shared_by_name = $name;
                $emails['CP_Litter_For_Good_Friend_Share_Email']->shared_by_email = $email;
                $emails['CP_Litter_For_Good_Friend_Share_Email']->recipient = $friend_email;
                $emails['CP_Litter_For_Good_Friend_Share_Email']->trigger(null, null, null);
            }

            if ( isset( $emails['CP_Litter_For_Good_Friend_Share_Thank_You_Email'] ) ) {
                $emails['CP_Litter_For_Good_Friend_Share_Thank_You_Email']->recipient = $email;
                $emails['CP_Litter_For_Good_Friend_Share_Thank_You_Email']->trigger(null, null, null);
            }

            unset($_POST[ 'friend_share_email' ]);
            unset($_POST[ 'friend_share_friend_email' ]);

            wc_add_notice( 'Thank You! We will let your friend know about our Litter for Good program!', 'success' );

        } else {

            wc_add_notice( 'Please verify the email addresses you entered and try again.', 'error' );

        }

    }

    /**
     * Process the opt-out shelter form
     */
    public static function process_optout_shelter() {

        if ( 'POST' !== strtoupper( $_SERVER['REQUEST_METHOD'] ) ) {
            return;
        }

        if ( empty( $_POST['action'] ) || 'optout_shelter' !== $_POST['action'] || empty( $_POST['_wpnonce'] ) || ! wp_verify_nonce( $_POST['_wpnonce'], 'catspride-optout_shelter' ) ) {
            return;
        }

        if ( !isset( $_POST['optout_confirm'] ) ) {
            wc_add_notice( 'You must check the box to confirm you would like to opt-out of the program.', 'error' );
            return;
        }

        $shelter_id = cp_get_shelter_by_manager_id( get_current_user_id() );
        $shelter    = get_post( $shelter_id );

        if ( $shelter ) {

            // Instantiate the email classes so they are ready to send
            $mailer = WC()->mailer();
            $emails = $mailer->get_emails();

            if ( isset( $emails['CP_Optout_Shelter_Confirmation_Email'] ) ) {
                $emails['CP_Optout_Shelter_Confirmation_Email']->trigger( $shelter_id, $shelter, wp_get_current_user());
            }

            wc_add_notice( 'Please check your e-mail to confirm your opt-out request.', 'notice' );

        } else {

            wc_add_notice( 'Invalid shelter provided. Please ensure user is a current shelter manager.', 'error' );
            return;

        }

        // Send them back to their account dashboard
        wp_redirect( wc_get_page_permalink( 'myaccount' ) );
        exit;

    }

    /**
     * Process the nominate a shelter form
     */
    public static function process_nominate_shelter() {

        if ( 'POST' !== strtoupper( $_SERVER['REQUEST_METHOD'] ) ) {
            return;
        }

        if ( empty( $_POST['action'] ) || 'nominate_shelter' !== $_POST['action'] || empty( $_POST['_wpnonce'] ) || ! wp_verify_nonce( $_POST['_wpnonce'], 'catspride-nominate_shelter' ) ) {
            return;
        }

        if ( !isset( $_POST['shelter_name'] ) || empty( $_POST['shelter_name'] ) ) {
            wc_add_notice( 'Invalid shelter name provided.', 'error' );
            return;
        }

        if ( !isset( $_POST['shelter_city'] ) || empty( $_POST['shelter_city'] ) ) {
            wc_add_notice( 'Invalid shelter city provided.', 'error' );
            return;
        }

        if ( !isset( $_POST['shelter_state'] ) || empty( $_POST['shelter_state'] ) ) {
            wc_add_notice( 'Invalid shelter state provided.', 'error' );
            return;
        }

        if ( isset( $_POST['shelter_website'] ) && empty( $_POST['shelter_website'] ) ) {
            wc_add_notice( 'Invalid shelter website provided.', 'error' );
            return;
        }

        if ( isset( $_POST['shelter_email'] )
            && !empty( $_POST['shelter_email'] )
            && !filter_var( $_POST['shelter_email'], FILTER_VALIDATE_EMAIL )) {
            wc_add_notice( 'Invalid email provided.', 'error' );
            return;
        }

        if( !isset( $_POST['force_nomination'] ) ) {

            global $cp_shelters;

            $cp_shelters = [];

            $duplicate_shelters = cp_get_duplicate_shelters( $_POST );

            if ($duplicate_shelters['status'] === 'duplicates_found') {

                $cp_shelters = $duplicate_shelters['shelters'];

                // We need to display the shelters for the user to select one, or force the nomination
                return;

            } else if ($duplicate_shelters['status'] === 'shelter_found_trashed') {

                wc_add_notice($duplicate_shelters['message'], 'error');
                return;

            } else if ($duplicate_shelters['status'] === 'shelter_found_pending') {

                wc_add_notice($duplicate_shelters['message'], 'notice');
                return;

            }
        }

        $meta = array(
            'city' => sanitize_text_field( trim( $_POST['shelter_city'] ) ),
            'state' => sanitize_text_field( trim( $_POST['shelter_state'] ) ),
            'website' => sanitize_text_field( rtrim( trim( $_POST['shelter_website'] ), '/' ) ),
            'email' => sanitize_text_field( trim( $_POST['shelter_email'] ) )
        );

        // Let's flag the submission as having been forced if it was.
        if ( isset( $_POST['force_nomination'] ) ) {
            $meta['_cp_force_nomination'] = '1';
        }

        $shelter_id = wp_insert_post( array (
            'post_title' => sanitize_text_field( trim( $_POST['shelter_name'] ) ),
            'post_type' => 'cp_shelter',
            'post_status' => 'pending',
            'post_date' => current_time('mysql'),
            'post_date_gmt' => get_gmt_from_date(current_time('mysql')),
            'meta_input' => $meta
        ) );

        if ( $shelter_id ) {

            $user = wp_get_current_user();

            /**
             * @var $logger CP_Logger
             */
            $logger = cp_get_logger();

            $logger->info(
                'User nominated a new shelter.',
                array( 'params' => $_POST ),
                'user_account',
                'user',
                $user->ID
            );

            $logger->info(
                'Shelter was nominated by user.',
                array( 'params' => $_POST ),
                'shelter_account',
                'cp_shelter',
                $shelter_id
            );

            // Sync Active Campaign, marking the user as having nominated a new shelter
            cp_sync_active_campaign_contact($user->ID, ['field' => ['%SHELTER_NOMINATION_TIME%,0' => date('c')]]);

            // Save the user as having nominated the shelter
            add_post_meta( $shelter_id, '_cp_nominated_by_user', $user->ID );
        }

        wc_add_notice( 'Thank you! We will review your submission shortly!', 'notice' );

        // Send them back to their account dashboard
        wp_redirect( wc_get_page_permalink( 'myaccount' ) );
        exit;

    }

    public static function process_store_locator() {

        if ( 'POST' !== strtoupper( $_SERVER['REQUEST_METHOD'] ) ) {
            return;
        }

        if ( empty( $_POST['action'] ) || 'store_locator' !== $_POST['action'] || empty( $_POST['_wpnonce'] ) || ! wp_verify_nonce( $_POST['_wpnonce'], 'catspride-store_locator' ) ) {
            return;
        }

        if ( !isset( $_POST['zip_code'] ) || empty( $_POST['zip_code'] ) || !preg_match( '/^[0-9]{5}([- ]?[0-9]{4})?$/', $_POST['zip_code'] ) ) {
            wc_add_notice( 'Please enter your zip code and try again.', 'error' );
            return;
        }

        $posted_item = isset( $_POST['item_id'] ) ? sanitize_text_field( $_POST['item_id'] ) : '';

        // The store locator dropdown now posts the product key (UPC) directly.
        // If the posted value is a valid key, use it as-is. Otherwise fall back
        // to the legacy id->key lookup (e.g. the find-a-store shortcode, or any
        // cached page, still posts a product id).
        if ( in_array( $posted_item, cp_get_valid_store_locator_product_keys(), true ) ) {
            $item_key = $posted_item;
        } else {
            $item_key = cp_get_store_locator_product_key_from_id( $posted_item );
        }

        //$item_key = 'ALLPROD';

        $stores = array();

        $user_ip_address = $_SERVER['REMOTE_ADDR'];
        $search_zip_code = $_POST['zip_code'];

        // Set the following parameters to send to Astute for store lookup
        $params = array(
            'item' => $item_key,
            'ip' => $user_ip_address,
            'zip' => $search_zip_code,
            'customer' => 'oildri',
            'radius' => 25
        );

        // Format the options into the correct submission format
        $opts = array(
            'http' => array(
                'method' => 'POST',
                'header' => "Referer: ". get_bloginfo('url') . "/storelocator/\r\n" .
                    "Content-type: application/x-www-form-urlencoded\r\n",
                'content' => http_build_query( $params )
            )
        );

        // URL to send request to
        $url = 'http://www2.itemlocator.net/ils/locatorJSON/';

        $fp = file_get_contents($url, false, stream_context_create( $opts ));
        


        $GLOBALS['cp_sl_xml_response'] = $fp;

        if ($fp) //Make sure we got a response
        {
            $json = json_decode( $fp ); //Parse JSON

            if ($json && count( $json->nearbyStores ) > 0) //Check if we got any stores returned
            {
                $stores = array();
                foreach ( $json->nearbyStores as $store )
                {
                    $stores[$store->storeid] = array(
                        "store_id"   => (string) $store->storeid,
                        "distance"   => (string) $store->distance,
                        "name"       => (string) $store->name,
                        "phone"      => (string) $store->phone,
                        "address"    => (string) $store->address,
                        "address2"   => (string) $store->address2,
                        "city"       => (string) $store->city,
                        "state"      => (string) $store->state,
                        "zip"        => (string) $store->zip,
                        "latitude"   => (string) $store->latitude,
                        "longitude"  => (string) $store->longitude
                    );
                }

                //Sort the stores by distance
                foreach ($stores as $id => $store)
                {
                    $distances[$id] = $store['distance'];
                }
                array_multisort($distances, SORT_ASC, $stores);

            } else {

                wc_add_notice( 'No stores were found near you. To purchase online instead, please see below.', 'notice' );
                return;

            }

        } else {

            wc_add_notice( 'We are having a problem retrieving your nearest store. Please try again later.', 'error' );
            return;

        }

        $GLOBALS['cp_sl_stores'] = $stores;

    }

    /**
     * Handle lost password form.
     */
    public static function process_lost_password() {

        if ( isset( $_POST['wc_reset_password'] ) && isset( $_POST['user_login'] ) && isset( $_POST['_wpnonce'] ) && wp_verify_nonce( $_POST['_wpnonce'], 'lost_password' ) ) {

            $success = WC_Shortcode_My_Account::retrieve_password();

            // If successful, redirect to my account with query arg set.
            if ( $success ) {
                wp_redirect( add_query_arg( 'reset-link-sent', 'true', wc_get_account_endpoint_url( 'lost-password' ) ) );
                exit;
            } else {

                $result = cp_user_exists_in_active_campaign_by_email( $_POST['user_login'] );

                if ( $result !== false ) {

                    // If a notice was set during the account look-up check, let's clear it out
                    if (wc_notice_count() > 0) {
                        wc_clear_notices();
                    }

                    // Without setting a session, we won't be able to trigger a message for display.
                    if (!WC()->session->has_session()) {
                        WC()->session->set_customer_session_cookie(true);
                    }

                    // The user does not exist in Active Campaign.
                    if ($result->result_code === 0) {

                        wc_add_notice(__('The email you\'ve entered does not match an account.', 'catspride'), 'notice');

                    // The user exists in Active Campaign, but they don't have a CPC account.
                    } else if ($result->result_code === 1) {

                        wc_add_notice(__('We\'ve added more benefits and exclusive offers to our Cat\'s Pride Club! To upgrade and manage your membership, please complete the registration form below.', 'catspride'), 'notice');

                    }

                    // Let's pass the email address to the form so we can fill that out for them. We are good guys.
                    wp_safe_redirect( add_query_arg( array(
                        'tab' => 'register',
                        'email' => urlencode( $_POST['user_login'] )
                    ), wc_get_page_permalink( 'myaccount' ) ) );

                    exit;

                }
            }
        }
    }

}

CP_Form_Handler::init();