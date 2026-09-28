<?php
/**
 * Post Types
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * CP_Post_Types Class.
 */
class CP_Post_Types {

    /**
     * Hook in methods.
     */
    public static function init() {

        add_action( 'init', array( __CLASS__, 'register_post_types' ), 5 );

        /**
         * cp_shelter
         */
        add_action( 'manage_cp_shelter_posts_custom_column' , array( __CLASS__, 'cp_shelter_add_custom_columns' ), 10, 2 );
        add_action( 'pre_get_posts', array( __CLASS__, 'cp_shelter_add_custom_orderby' ) );
        add_filter( 'manage_cp_shelter_posts_columns', array( __CLASS__, 'cp_shelter_add_custom_columns_header' ) );
        add_filter( 'manage_edit-cp_shelter_sortable_columns', array( __CLASS__, 'cp_shelter_add_sortable_custom_header' ) );
        add_filter( 'bulk_actions-edit-cp_shelter', array( __CLASS__, 'cp_shelter_register_shelter_bulk_actions' ) );
        add_filter( 'handle_bulk_actions-edit-cp_shelter', array( __CLASS__, 'cp_shelter_action_handler' ), 10, 3 );
        add_action( 'admin_notices', array( __CLASS__, 'cp_shelter_action_admin_notice' ) );

        /**
         * cp_donation
         */
        add_action( 'manage_cp_donation_posts_custom_column' , array( __CLASS__, 'cp_donation_add_custom_columns' ), 10, 2 );
        add_action( 'pre_get_posts', array( __CLASS__, 'cp_donation_add_custom_orderby' ) );
        add_filter( 'manage_cp_donation_posts_columns', array( __CLASS__, 'cp_donation_add_custom_columns_header' ) );
        add_filter( 'manage_edit-cp_donation_sortable_columns', array( __CLASS__, 'cp_donation_add_sortable_custom_header' ) );
    }

    /**
     * Register core post types.
     */
    public static function register_post_types()
    {
        if (!is_blog_installed() || post_type_exists('cp_shelter')) {
            return;
        }

        register_post_type('cp_shelter',
            [
                'labels'             => [
                    'name'               => __('Shelters'),
                    'singular_name'      => __('Shelter'),
                    'add_new'            => __('Add Shelter'),
                    'add_new_item'       => __('Add New Shelter'),
                    'new_item'           => __('New Shelter'),
                    'view_item'          => __('View Shelter'),
                    'search_items'       => __('Search Shelters'),
                    'edit_item'          => __('Edit Shelter'),
                    'not_found'          => __('No shelters found'),
                    'not_found_in_trash' => __('No shelters found in trash')
                ],
                'supports'           => ['title', 'editor', 'thumbnail'],
                'hierarchical'       => false,
                'public'             => true,
                'show_ui'            => true,
                'show_in_menu'       => true,
                'show_in_nav_menus'  => true,
                'show_in_admin_bar'  => true,
                'can_export'         => true,
                'has_archive'        => false,
                'publicly_queryable' => true,
                'menu_position'      => 5,
                'menu_icon'          => 'dashicons-admin-multisite',
                'rewrite'            => ['slug' => 'shelter'],
                'capability_type'    => 'page',
                'map_meta_cap'       => true
            ]
        );

        if (!is_blog_installed() || post_type_exists('cp_donation')) {
            return;
        }

        register_post_type('cp_donation',
            [
                'labels'             => [
                    'name'               => __('Donations'),
                    'singular_name'      => __('Donation'),
                    'add_new'            => __('Add Donation'),
                    'add_new_item'       => __('Add New Donation'),
                    'new_item'           => __('New Donation'),
                    'view_item'          => __('View Donation'),
                    'search_items'       => __('Search Donations'),
                    'edit_item'          => __('Edit Donation'),
                    'not_found'          => __('No donations found'),
                    'not_found_in_trash' => __('No donations found in trash')
                ],
                'supports'           => ['title'],
                'hierarchical'       => false,
                'public'             => false,
                'show_ui'            => true,
                'show_in_menu'       => true,
                'show_in_nav_menus'  => true,
                'show_in_admin_bar'  => true,
                'can_export'         => true,
                'has_archive'        => false,
                'publicly_queryable' => false,
                'menu_position'      => 5,
                'menu_icon'          => 'dashicons-heart',
                'rewrite'            => ['slug' => 'donations'],
                'capability_type'    => 'page',
                'map_meta_cap'       => true
            ]
        );
    }

