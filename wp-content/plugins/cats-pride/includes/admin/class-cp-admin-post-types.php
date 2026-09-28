<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'CP_Admin_Post_Types', false ) ) :

    /**
     * CP_Admin_Post_Types Class.
     *
     * Handles the edit posts views and some functionality on the edit post screen for CP post types.
     *
     */
    class CP_Admin_Post_Types {

        /**
         * Constructor.
         */
        public function __construct() {
     
            include_once( dirname( __FILE__ ) . '/class-cp-admin-meta-boxes.php' );

        }
        
    }

endif;

new CP_Admin_Post_Types();
