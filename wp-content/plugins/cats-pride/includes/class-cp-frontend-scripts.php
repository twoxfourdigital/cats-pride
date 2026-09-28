<?php
/**
 * Handle frontend scripts
 *
 * @class       CP_Frontend_Scripts
 */

if (!defined('ABSPATH')) {
	exit;
}

/**
 * CP_Frontend_Scripts Class.
 */
class CP_Frontend_Scripts
{

	/**
	 * Contains an array of script handles registered by CP.
	 * @var array
	 */
	private static $scripts = array();

	/**
	 * Contains an array of script handles registered by CP.
	 * @var array
	 */
	private static $styles = array();

	/**
	 * Contains an array of script handles localized by CP.
	 * @var array
	 */
	private static $wp_localize_scripts = array();

	/**
	 * Hook in methods.
	 */
	public static function init()
	{
		add_action('wp_enqueue_scripts', array(__CLASS__, 'load_scripts'));
		add_action('wp_print_scripts', array(__CLASS__, 'localize_printed_scripts'), 5);
		add_action('wp_print_footer_scripts', array(__CLASS__, 'localize_printed_scripts'), 5);
	}

	/**
	 * Get styles for the frontend.
	 *
	 * @return array
	 */
	public static function get_styles()
	{
		return apply_filters('catspride_enqueue_styles', array(
			'catspride-general' => array(
				'src' => self::get_asset_url('assets/css/catspride.css'),
				'deps' => '',
				'version' => CP_VERSION,
				'media' => 'all'
			)
		));
	}

	/**
	 * Return asset URL.
	 *
	 * @param string $path
	 *
	 * @return string
	 */
	private static function get_asset_url($path)
	{
		return apply_filters('catspride_get_asset_url', plugins_url($path, CP_PLUGIN_FILE), $path);
	}

	/**
	 * Register a script for use.
	 *
	 * @uses   wp_register_script()
	 * @access private
	 * @param  string   $handle
	 * @param  string   $path
	 * @param  string[] $deps
	 * @param  string   $version
	 * @param  boolean  $in_footer
	 */
	private static function register_script($handle, $path, $deps = array('jquery'), $version = CP_VERSION, $in_footer = true)
	{
		self::$scripts[] = $handle;
		wp_register_script($handle, $path, $deps, $version, $in_footer);
	}

	/**
	 * Register and enqueue a script for use.
	 *
	 * @uses   wp_enqueue_script()
	 * @access private
	 * @param  string   $handle
	 * @param  string   $path
	 * @param  string[] $deps
	 * @param  string   $version
	 * @param  boolean  $in_footer
	 */
	private static function enqueue_script($handle, $path = '', $deps = array('jquery'), $version = CP_VERSION, $in_footer = true)
	{
		if (!in_array($handle, self::$scripts) && $path) {
			self::register_script($handle, $path, $deps, $version, $in_footer);
		}
		wp_enqueue_script($handle);
	}

	/**
	 * Register a style for use.
	 *
	 * @uses   wp_register_style()
	 * @access private
	 * @param  string   $handle
	 * @param  string   $path
	 * @param  string[] $deps
	 * @param  string   $version
	 * @param  string   $media
	 * @param  boolean  $has_rtl
	 */
	private static function register_style($handle, $path, $deps = array(), $version = CP_VERSION, $media = 'all', $has_rtl = false)
	{
		self::$styles[] = $handle;
		wp_register_style($handle, $path, $deps, $version, $media);

		if ($has_rtl) {
			wp_style_add_data($handle, 'rtl', 'replace');
		}
	}

	/**
	 * Register and enqueue a styles for use.
	 *
	 * @uses   wp_enqueue_style()
	 * @access private
	 * @param  string   $handle
	 * @param  string   $path
	 * @param  string[] $deps
	 * @param  string   $version
	 * @param  string   $media
	 * @param  boolean  $has_rtl
	 */
	private static function enqueue_style($handle, $path = '', $deps = array(), $version = CP_VERSION, $media = 'all', $has_rtl = false)
	{
		if (!in_array($handle, self::$styles) && $path) {
			self::register_style($handle, $path, $deps, $version, $media, $has_rtl);
		}
		wp_enqueue_style($handle);
	}

