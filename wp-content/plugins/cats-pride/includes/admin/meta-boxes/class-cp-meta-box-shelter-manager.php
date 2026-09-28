<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * CP_Meta_Box_Shelter_Manager Class.
 */
class CP_Meta_Box_Shelter_Manager {

	/**
	 * Output the metabox.
	 *
	 * @param WP_Post $post
	 */
	public static function output( $post ) {

		include( 'views/html-shelter-manager.php' );
	}

	/**
	 * Save meta box data.
	 *
	 * @param int $post_id
	 * @param $post
	 */
	public static function save( $post_id, $post ) {

	    // Trigger email to invite shelter
        // This is already handled by cp_trigger_register_shelter_email function.

	}

}
