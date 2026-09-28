<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Litter Donated Shortcode
 *
 */
class CP_Shortcode_Litter_Donated {

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
	public static function output( $atts ) {

	    global $wp;

	    $type         = ( isset( $atts['type'] ) && $atts['type'] === 'total' ) ? $atts['type'] : 'year_to_date';
        $refresh_rate = ( isset( $atts['refresh'] ) && is_numeric($atts['refresh'] ) ) ? (int) $atts['refresh'] * 1000 : 5000; // Milliseconds
        $pre_text     = ( isset( $atts['pre_text'] ) && !empty( $atts['pre_text'] ) ) ? $atts['pre_text'] : '';
        $post_text    = ( isset( $atts['post_text'] ) && !empty( $atts['post_text'] ) ) ? $atts['post_text'] : '';
        $update       = ( isset( $atts['update'] ) && $atts['update'] === false ) ? false : true;

        if ( $type === 'year_to_date' ) {
            $sub_text = 'donated in 2018 <strong>through the Litter for Good program!</strong>';
            $font_size = 'font-size: 3.428em;';       
        } else {
            $sub_text = 'donated <strong>since 1995</strong>';
           $font_size = '';
       }

        $values  = self::get_litter_values( $type );
        $seconds = time() - strtotime( $values['since_date'] );
	    $total   = round( $seconds * $values['rate'] + $values['pounds'] );

        $html = '<div class="cp-litter-counter cp-litter-counter-' . $type . '" ' .
                'data-cp-litter-counter-type="' . $type . '" ' .
                'data-cp-litter-counter-update="' . $update . '" ' .
                'data-cp-litter-counter-rate="' . $values['rate'] . '" ' .
                'data-cp-litter-counter-refresh="' . $refresh_rate . '" ' .
                'data-cp-litter-counter-total="' . $total . '">';

        if( !empty( $pre_text ) ) {
            $html .= '<p class="cp-litter-counter-pre-text">' . $pre_text . '</p>';
        }

        $html .= '<h4 class="h-custom-headline mbn h1 man" style="' . $font_size . '";line-height:1.15em;"><span><strong class="cp-litter-counter-total">' . number_format( $total ) . '</strong> lbs</span></h4>';

        if( !empty( $post_text ) ) {
            $html .= '<p class="cp-litter-counter-post-text">' . $post_text . '</p>';
        } else {
            $html .= '<p class="cp-litter-counter-sub-text man">' . $sub_text . '</p>';
        }

        $html .= '</div>';

        echo $html;
	}

    /**
     * @param $type
     * @return array
     */
	public static function get_litter_values( $type )
    {
        if ( $type === 'year_to_date' ) {
            $pounds            = (int) get_field('litter_donated', 'option' );
            $pounds_since_date = get_field( 'litter_donated_date', 'option' );
        } else {
            $pounds            = (int) get_field('total_litter_donated', 'option' );
            $pounds_since_date = get_field( 'total_litter_donated_date', 'option' );
        }

        return array(
            'rate' => (float) get_field( 'litter_rate_of_increase', 'option' ),
            'pounds' => $pounds,
            'since_date' => date('Y-m-d 12:00:00', strtotime( $pounds_since_date ) )
        );

    }
}
