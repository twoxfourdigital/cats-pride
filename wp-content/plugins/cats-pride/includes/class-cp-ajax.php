<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Cat's Pride CP_AJAX.
 *
 * AJAX Event Handler.
 *
 * @class    CP_AJAX
 */
class CP_AJAX {

    /**
     * Hook in ajax handlers.
     */
    public static function init() {
        add_action( 'init', array( __CLASS__, 'define_ajax' ), 0 );
        add_action( 'template_redirect', array( __CLASS__, 'do_cp_ajax' ), 0 );
        self::add_ajax_events();
    }

    /**
     * Set CP AJAX constant and headers.
     */
    public static function define_ajax() {
        if ( ! empty( $_GET['cp-ajax'] ) ) {
            cp_maybe_define_constant( 'DOING_AJAX', true );
            cp_maybe_define_constant( 'CP_DOING_AJAX', true );
            if ( ! WP_DEBUG || ( WP_DEBUG && ! WP_DEBUG_DISPLAY ) ) {
                @ini_set( 'display_errors', 0 ); // Turn off display_errors during AJAX events to prevent malformed JSON
            }
            $GLOBALS['wpdb']->hide_errors();

        }
    }

    /**
     * Send headers for CP Ajax Requests.
     *
     */
    private static function cp_ajax_headers() {
        send_origin_headers();
        @header( 'Content-Type: text/html; charset=' . get_option( 'blog_charset' ) );
        @header( 'X-Robots-Tag: noindex' );
        send_nosniff_header();
        nocache_headers();
        status_header( 200 );
    }

    /**
     * Check for CP Ajax request and fire action.
     */
    public static function do_cp_ajax() {

        global $wp_query;

        if ( ! empty( $_GET['cp-ajax'] ) ) {
            $wp_query->set( 'cp-ajax', sanitize_text_field( $_GET['cp-ajax'] ) );
        }

        if ( $action = $wp_query->get( 'cp-ajax' ) ) {
            self::cp_ajax_headers();
            do_action( 'cp_ajax_' . sanitize_text_field( $action ) );
            wp_die();
        }

    }

    /**
     * Hook in methods - uses WordPress ajax handlers (admin-ajax).
     */
    public static function add_ajax_events() {

        // CP EVENT => nopriv
        $ajax_events = array(
            'update_nomination'                          => true,
            'get_donation_shelters'                      => false,
            'bulk_action_donation_send_notifications'    => false,
            'bulk_action_donation_include_in_donation'   => false,
            'bulk_action_donation_exclude_from_donation' => false,
            'bulk_action_donation_mark_as_completed'     => false,
            'edit_shelter_resources_slideshow_uploads'   => false
        );

        foreach ( $ajax_events as $ajax_event => $nopriv ) {
            add_action( 'wp_ajax_cp_' . $ajax_event, array( __CLASS__, $ajax_event ) );

            if ( $nopriv ) {
                add_action( 'wp_ajax_nopriv_cp_' . $ajax_event, array( __CLASS__, $ajax_event ) );

                // CP AJAX can be used for frontend ajax requests.
                add_action( 'cp_ajax_' . $ajax_event, array( __CLASS__, $ajax_event ) );
            }
        }
    }

    public static function edit_shelter_resources_slideshow_uploads()
    {
        try {

            if ( empty($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'catspride-ajax')) {
                wp_send_json_error( [ 'message' => 'Invalid nonce provided.' ] );
            }

            if ( empty( $_FILES['attachment']['name'] ) ) {
                throw new Exception( 'Invalid file name.' );
            }

            // Max 2MB
            if ( $_FILES['attachment']['size'] > 2000000 ) {
                throw new Exception( 'Invalid file size.' );
            }

            $file_type = exif_imagetype( $_FILES['attachment']['tmp_name'] );

            if ( ! in_array( $file_type, [ IMAGETYPE_PNG, IMAGETYPE_JPEG ] ) ) {
                throw new Exception( 'Invalid file type.' );
            }

            $upload_dir = wp_upload_dir();

            // Files with an underscore are not saved to a shelter
            $file_name = '_' . uniqid() . '_' . sanitize_file_name($_FILES['attachment']['name']);
            $full_path = $upload_dir['basedir'] . '/cp_shelter_uploads/' . $file_name;

            if ( !move_uploaded_file( $_FILES['attachment']['tmp_name'], $full_path ) ) {
                throw new Exception('Error uploading file to server.' );
            }

            $jpeg_quality = 90;
            $max_w = 450;
            $max_h = 230;
            $crop  = true;

            $editor = wp_get_image_editor( $full_path );
            if ( is_wp_error( $editor ) ) {
                throw new Exception( $editor->get_error_message() );
            }

            $editor->set_quality( $jpeg_quality );

            $resized = $editor->resize( $max_w, $max_h, $crop );
            if ( is_wp_error( $resized ) ) {
                throw new Exception( $resized->get_error_message() );
            }

            $saved = $editor->save( $full_path );

            if ( is_wp_error( $saved ) ) {
                throw new Exception( $saved->get_error_message() );
            }

            wp_send_json_success([
                'message' => __( 'Uploads processed successfully.', 'catspride' ),
                'file_name' => $file_name
            ]);

        } catch ( \Exception $e ) {

            wp_send_json_error( [ 'message' => $e->getMessage() ] );

        }
    }

