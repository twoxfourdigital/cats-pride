<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Find a Store Shortcode
 *
 */
class CP_Shortcode_Lity {

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
      $url             = ( isset( $atts['url'] ) )            ? $atts['url'] : null;
      $poster          = ( isset( $atts['poster'] ))          ? $atts['poster'] : null;
      $poster_alt      = ( isset( $atts['poster_alt'] )) ? $atts['poster_alt'] : '';
      $play_button     = ( isset( $atts['play_button'] ) && $atts['play_button'] === 'false') ? false : true;

      include ( CP_TEMPLATES_PATH . '/shortcodes/shortcode-lity.php');
  }
}
