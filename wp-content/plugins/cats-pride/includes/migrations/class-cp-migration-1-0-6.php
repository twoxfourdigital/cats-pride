<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class CP_Migration_1_0_6 extends CP_Migration {

    protected $migration_version = '1.0.6';

    /**
     * Add in table to support the cp_donation post type.
     */
    public function run()
    {
        global $wpdb;

        $collate = '';

        if ( $wpdb->has_cap( 'collation' ) ) {
            $collate = $wpdb->get_charset_collate();
        }

        /*
         * Donations Statuses:
         *
         * 0 - Not Participating
         * 1 - Participating
         * 2 - Pending Shipping Address Confirmation
         * 3 - Pending Delivery
         * 4 - Completed
         *
         */

        /*
         * Create the donation shelters table
         */
        $query = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}cp_donation_shelters (
            id BIGINT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
            donation_post_id INT NOT NULL,
            shelter_post_id INT NOT NULL,
            donation_type VARCHAR(25) DEFAULT NULL,
            donation_amount FLOAT(10, 2) DEFAULT NULL,
            donation_status_id TINYINT(5) DEFAULT 0,
            date_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            date_created TIMESTAMP NOT NULL,
            UNIQUE KEY `donation_shelter_cols` (`donation_post_id`,`shelter_post_id`)
        ) {$collate};";

        $wpdb->query( $query );

        // Store the migration run to the migrations table
        parent::run();

    }

    /**
     * Rollback the execution of this migration
     */
    public function rollback()
    {
        global $wpdb;

        $wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}cp_donation_shelters" );

        parent::rollback();

    }

}