	/**
	 * Register all CP scripts.
	 */
	private static function register_scripts()
	{

		global $post_id;

		/**
		 * Default Bazaar Voice JavaScript. This will generate and display the Review buttons.
		 */
		//   $bazaarvoice_js_url = '//display.ugc.bazaarvoice.com/static/catspride/en_US/bvapi.js';

		// if ( isset( $_COOKIE[ 'cp_bv_incentivize' ] ) && is_product() && !empty( get_field( 'custom_review_link', $post_id ) ) ) {
		//      $bazaarvoice_js_url = '//display.ugc.bazaarvoice.com/static/catspride/shelter_donation/en_US/bvapi.js';
		//   }

		$suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';
		$register_scripts = array(
			'catspride' => array(
				'src' => self::get_asset_url('assets/js/catspride' . $suffix . '.js'),
				'deps' => array('jquery', 'jquery-lightslider'),
				'version' => CP_VERSION
			),
			'cp-edit-account' => array(
				'src' => self::get_asset_url('assets/js/cp-edit-account' . $suffix . '.js'),
				'deps' => array('jquery', 'jquery-ui-datepicker'),
				'version' => CP_VERSION
			),
			'cp-register' => array(
				'src' => self::get_asset_url('assets/js/cp-register' . $suffix . '.js'),
				'deps' => array('jquery'),
				'version' => CP_VERSION
			),
			'cp-choose-shelter' => array(
				'src' => self::get_asset_url('assets/js/cp-choose-shelter' . $suffix . '.js'),
				'deps' => array('jquery'),
				'version' => CP_VERSION
			),
			'cp-shelter-resources' => array(
				'src' => self::get_asset_url('assets/js/cp-shelter-resources' . $suffix . '.js'),
				'deps' => array('jquery', 'jquery-dropzone', 'x-site'),
				'version' => CP_VERSION
			),
			'jquery-dropzone' => array(
				'src' => self::get_asset_url('assets/vendor/jquery-dropzone/jquery.dropzone.js'),
				'deps' => array('jquery', 'catspride'),
				'version' => CP_VERSION
			),
			'jquery-lightslider' => array(
				'src' => self::get_asset_url('assets/vendor/jquery-lightslider/js/lightslider.min.js'),
				'deps' => array('jquery'),
				'version' => CP_VERSION
			),
			// 'bazaarvoice' => array(
			//     'src'     => $bazaarvoice_js_url,
			//     'deps'    => array( ),
			//     'version' => CP_VERSION
			// ),
			'cp-bazaarvoice-single-product' => array(
				'src' => self::get_asset_url('assets/js/cp-bazaarvoice-single-product' . $suffix . '.js'),
				'deps' => array(),
				'version' => CP_VERSION
			),
			'cp-bazaarvoice-our-products' => array(
				'src' => self::get_asset_url('assets/js/cp-bazaarvoice-our-products' . $suffix . '.js'),
				'deps' => array(),
				'version' => CP_VERSION
			),
		);

		foreach ($register_scripts as $name => $props) {
			self::register_script($name, $props['src'], $props['deps'], $props['version']);
		}
	}

	/**
	 * Register all CP styles.
	 */
	private static function register_styles()
	{
		$register_styles = array(
			'cp-datepicker' => array(
				'src' => 'https://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css',
				'deps' => array(),
				'version' => CP_VERSION,
				'has_rtl' => false,
			),
			'jquery-dropzone' => array(
				'src' => self::get_asset_url('assets/vendor/jquery-dropzone/jquery.dropzone.css'),
				'deps' => ['catspride-general'],
				'version' => CP_VERSION,
				'media' => 'all'
			),
			'jquery-lightslider' => array(
				'src' => self::get_asset_url('assets/vendor/jquery-lightslider/css/lightslider.min.css'),
				'deps' => ['catspride-general'],
				'version' => CP_VERSION,
				'media' => 'all'
			)
		);

		foreach ($register_styles as $name => $props) {
			self::register_style($name, $props['src'], $props['deps'], $props['version'], 'all', (isset($props['has_rtl']) ? $props['has_rtl'] : false));
		}
	}

