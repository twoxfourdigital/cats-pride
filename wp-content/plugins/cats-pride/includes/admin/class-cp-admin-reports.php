<?php

/**
 * Cat's Pride Admin Reports
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * CP_Admin_Reports class.
 */
class CP_Admin_Reports
{
    protected $reports = array();

    /**
     * Constructor.
     */
    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'add_admin_menu_items' ) );

        $this->reports = array(
            'shelter_nomination_export' => [ 'title' => 'Shelter Nomination Export', 'callback' => array( $this, 'shelter_nomination_export') ],
            'shelter_registration_log_export' => [ 'title' => 'Shelter Registration Log Export', 'callback' => array( $this, 'shelter_registration_log_export') ],
            'shelter_export' => [ 'title' => 'Shelter Export' ],
            'user_export' => [ 'title' => 'User Export' ]
        );

        if ( $this->reports && count( $this->reports ) > 0 ) {

            foreach ( $this->reports as $report ) {
                if (isset($report['callback'])) {
                    add_action( 'wp_loaded', $report['callback'] );
                }
            }

        }
        // We want to be able to use the notices for any error reporting needed in the reports
        require_once( WP_PLUGIN_DIR  . '/woocommerce/includes/wc-notice-functions.php');

    }

    /**
     * Add new admin pages
     */
    public function add_admin_menu_items()
    {
        add_menu_page( 'Reports', 'Reports', 'manage_options', 'cp-admin-page-reporting', array( $this, 'show_reporting_page' ), 'dashicons-chart-line', 6  );
    }

    /**
     * Display reporting selection page
     */
    public function show_reporting_page()
    {
        $reports = $this->reports;

        include_once( dirname( __FILE__ ) . '/pages/reporting-admin-page.php' );
    }

    /**
     *
     */
    public function shelter_nomination_export()
    {
        if ( 'POST' !== strtoupper( $_SERVER['REQUEST_METHOD'] ) ) {
            return;
        }

        if ( empty( $_POST['action'] ) || 'report_' . __FUNCTION__ !== $_POST['action'] || empty( $_POST['_wpnonce'] ) || ! wp_verify_nonce( $_POST['_wpnonce'], __FUNCTION__ ) ) {
            return;
        }

        $migration = cp_get_migration_by_version( '1.0.4' );

        if ( $migration && date('Y-m-d', strtotime( $_POST['shelter_nomination_export_start_date'] ) ) < date( 'Y-m-d', strtotime( $migration->migration_completed ) ) ) {
            wc_add_notice( 'Your selected start date is too early. We were not tracking nominations by date prior to: ' . date( 'm/d/Y', strtotime( $migration->migration_completed ) ) );
            return;
        }

        global $wpdb;

        $query = "SELECT p.ID as shelter_post_id, 
                         p.post_title as shelter_name,
                         pm1.meta_value as shelter_address_1,
                         pm2.meta_value as shelter_address_2,
                         pm3.meta_value as shelter_address_city,
                         pm4.meta_value as shelter_address_state,
                         pm5.meta_value as shelter_address_zip_code,
                         pm6.meta_value as shelter_contact_name,
                         pm7.meta_value as shelter_contact_email,
                         pm8.meta_value as shelter_contact_phone,
                         SUM(COALESCE(n.bonus_multiple, 1)) as total_nominations
                  FROM {$wpdb->prefix}cp_nominations n
                  INNER JOIN {$wpdb->posts} p ON (p.ID = n.shelter_post_id AND p.post_type = 'cp_shelter')
                  LEFT JOIN {$wpdb->postmeta} pm1 ON (p.ID = pm1.post_id AND pm1.meta_key = 'address_1')
                  LEFT JOIN {$wpdb->postmeta} pm2 ON (p.ID = pm2.post_id AND pm2.meta_key = 'address_2')
                  LEFT JOIN {$wpdb->postmeta} pm3 ON (p.ID = pm3.post_id AND pm3.meta_key = 'city')
                  LEFT JOIN {$wpdb->postmeta} pm4 ON (p.ID = pm4.post_id AND pm4.meta_key = 'state')
                  LEFT JOIN {$wpdb->postmeta} pm5 ON (p.ID = pm5.post_id AND pm5.meta_key = 'zip_code')
                  LEFT JOIN {$wpdb->postmeta} pm6 ON (p.ID = pm6.post_id AND pm6.meta_key = 'name')
                  LEFT JOIN {$wpdb->postmeta} pm7 ON (p.ID = pm7.post_id AND pm7.meta_key = 'email')
                  LEFT JOIN {$wpdb->postmeta} pm8 ON (p.ID = pm8.post_id AND pm8.meta_key = 'phone')
                  WHERE DATE(n.active_start) >= %s AND DATE(n.active_start) <= %s
                        AND (n.active_end IS NULL OR DATE(n.active_end) <= %s)
                  GROUP BY n.shelter_post_id ORDER BY 11 DESC";

        $params = [
            $_POST['shelter_nomination_export_start_date'],
            $_POST['shelter_nomination_export_end_date'],
            $_POST['shelter_nomination_export_end_date']
        ];

        $results = $wpdb->get_results( $wpdb->prepare( $query, $params ), ARRAY_A );

        /**
         * @var $logger CP_Logger
         */
        $logger = cp_get_logger();
        $logger->info( 'Generating ' . __FUNCTION__ . ' report.' , array('params' => $_POST, 'result_count' => count( $results ) ) , 'reports');

        if ( $results ) {

            $this->download_as_csv( __FUNCTION__ . '_' . $_POST['shelter_nomination_export_start_date'] . '-' . $_POST['shelter_nomination_export_end_date'], $results );

        } else {

            wc_add_notice( 'No records were returned for the dates you provided. Please try a different set of dates.' );
            return;
        }

    }

    /**
     *
     */
    public function shelter_registration_log_export()
    {

        if ( 'POST' !== strtoupper( $_SERVER['REQUEST_METHOD'] ) ) {
            return;
        }

        if ( empty( $_POST['action'] ) || 'report_' . __FUNCTION__ !== $_POST['action'] || empty( $_POST['_wpnonce'] ) || ! wp_verify_nonce( $_POST['_wpnonce'], __FUNCTION__ ) ) {
            return;
        }

        $migration = cp_get_migration_by_version( '1.0.5' );

        if ( $migration && date('Y-m-d', strtotime( $_POST['shelter_registration_log_export_start_date'] ) ) < date( 'Y-m-d', strtotime( $migration->migration_completed ) ) ) {
            wc_add_notice( 'Your selected start date is too early. We were not logging messages prior to: ' . date( 'm/d/Y', strtotime( $migration->migration_completed ) ) );
            return;
        }

        global $wpdb;

        $query = "SELECT l.log_level,
                         l.log_source,
                         l.log_group,
                         l.log_message,
                         l.log_context,
                         l.log_timestamp
                  FROM {$wpdb->prefix}cp_logs l 
                  WHERE l.log_group = 'shelter_registration' 
                    AND DATE(l.log_timestamp) >= %s AND DATE(l.log_timestamp) <= %s";

        $params = [
            $_POST['shelter_registration_log_export_start_date'],
            $_POST['shelter_registration_log_export_end_date']
        ];

        $results = $wpdb->get_results( $wpdb->prepare( $query, $params ), ARRAY_A );

        /**
         * @var $logger CP_Logger
         */
        $logger = cp_get_logger();
        $logger->info( 'Generating ' . __FUNCTION__ . ' report.' , array('params' => $_POST, 'result_count' => count( $results ) ) , 'reports');

        if ( $results && count( $results ) > 0 ) {

            $this->download_as_csv( __FUNCTION__ . '_' . $_POST['shelter_registration_log_export_start_date'] . '-' . $_POST['shelter_registration_log_export_end_date'], $results );

        } else {

            wc_add_notice( 'No records were returned for the dates you provided. Please try a different set of dates.' );
            return;

        }

    }

    protected function download_as_csv( $name, $results )
    {
        $csv_output = '"'.implode('","',array_keys( $results[0] ) ).'",'."\n";;

        foreach ($results as $row) {
            $csv_output .= '"'.implode('","',$row).'",'."\n";
        }
        $csv_output .= "\n";

        $filename = sanitize_title( $name );
        header("Content-type: application/vnd.ms-excel");
        header("Content-disposition: csv" . $filename . ".csv");
        header("Content-disposition: filename=".$filename.".csv");
        print $csv_output;
        exit;

    }

}

new CP_Admin_Reports();