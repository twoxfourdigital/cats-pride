<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * CP_Meta_Box_Shelter_Duplicates Class.
 */
class CP_Meta_Box_Shelter_Duplicates {

	/**
	 * Output the metabox.
	 *
	 * @param WP_Post $post
	 */
	public static function output( $post ) {

		include( 'views/html-shelter-duplicates.php' );
	}

}
