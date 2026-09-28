<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Email Submission Shortcode
 *
 */
class CP_Shortcode_Email_Submission {

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
        $show_title          = ( isset( $atts['show_title'] ) && $atts['show_title'] === 'false') ? false : true;
        $show_subtitle       = ( isset( $atts['show_subtitle'] ) && $atts['show_subtitle'] === 'false') ? false : true;
        $link_id             = ( isset( $atts['link_id'] ) && !empty( $atts['link_id'] ) ) ? $atts['link_id'] : '';
				$button_class        = ( isset( $atts['button_class'] ) && !empty( $atts['button_class'] ) ) ? $atts['button_class'] : 'green-rev';

        include ( CP_TEMPLATES_PATH . '/shortcodes/shortcode-email-submission.php');

    }

}
