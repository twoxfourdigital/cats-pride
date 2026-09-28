<?php

/**
 * Cat's Pride Admin
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * CP_Admin class.
 */
class CP_Admin
{

    /**
     * Constructor.
     */
    public function __construct()
    {
        add_action( 'init', array( $this, 'includes' ) );
        add_action( 'current_screen', array( $this, 'conditional_includes' ) );

        /*
         * - Update the duplicate shelter flags
         *
         * To perform an update of all shelter duplicate status, pass the variable: 'update_shelter_duplicate_check'
         * through any admin URL. If 'post' is set to to a valid shelter, it will update only those in the same state
         * as the provided post.
         *
         * - Reset shelter nominations
         *
         * This will set any shelter nominations currently set at active_end = null, to an end date/time of NOW().
         */
        add_action( 'admin_init', function() {
           if ( isset( $_GET['update_shelter_duplicate_check'] ) ) {
                if ( isset( $_GET['post'] ) ) {
                    cp_update_duplicate_shelter_flags( $_GET['post'] );
                } else {
                    cp_update_duplicate_shelter_flags();
                }
           }
            if ( isset( $_GET['reset_shelter_nominations'] ) ) {
                if ( isset( $_GET['post'] ) ) {
                    cp_reset_shelter_nominations( $_GET['post'] );
                } else {
                    cp_reset_shelter_nominations();
                }
            }
        });

    }

    /**
     * Include admin files conditionally.
     */
    public function conditional_includes() {
        if ( ! $screen = get_current_screen() ) {
            return;
        }

        switch ( $screen->id ) {
            case 'dashboard' :
                include( 'class-cp-admin-dashboard.php' );
                break;
        }
    }

    /**
     *
     */
    public function includes()
    {
        include_once( dirname( __FILE__ ) . '/class-cp-admin-assets.php' );
        include_once( dirname( __FILE__ ) . '/class-cp-admin-post-types.php' );
        include_once( dirname( __FILE__ ) . '/class-cp-admin-users.php' );
        include_once( dirname( __FILE__ ) . '/class-cp-admin-reports.php' );

    }

}

return new CP_Admin();