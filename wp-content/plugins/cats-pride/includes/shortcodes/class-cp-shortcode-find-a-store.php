<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Find a Store Shortcode
 *
 */
class CP_Shortcode_Find_A_Store {

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
        $product_id          = ( isset( $atts['product_id'] ) && is_numeric( $atts['product_id'] ) ) ? (int) $atts['product_id'] : null;
        $show_title          = ( isset( $atts['show_title'] ) && $atts['show_title'] === 'false') ? false : true;
        $header_column_class = ( isset( $atts['header_column_class'] ) && !empty( $atts['header_column_class'] ) ) ? $atts['header_column_class'] : 'bk-dark-blue';
		$header_class        = ( isset( $atts['header_class'] ) && !empty( $atts['header_class'] ) ) ? $atts['header_class'] : 'white';
        $button_class        = ( isset( $atts['button_class'] ) && !empty( $atts['button_class'] ) ) ? $atts['button_class'] : 'purple';
        $main_class          = ( isset( $atts['main_class'] ) && !empty( $atts['main_class'] ) ) ? $atts['main_class'] : '';
        $item_id             = 'ALLPROD';

        if ( is_product() || $product_id ) {

            if ( !$product_id ) {
                global $product;
                $product_id = $product->get_id();
            }

            $item_id = get_field( 'store_locator_product_id', $product_id );
            if( empty ( $item_id ) ) {
                $item_id = 'ALLPROD';
            }
        }

        include ( CP_TEMPLATES_PATH . '/shortcodes/shortcode-find-a-store.php');

    }

}