    /**
     * @param $bulk_actions
     * @return mixed
     */
    public static function cp_shelter_register_shelter_bulk_actions($bulk_actions) {
        $bulk_actions['resend_shelter_invite'] = __( 'Re-send Shelter Invite', 'catspride');
        return $bulk_actions;
    }

    /**
     * @param $redirect_to
     * @param $doaction
     * @param $post_ids
     * @return string
     */
    public static function cp_shelter_action_handler( $redirect_to, $doaction, $post_ids ) {

        if ( $doaction !== 'resend_shelter_invite' ) {
            return $redirect_to;
        }

        $total_sent = 0;

        // Instantiate the email classes so they are ready to send
        $mailer = WC()->mailer();
        $emails = $mailer->get_emails();

        foreach ( $post_ids as $post_id ) {

            $post = get_post($post_id);

            /*
             * Ensure that the post is:
             * - a shelter
             * - is in `draft` status
             * - has a contact email address set
             */
            if ( !$post || $post->post_type !== 'cp_shelter' || $post->post_status !== 'draft'
                || get_post_meta($post_id, 'email', true) === '')
                continue;

            // Remove existing _cp_invite_email_sent meta entry and re-send email
            delete_post_meta($post_id, '_cp_invite_email_sent');

            if (isset($emails['CP_Register_Shelter_Invite_Email'])) {

                $emails['CP_Register_Shelter_Invite_Email']->trigger($post_id, $post, $update = false);

            }

            $total_sent++;
        }

        $redirect_to = add_query_arg( 'resend_invites_completed', $total_sent, $redirect_to );
        return $redirect_to;
    }

    /**
     *
     */
    public static function cp_shelter_action_admin_notice() {
        if ( ! empty( $_REQUEST['resend_invites_completed'] ) ) {

            $invited_count = intval( $_REQUEST['resend_invites_completed'] );

            printf( '<div id="message" class="updated notice notice-success is-dismissable"><p>' .
                _n( 'Resent invite to %s shelter.',
                    'Resent invite to %s shelters.',
                    $invited_count,
                    'catspride'
                ) . '</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>', $invited_count );
        }
    }

    /**
     * @param $column
     * @param $post_id
     */
    public static function cp_shelter_add_custom_columns( $column, $post_id )
    {
        switch ( $column ) {

            case 'date_created' :
                $post = get_post( $post_id );
                echo ( $post ) ? '<abbr title="' . date('Y/m/d H:i:s a', strtotime( $post->post_date ) ) . '">' . date('Y/m/d', strtotime( $post->post_date ) ) . '</abbr>' : '';
                break;

            case 'email' :
                $email = get_post_meta( $post_id,'email', true );
                echo ( $email && !empty( $email ) ) ? $email : '';
                break;

            case 'location' :
                $lat = get_post_meta( $post_id,'latitude', true );
                $lon = get_post_meta( $post_id,'longitude', true );
                echo ( $lat && $lon && !empty( $lat ) && !empty( $lon ) ) ? 'Yes' : 'No';
                break;

            case 'nominations' :
                $shelter_nominations = cp_get_shelter_nomination_count( $post_id );
                $total_shelter_nominations = cp_get_shelter_nomination_count();
                echo ( $shelter_nominations > 0 && $total_shelter_nominations > 0)
                    ? $shelter_nominations . ' <span title="Total nominations: ' . $total_shelter_nominations . '">(' . number_format($shelter_nominations / $total_shelter_nominations * 100, 2) . '%)</span>'
                    : ' <span title="Total nominations: ' . $total_shelter_nominations . '">0</span>';
                break;

            case 'zip_code' :
                $zip_code = get_post_meta( $post_id,'zip_code', true );
                echo ( $zip_code && !empty( $zip_code ) ) ? $zip_code : '';
                break;

            case 'has_duplicates' :
                $has_duplicates = get_post_meta( $post_id,'_cp_has_shelter_duplicates', true );
                echo ( $has_duplicates && !empty( $has_duplicates ) && $has_duplicates == 1 ) ? 'Yes' : 'No';
                break;

            case 'downloaded_assets' :
                $downloaded_assets = get_post_meta( $post_id,'_cp_file_downloaded', true );
                echo ( $downloaded_assets && !empty( $downloaded_assets ) ) ? 'Yes' : 'No';
                break;

        }
    }

