<?php
/**
 * Load assets
 *
 * @category    Admin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'CP_Admin_Assets', false ) ) :

/**
 * CP_Admin_Assets Class.
 */
class CP_Admin_Assets {

	/**
	 * Hook in tabs.
	 */
	public function __construct() {
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_styles' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
    }

	/**
	 * Enqueue styles.
	 */
	public function admin_styles() {

		$screen         = get_current_screen();
		$screen_id      = $screen ? $screen->id : '';

		// Register admin styles
        wp_register_style( 'cp_bootstrap_grid', CP()->plugin_url() . '/assets/css/bootstrap-grid.min.css', array(), CP_VERSION );
        wp_register_style( 'data-tables', CP()->plugin_url() . '/assets/vendor/DataTables/datatables.min.css', array(), CP_VERSION );
        wp_register_style( 'cp_admin_styles', CP()->plugin_url() . '/assets/css/admin.css', array(), CP_VERSION );

		if ( in_array( $screen_id, array( 'toplevel_page_cp-admin-page-reporting', 'cp_donation' ) ) ) {
            wp_enqueue_style( 'cp_bootstrap_grid' );
		}

		if ( $screen_id === 'cp_donation' ) {
            wp_enqueue_style( 'data-tables' );
            wp_register_style( 'jquery-ui', 'https://code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css' );
            wp_enqueue_style( 'jquery-ui' );
        }

        wp_enqueue_style( 'cp_admin_styles' );
	}

    /**
     * Enqueue scripts.
     */
    public function admin_scripts() {

        global $post_id;

        $screen       = get_current_screen();
        $screen_id    = $screen ? $screen->id : '';
        $suffix       = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

        wp_register_script( 'numeral', CP()->plugin_url() . '/assets/vendor/numeral/numeral' . $suffix . '.js', array(), CP_VERSION );
        wp_register_script( 'data-tables', CP()->plugin_url() . '/assets/vendor/DataTables/datatables' . $suffix . '.js', array( 'jquery' ), CP_VERSION );
        wp_register_script( 'jquery-tiptip', CP()->plugin_url() . '/assets/vendor/jquery-tiptip/jquery.tipTip' . $suffix . '.js', array( 'jquery' ), CP_VERSION, true );
        wp_register_script( 'cp-admin-donations', CP()->plugin_url() . '/assets/js/admin/cp-admin-donations' . $suffix . '.js', array( 'jquery' ), CP_VERSION );
        wp_localize_script( 'cp-admin-donations', 'cp_donations_params', array(
            'ajax_url'                       => admin_url( 'admin-ajax.php' ),
            'search_donation_shelters_nonce' => wp_create_nonce( 'search-donation-shelters' ),
            'post_id'                        => $post_id
        ) );

        if ( $screen_id === 'cp_donation' ) {
            wp_enqueue_script( 'numeral' );
            wp_enqueue_script( 'cp-admin-donations' );
            wp_enqueue_script( 'data-tables' );
            wp_enqueue_script( 'jquery-ui-datepicker' );
            wp_enqueue_script( 'jquery-tiptip' );
        }

    }

}

endif;

return new CP_Admin_Assets();