    /**
     *
     */
    public static function bulk_action_donation_send_notifications()
    {
        try {

            if ( !isset( $_POST['nonce'] ) || !wp_verify_nonce( $_POST['nonce'], 'search-donation-shelters' ) ) {
                wp_send_json_error( [ 'message' => 'Invalid nonce provided.' ] );
            }

            CP_Meta_Box_Donation_Shelters::send_notifications( $_POST );

            wp_send_json_success([
                'message' => __( 'Notifications sent successfully.', 'catspride' )
            ]);

        } catch ( \Exception $e ) {

            wp_send_json_error( [ 'message' => $e->getMessage() ] );

        }

    }

    /**
     *
     */
    public static function bulk_action_donation_include_in_donation()
    {
        try {

            if ( !isset( $_POST['nonce'] ) || !wp_verify_nonce( $_POST['nonce'], 'search-donation-shelters' ) ) {
                wp_send_json_error( array( 'message' => 'Invalid nonce provided.' ) );
            }

            CP_Meta_Box_Donation_Shelters::include_in_donation( $_POST );

            wp_send_json_success([
                'message' => __( 'Shelters added to donation successfully.', 'catspride' )
            ]);

        } catch ( \Exception $e ) {

            wp_send_json_error( array( 'message' => $e->getMessage() ) );

        }

    }

    public static function bulk_action_donation_exclude_from_donation()
    {
        try {

            if ( !isset( $_POST['nonce'] ) || !wp_verify_nonce( $_POST['nonce'], 'search-donation-shelters' ) ) {
                wp_send_json_error( array( 'message' => 'Invalid nonce provided.' ) );
            }

            CP_Meta_Box_Donation_Shelters::exclude_from_donation( $_POST );

            wp_send_json_success([
                'message' => __( 'Shelters removed from donation successfully.', 'catspride' )
            ]);

        } catch ( \Exception $e ) {

            wp_send_json_error( array( 'message' => $e->getMessage() ) );

        }

    }

    public static function bulk_action_donation_mark_as_completed()
    {
        try {

            if ( !isset( $_POST['nonce'] ) || !wp_verify_nonce( $_POST['nonce'], 'search-donation-shelters' ) ) {
                wp_send_json_error( array( 'message' => 'Invalid nonce provided.' ) );
            }

            CP_Meta_Box_Donation_Shelters::mark_as_delivered( $_POST );

            wp_send_json_success([
                'message' => __( 'Shelters updated successfully.', 'catspride' )
            ]);

        } catch ( \Exception $e ) {

            wp_send_json_error( array( 'message' => $e->getMessage() ) );

        }

    }

    /**
     * Retrieve the shelters for a donation
     */
    public static function get_donation_shelters()
    {
        try {

            if ( !isset( $_POST['nonce'] ) || !wp_verify_nonce( $_POST['nonce'], 'search-donation-shelters' ) ) {
                wp_send_json_error( array( 'message' => 'Invalid nonce provided.' ) );
            }

            $shelters = CP_Meta_Box_Donation_Shelters::get_shelters( $_POST );

            $total_nominations = 0;

            $donation_status_totals = array(
                0 => 0, // Not Participating
                1 => 0, // Participating / Pending Notification
                2 => 0, // Pending Address Confirmation
                3 => 0, // Pending Delivery
                4 => 0  // Completed
            );

            if ( $shelters && count( $shelters ) > 0 ) {

                foreach( $shelters as $shelter ) {
                    $donation_status_totals[$shelter->donation_status_id]++;
                    $total_nominations += $shelter->nominations;
                }

                wp_send_json_success([
                    'shelters' => $shelters,
                    'donation_status_totals' => $donation_status_totals,
                    'total_nominations' => $total_nominations,
                    'message' => __( 'Shelters were found matching your criteria.', 'catspride' )
                ]);

            } else {

                wp_send_json_error( array(
                    'message' => __( 'No shelters were found with the provided search criteria.', 'catspride' )
                ) );

            }

        } catch ( \Exception $e ) {

            wp_send_json_error( array(
                'message' => $e->getMessage()
            ) );

        }

    }

    /**
     *
     */
    public static function update_nomination() {

        $user_id         = get_current_user_id();
        $shelter_post_id = (int) $_POST['favorite_shelter'];
        $bonus_code      = ( isset( $_POST['bonus_code'] ) && !empty( $_POST['bonus_code'] ) ) ? wc_clean( $_POST['bonus_code'] ) : null;

        try {

            if ( !empty( $bonus_code ) ) {

                $bonus_code = cp_get_bonus_code( $bonus_code );

                if ($bonus_code !== false) {

                    if ( !empty( $bonus_code['expiration_date'] ) && $bonus_code['expiration_date'] < date('Y-m-d') ) {

                        throw new \Exception('This bonus code has expired. Please try again.');

                    }

                } else {

                    throw new \Exception('Invalid bonus code provided. Please try again.');

                }

            }

            $result = cp_insert_user_shelter_nomination( $user_id, $shelter_post_id, $bonus_code );

            if ( $result ) {

                wp_send_json_success([
                    'message' => (!empty($bonus_code))
                        ? __('Your bonus code <strong><br>has been accepted!</strong>', 'catspride')
                        : __('Your nomination <strong><br>has been confirmed!</strong>', 'catspride')
                ]);

            } else {

                wp_send_json_error( array( 'message' => __( 'You\'ve already nominated this shelter. You\'re all set!', 'catspride' ) ) );

            }

        } catch ( Exception $e ) {

            wp_send_json_error( array( 'message' => $e->getMessage() ) );

        }
    }
}

CP_AJAX::init();
