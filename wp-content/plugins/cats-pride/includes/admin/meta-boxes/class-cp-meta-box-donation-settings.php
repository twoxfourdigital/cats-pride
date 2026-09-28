<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * CP_Meta_Box_Donation_Settings Class.
 */
class CP_Meta_Box_Donation_Settings {

    /**
     * Output the metabox.
     *
     * @param WP_Post $post
     */
    public static function output( $post ) {

        include( 'views/html-donation-settings.php' );
        
    }

    /**
     * Save meta box data.
     *
     * @param int $post_id
     * @param $post
     */
    public static function save( $post_id, $post ) {
    }

}
