<?php
/**
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * CP_Admin_Meta_Boxes.
 */
class CP_Admin_Meta_Boxes {

	/**
	 * Is meta boxes saved once?
	 *
	 * @var boolean
	 */
	private static $saved_meta_boxes = false;

	/**
	 * Meta box error messages.
	 *
	 * @var array
	 */
	public static $meta_box_errors  = array();

	/**
	 * Constructor.
	 */
	public function __construct() {

	    add_action( 'admin_init', array( $this, 'includes' ) );
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ), 10 );
		add_action( 'save_post', array( $this, 'save_meta_boxes' ), 1, 2 );

		add_action( 'cp_process_shelter_manager_meta', 'CP_Meta_Box_Shelter_Manager::save', 10, 2 );
        add_action( 'cp_process_donation_shelters_meta', 'CP_Meta_Box_Donation_Shelters::save', 10, 2 );

		// Error handling (for showing errors from meta boxes on next page load).
		add_action( 'admin_notices', array( $this, 'output_errors' ) );
		add_action( 'shutdown', array( $this, 'save_errors' ) );

	}

	public function includes()
    {
        include_once( dirname( __FILE__ ) . '/meta-boxes/class-cp-meta-box-shelter-manager.php');
        include_once( dirname( __FILE__ ) . '/meta-boxes/class-cp-meta-box-shelter-duplicates.php');
        include_once( dirname( __FILE__ ) . '/meta-boxes/class-cp-meta-box-shelter-logs.php');
        include_once( dirname( __FILE__ ) . '/meta-boxes/class-cp-meta-box-donation-settings.php');
        include_once( dirname( __FILE__ ) . '/meta-boxes/class-cp-meta-box-donation-shelters.php');
    }

	/**
	 * Add an error message.
	 * @param string $text
	 */
	public static function add_error( $text ) {
		self::$meta_box_errors[] = $text;
	}

	/**
	 * Save errors to an option.
	 */
	public function save_errors() {
		update_option( 'catspride_meta_box_errors', self::$meta_box_errors );
	}

	/**
	 * Show any stored error messages.
	 */
	public function output_errors() {
		$errors = array_filter( (array) get_option( 'catspride_meta_box_errors' ) );

		if ( ! empty( $errors ) ) {

			echo '<div id="catspride_errors" class="error notice is-dismissible">';

			foreach ( $errors as $error ) {
				echo '<p>' . wp_kses_post( $error ) . '</p>';
			}

			echo '</div>';

			// Clear
			delete_option( 'catspride_meta_box_errors' );
		}
	}

	/**
	 * Add Meta boxes.
	 */
	public function add_meta_boxes() {

        /*
         * cp_shelter
         */
		add_meta_box( 'catspride-shelter-manage', __( 'Shelter Manager', 'catspride' ), 'CP_Meta_Box_Shelter_Manager::output', 'cp_shelter', 'side', 'low' );
        add_meta_box( 'catspride-shelter-duplicates', __( 'Potential Duplicates', 'catspride' ), 'CP_Meta_Box_Shelter_Duplicates::output', 'cp_shelter', 'side', 'low' );
        add_meta_box( 'catspride-shelter-logs', __( 'Shelter Logs', 'catspride' ), 'CP_Meta_Box_Shelter_Logs::output', 'cp_shelter', 'normal', 'low' );

        /*
         * cp_donation
         */
        add_meta_box( 'catspride-donation-shelters', __( 'Shelters', 'catspride' ), 'CP_Meta_Box_Donation_Shelters::output', 'cp_donation', 'normal', 'low' );
        add_meta_box( 'catspride-donation-settings', __( 'Settings', 'catspride' ), 'CP_Meta_Box_Donation_Settings::output', 'cp_donation', 'side', 'low' );

    }

    /**
	 * Check if we're saving, the trigger an action based on the post type.
	 *
	 * @param  int $post_id
	 * @param  object $post
	 */
	public function save_meta_boxes( $post_id, $post ) {

		// $post_id and $post are required
		if ( empty( $post_id ) || empty( $post ) || self::$saved_meta_boxes ) {
			return;
		}

		// Don't save meta boxes for revisions or auto-saves
		if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || is_int( wp_is_post_revision( $post ) ) || is_int( wp_is_post_autosave( $post ) ) ) {
			return;
		}

		// Check the nonce
        /*
        if ( empty( $_POST['catspride_meta_nonce'] ) || ! wp_verify_nonce( $_POST['catspride_meta_nonce'], 'catspride_save_data' ) ) {
			return;
		}
        */

		// Check the post being saved == the $post_id to prevent triggering this call for other save_post events
		if ( empty( $_POST['post_ID'] ) || $_POST['post_ID'] != $post_id ) {
			return;
		}

		// Check user has permission to edit
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		self::$saved_meta_boxes = true;

		if( $post->post_type === 'cp_shelter' ) {
            do_action('cp_process_shelter_manager_meta', $post_id, $post);
        }

        if ( $post->post_type === 'cp_donation' ) {
		    do_action( 'cp_process_donation_shelters_meta', $post_id, $post );
        }

	}
}

new CP_Admin_Meta_Boxes();
