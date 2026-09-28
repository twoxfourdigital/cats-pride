<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class CP_Migration_1_0_5 extends CP_Migration {

    protected $migration_version = '1.0.5';

    /**
     * Add in new event logging table for tracking throughout the site.
     */
    public function run()
    {
        global $wpdb;

        $collate = '';

        if ( $wpdb->has_cap( 'collation' ) ) {
            $collate = $wpdb->get_charset_collate();
        }

        /*
         * Create the migrations table
         */
        $wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}cp_logs (
            id BIGINT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
            object_type VARCHAR(30) DEFAULT NULL,
            object_type_id INT DEFAULT NULL,
            log_level SMALLINT(4) NOT NULL DEFAULT 100,
            log_source VARCHAR(200) NOT NULL,
            log_group VARCHAR(30) DEFAULT NULL,
            log_message LONGTEXT NOT NULL,
            log_context LONGTEXT DEFAULT NULL,
            log_timestamp DATETIME NOT NULL
        ) {$collate};");

        $wpdb->query("CREATE INDEX {$wpdb->prefix}cp_logs_object_type_object_type_id_index ON {$wpdb->prefix}cp_logs (object_type, object_type_id)");

        // Store the migration run to the migrations table
        parent::run();

    }

    /**
     * Rollback the execution of this migration
     */
    public function rollback()
    {
        global $wpdb;

        $wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}cp_logs" );

        parent::rollback();

    }

}



