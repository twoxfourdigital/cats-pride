<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Store Locator Shortcode
 *
 */
class CP_Shortcode_Marketing_Opt_In {

	/**
	 * Get the shortcode content.
	 *
	 * @param array $atts
	 * @return string
	 */
	public static function get( $atts ) {
		return CP_Shortcodes::shortcode_wrapper( array( __CLASS__, 'output' ), $atts );
	}

	/**
	 * Output the shortcode.
	 *
	 * @param array $atts
	 */
	public static function output( $atts )
    {
        $submitted = ( isset( $_POST[ 'marketing_opt_in' ] ) && $_POST[ 'marketing_opt_in' ] === 'success');

        include ( CP_TEMPLATES_PATH . '/shortcodes/shortcode-marketing-opt-in.php');
    }

}