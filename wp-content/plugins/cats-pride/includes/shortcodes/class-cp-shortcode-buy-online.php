<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Buy Online Shortcode
 *
 */
class CP_Shortcode_Buy_Online {

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
        $links = [];
        $names = [];
        $product_id          = ( isset( $atts['product_id'] ) && is_numeric( $atts['product_id'] ) ) ? (int) $atts['product_id'] : null;
        $show_title          = ( isset( $atts['show_title'] ) && $atts['show_title'] === 'false') ? false : true;
        $header_column_class = ( isset( $atts['header_column_class'] ) && !empty( $atts['header_column_class'] ) ) ? $atts['header_column_class'] : 'bk-dark-blue';
        $header_class        = ( isset( $atts['header_class'] ) && !empty( $atts['header_class'] ) ) ? $atts['header_class'] : 'white';
        $button_class        = ( isset( $atts['button_class'] ) && !empty( $atts['button_class'] ) ) ? $atts['button_class'] : 'green';
        $buttons_class       = ( isset( $atts['buttons_class'] ) && !empty( $atts['buttons_class'] ) ) ? $atts['buttons_class'] : '';
        $orientation         = ( isset( $atts['orientation'] ) && !empty( $atts['orientation'] ) ) ? $atts['orientation'] : 'vertical';
        $links[0]              = ( isset( $atts['link_1'] ) && !empty( $atts['link_1'] ) ) ? $atts['link_1'] : null;
        $links[1]              = ( isset( $atts['link_2'] ) && !empty( $atts['link_2'] ) ) ? $atts['link_2'] : null;
        $links[2]              = ( isset( $atts['link_3'] ) && !empty( $atts['link_3'] ) ) ? $atts['link_3'] : null;
        $links[3]              = ( isset( $atts['link_4'] ) && !empty( $atts['link_4'] ) ) ? $atts['link_4'] : null;
        $names[0]              = ( isset( $atts['name_1'] ) && !empty( $atts['name_1'] ) ) ? $atts['name_1'] : null;
        $names[1]              = ( isset( $atts['name_2'] ) && !empty( $atts['name_2'] ) ) ? $atts['name_2'] : null;
        $names[2]              = ( isset( $atts['name_3'] ) && !empty( $atts['name_3'] ) ) ? $atts['name_3'] : null;
        $names[3]              = ( isset( $atts['name_4'] ) && !empty( $atts['name_4'] ) ) ? $atts['name_4'] : null;
        
        $purchase_links = array();

        /*
         * If this is a single product page, our buttons should use product specific URLs are set and use them if so
         */
        if (isset($links[0]) && !empty( $links[0] )) {
            for ($index = 0, $length = count($links); $index < $length; $index++) {
                if (isset($links[$index]) && !empty( $links[$index] ) && isset($names[$index]) && !empty( $names[$index] )){
                    $purchase_links[ $names[$index] ] = array(
                        'url' => $links[$index],
                        'name' => $names[$index],
                        'display_name' => $names[$index],
                        'source' => 'default'
                    );
                }
            }
            //var_dump($purchase_links);

        } else if( is_product() || $product_id ) {

            if ( !$product_id ) {

                global $product;

                $product_id = $product->get_id();
            }

            if ( have_rows('purchase_links', $product_id) ):

                while ( have_rows('purchase_links', $product_id) ) : the_row();

                    $name = get_sub_field('name');
                    $url  = get_sub_field('url');

                    $purchase_links[ $name['value'] ] = array(
                        'url' => $url,
                        'name' => $name['value'],
                        'display_name' => $name['label'],
                        'source' => 'product'
                    );

                endwhile;

            endif;

        } else {

            if (have_rows('default_purchase_links', 'option')):

                while (have_rows('default_purchase_links', 'option')) : the_row();

                    $name = get_sub_field('name');
                    $url  = get_sub_field('url');

                    if ( !isset( $purchase_links[ $name['value'] ] ) ) {

                        $purchase_links[ $name['value'] ] = array(
                            'url' => $url,
                            'name' => $name['value'],
                            'display_name' => $name['label'],
                            'source' => 'default'
                        );

                    }

                endwhile;

            endif;

        }

        if( count( $purchase_links ) > 0 ) {

            include(CP_TEMPLATES_PATH . '/shortcodes/shortcode-buy-online.php');

        }

    }

}
