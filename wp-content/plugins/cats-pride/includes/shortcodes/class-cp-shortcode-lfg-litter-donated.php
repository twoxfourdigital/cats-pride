<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * LFG Litter Donated Shortcode
 *
 */
class CP_Shortcode_Lfg_Litter_Donated {

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

        $values  = self::get_shortcode_values();

        $update       = ( isset( $atts['update'] ) && $atts['update'] === false ) ? false : true;
        $refresh_rate = ( isset( $atts['refresh'] ) && is_numeric($atts['refresh'] ) ) ? (int) $atts['refresh'] * 1000 : 5000; // Milliseconds

        $percentage = 0;
        $percentage_remaining = 100;

        if ( $values['total_pounds'] > 0 ) {
            $percentage = (int) ( ( $values['total_pounds'] / $values['total_goal'] ) * 100 );
        }

        $percentage_remaining = $percentage_remaining - $percentage;

        $html = '<div class="cp-lfg-litter-counter">';
            $html .= '<div class="cp-lfg-litter-donated-bar x-column x-3-4 x-sm">';
                $html .= '<div class="cp-lfg-litter-donated-label-wrapper">';
                    $html .= '<span class="cp-lfg-litter-donated-label">' . __( 'Pounds Donated To Date', 'catspride' ) . '</span>';
                    $html .= '<span class="cp-lfg-litter-donated-label">' . __( 'Goal', 'catspride' ) . '</span>';
                $html .= '</div>';
                $html .= '<div class="cp-lfg-litter-donated-bar-wrapper">';
                    $html .= '<div class="cp-lfg-litter-donated-bar-filled-total cp-litter-counter"';
                        $html .= ' data-cp-litter-counter-update="'  . $update . '" ';
                        $html .= ' data-cp-litter-counter-rate="'    . $values['rate'] . '" ';
                        $html .= ' data-cp-litter-counter-refresh="' . $refresh_rate . '" ';
                        $html .= ' data-cp-litter-counter-total="'   . $values['total_pounds'] . '">';
                        $html .= '<span class="cp-litter-counter-total">' . number_format( $values['total_pounds'] ) . '</span>';
                    $html .= '</div>';
                    $html .= '<span class="cp-lfg-litter-donated-bar-remaining-total">'. number_format( $values['total_goal'] ) .  '</span>';
                    $html .= '<span class="cp-lfg-litter-donated-bar-filled" style="width:' . $percentage . '%;"></span>';
                    $html .= '<span class="cp-lfg-litter-donated-bar-remaining" style="width:' . $percentage_remaining . '%;"></span>';
                $html .= '</div>';
            $html .= '</div>';
            $html .= '<div class="cp-lfg-litter-donated-info-wrapper x-column x-1-4 x-sm mobile-mtl">';
                $html .= '<div class="cp-lfg-litter-donated-stat-wrapper">';
                    $html .= '<span class="cp-lfg-litter-donated-label">' . __( 'Total Nominations', 'catspride' ) . '</span>';
                    $html .= '<span class="cp-lfg-litter-donated-stat mobile-mlm">' . number_format( $values['total_nominations'] ) .  '</span>';
                $html .= '</div>';
                $html .= '<div class="cp-lfg-litter-donated-stat-wrapper">';
                    $html .= '<span class="cp-lfg-litter-donated-label">' . __( 'Participating Shelters', 'catspride' ) . '</span>';
                    $html .= '<span class="cp-lfg-litter-donated-stat mobile-mlm">' . number_format( $values['total_shelters'] ) .  '</span>';
                $html .= '</div>';
            $html .= '</div>';
        $html .= '</div>';

        echo $html;
	}

    /**
     * @return array
     */
	public static function get_shortcode_values()
    {
        global $wpdb;

        $total_nominations = cp_get_shelter_nomination_count( null, $active_only = false);
        $total_shelters    = $wpdb->get_var( "SELECT COUNT(*) as total_shelters FROM {$wpdb->posts} WHERE post_type = 'cp_shelter' AND post_status IN ( 'publish', 'draft' )");
        $total_goal        = (int) get_field('total_litter_donated_goal', 'option' );
        $total_pounds      = (int) get_field('total_litter_donated', 'option' );
        $total_nominations = is_numeric($total_nominations) ? (int) $total_nominations : 0 ;
        $total_shelters    = is_numeric($total_shelters) ? (int) $total_shelters : 0 ;
        $pounds_since_date = get_field( 'total_litter_donated_date', 'option' );
        $rate              = (float) get_field( 'litter_rate_of_increase', 'option' );
        $seconds           = time() - strtotime( $pounds_since_date );
        $total_pounds      = round( $seconds * $rate + $total_pounds );

        return array (
            'rate'              => $rate,
            'since_date'        => date('Y-m-d 12:00:00', strtotime( $pounds_since_date ) ),
            'total_goal'        => ($total_goal) ? $total_goal : 100000000, // Default to 20MM
            'total_pounds'      => $total_pounds,
            'total_nominations' => $total_nominations,
            'total_shelters'    => $total_shelters
        );

    }
}