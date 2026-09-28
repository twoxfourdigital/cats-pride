<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * CP_Shortcodes class
 *
 * @class CP_Shortcodes
 */
class CP_Shortcodes {

	/**
	 * Init shortcodes.
	 */
	public static function init() {
		$shortcodes = array(
			'cp_litter_donated' => __CLASS__ . '::litter_donated',
            'cp_lfg_litter_donated' => __CLASS__ . '::lfg_litter_donated',
            'cp_store_locator' => __CLASS__ . '::store_locator',
            'cp_email_submission' => __CLASS__ . '::email_submission',
            'cp_buy_online' => __CLASS__ . '::buy_online',
            'cp_find_a_store' => __CLASS__ . '::find_a_store',
            'cp_you_buy_we_donate' => __CLASS__ . '::you_buy_we_donate',
            'cp_share' => __CLASS__ . '::share',
            'cp_marketing_opt_in' => __CLASS__ . '::marketing_opt_in',
            'cp_friend_share' => __CLASS__ . '::friend_share',
            'cp_show_notices' => __CLASS__ . '::show_notices',
            'cp_lity' => __CLASS__ . '::lity'
		);

		foreach ( $shortcodes as $shortcode => $function ) {
			add_shortcode( apply_filters( "{$shortcode}_shortcode_tag", $shortcode ), $function );
		}

	}

	/**
	 * Shortcode Wrapper.
	 *
	 * @param string[] $function
	 * @param array $atts (default: array())
	 * @param array $wrapper
	 *
	 * @return string
	 */
	public static function shortcode_wrapper(
		$function,
		$atts    = array(),
		$wrapper = array(
			'class'  => 'catspride',
			'before' => null,
			'after'  => null,
		)
	) {
		ob_start();

		echo empty( $wrapper['before'] ) ? '<div class="' . esc_attr( $wrapper['class'] ) . '">' : $wrapper['before'];
		call_user_func( $function, $atts );
		echo empty( $wrapper['after'] ) ? '</div>' : $wrapper['after'];

		return ob_get_clean();
	}

    /**
     * Show Notices Shortcode
     *
     * @param $atts
     * @return string
     */
    public static function show_notices( $atts ) {
        return self::shortcode_wrapper( array( 'CP_Shortcode_Show_Notices', 'output' ), $atts );
    }

    /**
     * Friend Share Shortcode
     *
     * @param $atts
     * @return string
     */
    public static function friend_share( $atts ) {
        return self::shortcode_wrapper( array( 'CP_Shortcode_Friend_Share', 'output' ), $atts );
    }

    /**
     * Marketing Opt-in Shortcode
     *
     * @param $atts
     * @return string
     */
    public static function marketing_opt_in( $atts ) {
        return self::shortcode_wrapper( array( 'CP_Shortcode_Marketing_Opt_In', 'output' ), $atts );
    }

    /**
     * Share Shortcode
     *
     * @param $atts
     * @return string
     */
    public static function share( $atts ) {
        return self::shortcode_wrapper( array( 'CP_Shortcode_Share', 'output' ), $atts );
    }

    /**
     * You Buy, We Donate Shortcode
     *
     * @param $atts
     * @return string
     */
    public static function you_buy_we_donate( $atts ) {
        return self::shortcode_wrapper( array( 'CP_Shortcode_You_Buy_We_Donate', 'output' ), $atts );
    }

    /**
     * Find a Store Shortcode
     *
     * @param $atts
     * @return string
     */
    public static function find_a_store( $atts ) {
        return self::shortcode_wrapper( array( 'CP_Shortcode_Find_A_Store', 'output' ), $atts );
    }

    /**
     * Buy Online Shortcode
     *
     * @param $atts
     * @return string
     */
    public static function buy_online( $atts ) {
        return self::shortcode_wrapper( array( 'CP_Shortcode_Buy_Online', 'output' ), $atts );
    }

    /**
     * Email Submission Shortcode
     *
     * @param $atts
     * @return string
     */
	public static function email_submission( $atts ) {
	    return self::shortcode_wrapper( array( 'CP_Shortcode_Email_Submission', 'output' ), $atts );
    }

    /**
	 * Litter Donated Shortcode
	 *
	 * @param mixed $atts
	 * @return string
	 */
	public static function litter_donated( $atts ) {
		return self::shortcode_wrapper( array( 'CP_Shortcode_Litter_Donated', 'output' ), $atts );
	}

    /**
     * LFG Litter Donated Shortcode
     *
     * @param mixed $atts
     * @return string
     */
    public static function lfg_litter_donated( $atts ) {
        return self::shortcode_wrapper( array( 'CP_Shortcode_Lfg_Litter_Donated', 'output' ), $atts );
    }

    /**
     * Store Locator Shortcode
     *
     * @param mixed $atts
     * @return string
     */
    public static function store_locator( $atts ) {
        return self::shortcode_wrapper( array( 'CP_Shortcode_Store_Locator', 'output' ), $atts );
    }

    /**
     * Lity
     *
     * @param mixed $atts
     * @return string
     */
    public static function lity( $atts ) {
        return self::shortcode_wrapper( array( 'CP_Shortcode_Lity', 'output' ), $atts );
    }
}
