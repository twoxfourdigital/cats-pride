<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Share Shortcode
 *
 */
class CP_Shortcode_Show_Notices {

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
        if( function_exists('wc_print_notices' ) ) {
            wc_print_notices();
        }
    }

}
