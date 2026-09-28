<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * CP_Meta_Box_Shelter_Logs Class.
 */
class CP_Meta_Box_Shelter_Logs {

    /**
     * Output the metabox.
     *
     * @param WP_Post $post
     */
    public static function output( $post ) {

        $shelter_logs = cp_get_logs( null, 'cp_shelter', $post->ID );

        include( 'views/html-shelter-logs.php' );
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