	/**
	 * Register/queue frontend scripts.
	 */
	public static function load_scripts()
	{
		global $post;

		if (!did_action('before_catspride_init')) {
			return;
		}

		self::register_scripts();
		self::register_styles();

		// Global frontend scripts
		self::enqueue_script('catspride');

		// Edit account page scripts
		if (is_edit_account_page()) {
			self::enqueue_script('cp-edit-account');
			self::enqueue_script('jquery-ui-datepicker');
			self::enqueue_style('cp-datepicker');
		}

		// Shelter resources page
		if (cp_is_endpoint('shelter-resources')) {
			self::enqueue_script('cp-shelter-resources');
			self::enqueue_script('jquery-dropzone');
			self::enqueue_style('jquery-dropzone');
		}

		if (is_account_page()) {
			self::enqueue_script('cp-register');
		}

		if (isset($post) && $post->post_type === 'cp_shelter') {
			self::enqueue_script('jquery-lightslider');
			self::enqueue_style('jquery-lightslider');
		}

		if (cp_is_endpoint('choose-shelter') || cp_is_endpoint('nominate-shelter')) {
			self::enqueue_script('cp-choose-shelter');
		}

		// If this is a front-end request, we need to include the BV scripts
		// if( !is_admin() ) {
		//     self::enqueue_script( 'bazaarvoice' );
		//     self::localize_script( 'cp-bazaarvoice-our-products' );
		//     self::enqueue_script( 'cp-bazaarvoice-our-products' );
		// }

		// Add in BazaarVoice scripts if shop or product page
		if (is_product()) {
			self::localize_script('cp-bazaarvoice-single-product');
			self::enqueue_script('cp-bazaarvoice-single-product');
		}

		// CSS Styles
		if ($enqueue_styles = self::get_styles()) {
			foreach ($enqueue_styles as $handle => $args) {
				self::enqueue_style($handle, $args['src'], $args['deps'], $args['version'], $args['media'], (isset($args['has_rtl']) ? $args['has_rtl'] : false));
			}
		}
	}

	/**
	 * Localize a CP script once.
	 * @access private
	 * @since  2.3.0 this needs less wp_script_is() calls due to https://core.trac.wordpress.org/ticket/28404 being added in WP 4.0.
	 * @param  string $handle
	 */
	private static function localize_script($handle)
	{
		if (!in_array($handle, self::$wp_localize_scripts) && wp_script_is($handle) && ($data = self::get_script_data($handle))) {
			$name = str_replace('-', '_', $handle) . '_params';
			self::$wp_localize_scripts[] = $handle;
			wp_localize_script($handle, $name, apply_filters($name, $data));
		}
	}

	/**
	 * Return data for script handles.
	 * @access private
	 * @param  string $handle
	 * @return array|bool
	 */
	private static function get_script_data($handle)
	{
		global $wp, $product;
		
		if ( ! is_object( $product ) ) {
			$product_object = is_string( $product ) ? get_page_by_path( $product, OBJECT, 'product' ) : null;
			if ( $product_object ) {
				$product = wc_get_product( $product_object->ID );
			} else {
				$product = wc_get_product( get_the_ID() );
			}
		}

		switch ($handle) {
			case 'catspride':
				return array(
					'ajax_url' => CP()->ajax_url(),
					'_wpnonce' => wp_create_nonce('catspride-ajax')
				);
				break;
			case 'cp-bazaarvoice-single-product':
				return array(
					'product_id' => get_field('bazaarvoice_product_id', $product->get_id(), false),
					'wc_product_id' => (int) $product->get_id()
				);
				break;
			case 'cp-bazaarvoice-our-products':
				$product_external_ids = cp_get_product_bv_ids();
				return array('products' => (is_array($product_external_ids)) ? array_values($product_external_ids) : array());
				break;
		}
		return false;
	}

	/**
	 * Localize scripts only when enqueued.
	 */
	public static function localize_printed_scripts()
	{
		foreach (self::$scripts as $handle) {
			self::localize_script($handle);
		}
	}
}

CP_Frontend_Scripts::init();
