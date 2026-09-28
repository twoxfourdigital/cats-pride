<?php

if (!class_exists('FM_WC_Product_Comparison')):

    /**
     * Class FM_WC_Product_Comparison
     */
    class FM_WC_Product_Comparison
    {
        /**
         * Instance of this class.
         * @var object
         */
        protected static $instance = null;

        /**
         * @return FM_WC_Product_Comparison|object
         */
        public static function get_instance()
        {
            // If the single instance hasn't been set, set it now.
            if (is_null(self::$instance)) {
                self::$instance = new self();
            }

            return self::$instance;
        }

        /**
         * FM_WC_Product_Comparison constructor.
         */
        public function __construct()
        {
            add_action('init', [$this, 'init'], 999);
            add_action( 'wp_enqueue_scripts', array( __CLASS__, 'load_scripts' ) );
        }

        /**
         *
         */
        public static function load_scripts()
        {

            if ( is_page( 'product-compare' ) || is_page( 'product-comparison' ) || is_page( 'buy-now' ) || is_post_type_archive( 'product' )) {

                $plugin_url = plugins_url('', FM_WC_PRODUCT_COMPARISON_FILE);

                wp_register_script('modernizr', $plugin_url . '/assets/js/modernizr.js', ['jquery'], '1.0.0', true);

                wp_register_style('fm-wc-product-comparison-css', $plugin_url . '/assets/css/fm-wc-product-comparison.css', [], '1.0.0' );
                wp_register_script('fm-wc-product-comparison-js', $plugin_url . '/assets/js/fm-wc-product-comparison.js', ['jquery', 'modernizr'], '1.0.0', true);

                wp_enqueue_style('fm-wc-product-comparison-css');

                wp_enqueue_script('modernizr');
                wp_enqueue_script('fm-wc-product-comparison-js');

            }
        }

        /**
         *
         */
        public function init()
        {
            add_shortcode( 'fm_wc_product_comparison', [ $this, 'shortcode_product_comparison' ] );
        }

        /**
         * @param $atts
         * @return string
         */
        public function shortcode_product_comparison( $atts ) {

            $atts = shortcode_atts( array(
                'include' => '',
                'limit' => -1,
                'products' => null,
                'navigation' => 'yes',
                'type' => 'full'
            ), $atts, 'fm_wc_product_comparison' );

            ob_start();

            require( FM_WC_PRODUCT_COMPARISON_DIR . '/includes/templates/shortcode-product-comparison.php');

            $html = ob_get_clean();

            return $html;

        }

    }

    add_action('plugins_loaded', ['FM_WC_Product_Comparison', 'get_instance']);

endif;
