<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Store Locator Shortcode
 *
 */
class CP_Shortcode_Store_Locator {

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
        /*
         * The form submission is handled by class-cp-form-handler.php. If there are any stores, it will set them
         * in the $GLOBALS['cp_sl_stores'] variable.
         */
        $stores   = ( isset( $GLOBALS['cp_sl_stores'] ) && count($GLOBALS['cp_sl_stores']) > 0 ) ? $GLOBALS['cp_sl_stores'] : false;
        $items    = cp_get_store_locator_products();
        $item_id  = ( isset( $_POST['item_id'] ) ) ? esc_attr( $_POST['item_id'] ) : ( ( isset( $_GET['item_id'] ) ) ? esc_attr( $_GET['item_id'] ) : '' );
        $zip_code = ( isset( $_POST['zip_code'] ) ) ? esc_attr( $_POST['zip_code'] ) : ( ( isset( $_GET['zip_code'] ) ) ? esc_attr( $_GET['zip_code'] ) : '' );
        $response = ( isset( $GLOBALS['cp_sl_xml_response'] ) ) ? $GLOBALS['cp_sl_xml_response'] : '';

        include ( CP_TEMPLATES_PATH . '/shortcodes/shortcode-store-locator.php');

    }

}
