<?php
/**
 * Plugin Name: Cat's Pride
 * Plugin URI: https://www.futuramicmedia.com/
 * Description: Adds in shelter functionality and additional customizations.
 * Version: 1.0.7
 * Author: Futuramic Media
 * Author URI: https://futuramicmedia.com
 *
 * Text Domain: catspride
 * Domain Path: /i18n/languages/
 *
 * @package CP
 * @category Core
 * @author Futuramic Media
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

if ( ! class_exists( 'CatsPride' ) ) :

    /**
     * Main CatsPride Class.
     *
     * @class CatsPride
     */
    final class CatsPride {

        /**
         * CatsPride version.
         *
         * @var string
         */
        public $version = '1.0.8';

        /**
         * Should the user have to confirm logout?
         *
         * @var bool
         */
        private $confirm_logout = false;

        /**
         * The single instance of the class.
         *
         * @var CatsPride
         */
        protected static $_instance = null;
        
        /**
         * Main CatsPride Instance.
         *
         * Ensures only one instance of CatsPride is loaded or can be loaded.
         *
         * @static
         * @see CP()
         * @return CatsPride - Main instance.
         */
        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }

        /**
         * Cloning is forbidden.
         */
        public function __clone() {
            CP_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'catspride' ), '1.0' );
        }

        /**
         * Unserializing instances of this class is forbidden.
         */
        public function __wakeup() {
            CP_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'catspride' ), '1.0' );
        }

        /**
         * CatsPride Constructor.
         */
        public function __construct() {

            $this->define_constants();
            $this->includes();
            $this->init_hooks();

            register_activation_hook( __FILE__, array( $this, 'on_plugin_activation' ) );

            do_action( 'cp_loaded' );
        }

        /**
         * When the plugin is activated, perform the included tasks.
         */
        public function on_plugin_activation() {

            $this->on_activation_add_role();
            $this->on_activation_set_database_version();

        }

        /**
         * Let's set out database version for the plugin
         */
        private function on_activation_set_database_version()
        {
            $db_version = get_option( 'cp_database_version', null );

            if ( $db_version === null ) {
                add_option( 'cp_database_version', $this->version );
            }

        }

        /**
         *
         */
        private function on_activation_add_role() {

            $role = add_role( 'shelter_manager', 'Shelter Manager', array(
                'read' => true,
                'level_0' => true
            ) );

            if( $role ) {
                // Edit shelter settings
                $role->add_cap( 'manage_shelter', true );
                // View shelter resource page
                $role->add_cap( 'read_shelter', true );
            }
        }

        /**
         * Hook into actions and filters.
         */
        private function init_hooks() {

            add_action( 'init', array( $this, 'init' ), 0 );
            add_action( 'template_redirect', array( $this, 'check_permissions' ) );

            if( $this->confirm_logout === false) {
                add_action( 'template_redirect', array( $this, 'bypass_logout_confirmation' ) );
            }

            add_filter( 'woocommerce_login_redirect', array( $this, 'login_redirect' ), 10, 2 );

            // We want to store the output of the wpf plugin and save it for output via shortcode
            add_filter('the_content', array($this, 'handle_wpf_content'), 21, 1);

            add_action( 'init', array( 'CP_Shortcodes', 'init' ) );

            // Run after WooCommerce is loaded up
            add_action( 'woocommerce_loaded', [$this, 'after_woocommerce_loaded'], 10 );

        }

        public function after_woocommerce_loaded() {
            // We want the notices to display lower on the page
            remove_action( 'woocommerce_account_content', 'woocommerce_output_all_notices', 5 );
        }

        /**
         * Define CP Constants.
         */
        private function define_constants() {
            $upload_dir = wp_upload_dir();

            $this->define( 'CP_PLUGIN_FILE', __FILE__ );
            $this->define( 'CP_ABSPATH', dirname( __FILE__ ) . '/' );
            $this->define( 'CP_TEMPLATES_PATH', dirname( __FILE__ ) . '/templates' );
            $this->define( 'CP_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
            $this->define( 'CP_VERSION', $this->version );
            $this->define( 'CP_DELIMITER', '|' );
            $this->define( 'CP_LOG_DIR', $upload_dir['basedir'] . '/cp-logs/' );
            $this->define( 'CP_TOKEN_SALT', 't3XzfYBeFWVwFoTMZpRicRFh' );
        }

        /**
         * Define constant if not already set.
         *
         * @param  string $name
         * @param  string|bool $value
         */
        private function define( $name, $value ) {
            if ( ! defined( $name ) ) {
                define( $name, $value );
            }
        }

        /**
         * What type of request is this?
         *
         * @param  string $type admin, ajax, cron or frontend.
         * @return bool
         */
        private function is_request( $type ) {
            switch ( $type ) {
                case 'admin' :
                    return is_admin();
                case 'ajax' :
                    return defined( 'DOING_AJAX' );
                case 'cron' :
                    return defined( 'DOING_CRON' );
                case 'frontend' :
                    return ( ! is_admin() || defined( 'DOING_AJAX' ) ) && ! defined( 'DOING_CRON' );
            }
        }

        /**
         * Include required core files used in admin and on the frontend.
         */
        public function includes() {
            /**
             * Class autoloader.
             */
            include_once( CP_ABSPATH . 'includes/class-cp-autoloader.php' );

            /**
             * Interfaces.
             */
            include_once( CP_ABSPATH . 'includes/interfaces/class-cp-logger-interface.php' );
            include_once( CP_ABSPATH . 'includes/interfaces/class-cp-log-handler-interface.php' );
            include_once( CP_ABSPATH . 'includes/interfaces/class-cp-migration-interface.php' );

            /**
             * Abstract classes.
             */
            include_once( CP_ABSPATH . 'includes/abstracts/abstract-cp-log-handler.php' );
            include_once( CP_ABSPATH . 'includes/abstracts/abstract-cp-migration.php' );

            /**
             * Core classes.
             */
            include_once( CP_ABSPATH . 'includes/cp-core-functions.php' );
            include_once( CP_ABSPATH . 'includes/class-cp-post-types.php' ); // Registers post types
            include_once( CP_ABSPATH . 'includes/class-cp-ajax.php' );

            /**
             * Other misc. functions
             */
            include_once(CP_ABSPATH . 'includes/cp-location-posts-functions.php' );

            if ( $this->is_request( 'admin' ) ) {
                include_once( CP_ABSPATH . 'includes/admin/class-cp-admin.php' );
                include_once( CP_ABSPATH . 'includes/class-cp-migrations.php' );
            }



            if ( $this->is_request( 'frontend' ) ) {

                $this->frontend_includes();

            } else {

                /**
                 * We want to ensure that a session is made available in the back-end as well. We will use the
                 * existing classes in WooCommerce to achieve this.
                 */
                include_once WP_PLUGIN_DIR . '/woocommerce/includes/abstracts/abstract-wc-session.php';
                include_once WP_PLUGIN_DIR . '/woocommerce/includes/class-wc-session-handler.php';

            }

        }

        /**
         * Include required frontend files.
         */
        public function frontend_includes() {
            include_once( CP_ABSPATH . 'includes/class-cp-frontend-scripts.php' );
            include_once( CP_ABSPATH . 'includes/class-cp-form-handler.php' );
            include_once( CP_ABSPATH . 'includes/class-cp-shortcodes.php' );
        }

        /**
         * Init CatsPride when WordPress Initializes.
         */
        public function init() {

            // Before init action.
            do_action( 'before_catspride_init' );

            // Set up localisation.
            $this->load_plugin_textdomain();


            if ( !$this->is_request( 'frontend' ) ) {
                // We want to make the session available on the backend as well for error notices, etc.
                $session_class = apply_filters('woocommerce_session_handler', 'WC_Session_Handler');
                wc()->session = new $session_class();
                wc()->session->init();

            }

            /**
             * If this is a product page, and the incentivized URL parameter is set, then we want to include the
             * alternate JavaScript that allows us to display our own buttons and includes any necessary flags
             * to mark the review as being incentivized.
             */
            if ( isset( $_REQUEST['cp_bv_incentivize'] ) ) {
                cp_setcookie( 'cp_bv_incentivize', date('Y-m-d'), time() + 7 * DAY_IN_SECONDS );
            }

            // Init action.
            do_action( 'catspride_init' );
        }

        /**
         * Load Localisation files.
         *
         * Note: the first-loaded translation file overrides any following ones if the same translation is present.
         *
         * Locales found in:
         *      - WP_LANG_DIR/catspride/catspride-LOCALE.mo
         *      - WP_LANG_DIR/plugins/catspride-LOCALE.mo
         */
        public function load_plugin_textdomain() {
            $locale = is_admin() && function_exists( 'get_user_locale' ) ? get_user_locale() : get_locale();
            $locale = apply_filters( 'plugin_locale', $locale, 'catspride' );

            unload_textdomain( 'catspride' );
            load_textdomain( 'catspride', WP_LANG_DIR . '/catspride/catspride-' . $locale . '.mo' );
            load_plugin_textdomain( 'catspride', false, plugin_basename( dirname( __FILE__ ) ) . '/i18n/languages' );
        }

        /**
         * Check the user's permissions if they are attempting to visit a shelter manager type of page
         */
        public function check_permissions() {
            // Check for permissions if attempt is being made to visit a shelter manager page
            if ( cp_is_endpoint('shelter-resources')
                || cp_is_endpoint( 'edit-shelter' )
                || cp_is_endpoint( 'optout-shelter' ) ) {

                $user = wp_get_current_user();

                // If they don't have the ability to manage a shelter or they don't have a shelter ID set, redirect.
                if( ! $user || ! in_array( 'shelter_manager', (array) $user->roles )
                    || get_user_meta( $user->ID, '_cp_manage_shelter_id', true ) === '' ) {
                    wp_redirect( wc_get_page_permalink( 'myaccount' ) );
                }
            }
        }

        /**
         * Store the contents of the WPF plugin for display
         *
         * @param $content
         * @return mixed
         */
        function handle_wpf_content( $content )
        {
            if ( !empty( $content ) ) {
                $GLOBALS['wpf_content'] = $content;
            }

            return $content;
        }

        /**
         * If the user is a shelter manager, redirect them to the shelter resources page.
         *
         * @param string $redirect_to URL to redirect to.
         * @param object $user Logged user's data.
         * @return string
         */
        function login_redirect( $redirect_to, $user ) {

            // Clear out query params associated with the login form actions if the user just verified their email
            $redirect_to = remove_query_arg( array( 'tab', 'cp_et' ), $redirect_to);

            if ( isset( $user->roles ) && is_array( $user->roles ) ) {

                // Re-direct them to the shelter resources page if they are a shelter manager and are assigned a shelter
                if ( in_array( 'shelter_manager', $user->roles )
                    && get_user_meta( $user->ID, '_cp_manage_shelter_id', true ) !== '' ) {

                    $redirect_to = wc_get_page_permalink( 'myaccount' ) . wc_get_endpoint_url('shelter-resources' );

                }
            }

            return $redirect_to;
        }

        /**
         * Bypass logout confirmation.
         */
        function bypass_logout_confirmation() {
            global $wp;

            if ( isset( $wp->query_vars['customer-logout'] ) ) {
                wp_redirect( str_replace( '&amp;', '&', wp_logout_url( wc_get_page_permalink( 'myaccount' ) ) ) );
                exit;
            }
        }

        /**
         * Get the plugin url.
         * @return string
         */
        public function plugin_url() {
            return untrailingslashit( plugins_url( '/', __FILE__ ) );
        }

        /**
         * Get the plugin path.
         * @return string
         */
        public function plugin_path() {
            return untrailingslashit( plugin_dir_path( __FILE__ ) );
        }
        
        /**
         * Get Ajax URL.
         * @return string
         */
        public function ajax_url() {
            return admin_url( 'admin-ajax.php', 'relative' );
        }

    }

endif;

/**
 * Main instance of CatsPride.
 *
 * Returns the main instance of CP to prevent the need to use globals.
 *
 * @return CatsPride
 */
function CP() {
    return CatsPride::instance();
}

// Global for backwards compatibility.
$GLOBALS['CatsPride'] = CP();
