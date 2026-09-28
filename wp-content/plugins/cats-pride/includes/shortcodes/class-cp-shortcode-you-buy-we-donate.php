<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * You Buy, We Donate Shortcode
 *
 */
class CP_Shortcode_You_Buy_We_Donate {

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

        $button_class = ( isset( $atts['button_class'] ) && !empty( $atts['button_class'] ) ) ? $atts['button_class'] : '';
        $show_image   = ( isset( $atts['show_image'] ) && $atts['show_image'] === 'true') ? true : false;

        include ( CP_TEMPLATES_PATH . '/shortcodes/shortcode-you-buy-we-donate.php');

    }

}