    /**
     * @param $columns
     * @return mixed
     */
    public static function cp_shelter_add_custom_columns_header( $columns )
    {
        unset( $columns['date'] );

        $columns['email']          = 'Shelter Email';
        $columns['nominations']    = 'Nominations';
        $columns['location']       = 'Lat/Lon';
        $columns['has_duplicates'] = 'Duplicates';
        $columns['zip_code']       = 'Zip Code';
        $columns['downloaded_assets'] = 'Downloaded Assets';
        $columns['date']           = 'Last Updated';
        $columns['date_created']   = 'Created';

        return $columns;
    }

    /**
     * @param $columns
     * @return mixed
     */
    public static function cp_shelter_add_sortable_custom_header( $columns )
    {
        $columns['date_created']   = 'date_created';
        $columns['nominations']    = 'nominations';
        $columns['has_duplicates'] = 'has_duplicates';
        $columns['downloaded_assets'] = 'downloaded_assets';
        $columns['zip_code']       = 'zip_code';
        $columns['email']          = 'email';

        return $columns;

    }

    /**
     * @param $query
     */
    public static function cp_shelter_add_custom_orderby( $query ) {
        if ( ! is_admin() )
            return;

        $orderby = $query->get( 'orderby' );

        if ( 'email' === $orderby || 'zip_code' === $orderby ) {
            $query->set( 'meta_key', $orderby );
            $query->set( 'orderby', 'meta_value' );
        } else if( 'nominations' === $orderby ) {
            $query->set( 'meta_key', '_cp_nomination_total' );
            $query->set( 'orderby', 'meta_value_num' );
        } else if( 'has_duplicates' === $orderby ) {
            $query->set( 'meta_key', '_cp_has_shelter_duplicates' );
            $query->set( 'orderby', 'meta_value' );
        } else if( 'downloaded_assets' === $orderby ) {
            $query->set( 'meta_key', '_cp_file_downloaded' );
            $query->set( 'orderby', 'meta_value' );
        }

    }

    /**
     * @param $column
     * @param $post_id
     */
    public static function cp_donation_add_custom_columns( $column, $post_id )
    {
        switch ( $column ) {

            case 'nomination_period' :
                $start_date = get_post_meta( $post_id, '_cp_nomination_start_date', true );
                $end_date   = get_post_meta( $post_id, '_cp_nomination_end_date', true );

                echo ( !empty( $start_date ) && !empty( $end_date ) ) ? '<abbr title="' . date('Y/m/d', strtotime( $start_date ) ) . ' - ' . date('Y/m/d', strtotime( $end_date ) ) . '">' . date('Y/m/d', strtotime( $start_date ) ) . ' - ' . date('Y/m/d', strtotime( $end_date ) ) . '</abbr>' : '';
                break;

            case 'donation_end_date' :
                $donation_end_date = get_post_meta( $post_id, '_cp_donation_end_date', true );
                echo ( $donation_end_date ) ? '<abbr title="' . date('Y/m/d', strtotime( $donation_end_date ) ) . '">' . date('Y/m/d', strtotime( $donation_end_date ) ) . '</abbr>' : '';
                break;

            case 'litter_sold' :
                $litter_sold = get_post_meta( $post_id,'_cp_total_jugs_sold', true );
                echo ( $litter_sold && !empty( $litter_sold ) ) ? number_format( $litter_sold ) : '';
                break;

        }
    }

    /**
     * @param $columns
     * @return mixed
     */
    public static function cp_donation_add_custom_columns_header( $columns )
    {
        unset( $columns['date'] );

        $columns['nomination_period'] = 'Nomination Period';
        $columns['donation_end_date'] = 'Deadline';
        $columns['litter_sold']       = 'Litter Sold';

        return $columns;
    }

    /**
     * @param $columns
     * @return mixed
     */
    public static function cp_donation_add_sortable_custom_header( $columns )
    {
        $columns['donation_end_date'] = 'Deadline';
        $columns['litter_sold']       = 'Litter Sold';

        return $columns;
    }

    /**
     * @param $query
     */
    public static function cp_donation_add_custom_orderby( $query ) {
        if ( ! is_admin() )
            return;

        $orderby = $query->get( 'orderby' );

        if( 'donation_end_date' === $orderby ) {
            $query->set( 'meta_key', '_cp_donation_end_date' );
            $query->set( 'orderby', 'meta_value' );
        } else if( 'litter_sold' === $orderby ) {
            $query->set( 'meta_key', '_cp_total_jugs_sold' );
            $query->set( 'orderby', 'meta_value' );
        }

    }
}

CP_Post_Types::init();
