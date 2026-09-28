<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class CP_Migration_1_0_7 extends CP_Migration {

    protected $migration_version = '1.0.7';

    /**
     * Add in an adjusted_donation_amount column
     */
    public function run()
    {
        global $wpdb;

        $query = "ALTER TABLE {$wpdb->prefix}cp_donation_shelters ADD COLUMN `adjusted_donation_amount` FLOAT(10, 2) DEFAULT NULL AFTER `donation_amount`;";

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

        $wpdb->query( "ALTER TABLE {$wpdb->prefix}cp_donation_shelters DROP COLUMN `adjusted_donation_amount`" );

        parent::rollback();

    }

}



