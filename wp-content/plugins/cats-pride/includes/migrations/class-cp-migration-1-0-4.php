<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}


class CP_Migration_1_0_4 extends CP_Migration {

    protected $migration_version = '1.0.4';

    /**
     * Extract the nominations from the usermeta and place them in their own table for easier reporting and historical
     * tracking purposes.
     */
    public function run()
    {

        global $wpdb;

        $collate = '';

        if ( $wpdb->has_cap( 'collation' ) ) {
            $collate = $wpdb->get_charset_collate();
        }

        $wpdb->query('START TRANSACTION');

        /*
         * Create the migrations table
         */
        $result_1 = $wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}cp_migrations (
            id INT PRIMARY KEY AUTO_INCREMENT,
            migration_version VARCHAR(20) NOT NULL,
            migration_completed TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        ) {$collate};");

        /*
         * Create the nominations table
         */
        $result_2 = $wpdb->query("CREATE TABLE IF NOT EXISTS {$wpdb->prefix}cp_nominations (
            id INT PRIMARY KEY AUTO_INCREMENT,
            shelter_post_id INT NOT NULL,
            user_id INT NOT NULL,
            bonus_code VARCHAR(45) DEFAULT NULL,
            bonus_multiple SMALLINT(5) DEFAULT NULL,
            bonus_first_entered DATETIME DEFAULT NULL,
            active_start TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            active_end DATETIME DEFAULT NULL
        ) {$collate};");

        if ( $result_1 === true && $result_2 === true ) {

            /*
             * Retrieve all of the current nominations
             */
            $result_3 = $wpdb->query(
                "INSERT INTO {$wpdb->prefix}cp_nominations (user_id, shelter_post_id, bonus_code, bonus_multiple, bonus_first_entered)
                 SELECT um1.user_id as user_id, 
                        um1.meta_value as shelter_post_id,
                        um2.meta_value as bonus_code,
                        um3.meta_value as bonus_multiple,
                        um4.meta_value as bonus_first_entered
                 FROM {$wpdb->usermeta} um1
                 LEFT JOIN {$wpdb->usermeta} um2 ON (um1.user_id = um2.user_id AND um2.meta_key = '_cp_nominate_shelter_bonus_code')
                 LEFT JOIN {$wpdb->usermeta} um3 ON (um1.user_id = um3.user_id AND um3.meta_key = '_cp_nominate_shelter_bonus_multiple')
                 LEFT JOIN {$wpdb->usermeta} um4 ON (um1.user_id = um4.user_id AND um4.meta_key = '_cp_nominate_shelter_bonus_entered')
                 WHERE um1.meta_key = '_cp_nominate_shelter_id';"
            );

            if ($result_3 >= 1) {

                /*
                 * Delete all the usermeta entries that pertain to shelter nominations
                 */
                $result_4 = $wpdb->query("DELETE FROM {$wpdb->usermeta} WHERE meta_key IN ('_cp_nominate_shelter_bonus_code', '_cp_nominate_shelter_bonus_multiple', '_cp_nominate_shelter_bonus_entered', '_cp_nominate_shelter_id');");


                cp_refresh_shelter_nomination_count();

            }

            $wpdb->query('COMMIT');

        } else {

            $wpdb->query('ROLLBACK');

        }

        // Store the migration run to the migrations table
        parent::run();

    }

    /**
     * Rollback the execution of this migration
     */
    public function rollback()
    {
        global $wpdb;

        $nominations = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}cp_nominations WHERE active_end IS NULL" );

        if ( $nominations ) {

            foreach ($nominations as $nomination) {

                $wpdb->insert( $wpdb->usermeta, [
                    'user_id' => $nomination->user_id,
                    'meta_key' => '_cp_nominate_shelter_id',
                    'meta_value' => $nomination->shelter_post_id
                ], ['%d', '%s', '%s']);

                if ( $nomination->bonus_code ) {

                    $wpdb->insert( $wpdb->usermeta, [
                        'user_id' => $nomination->user_id,
                        'meta_key' => '_cp_nominate_shelter_bonus_code',
                        'meta_value' => $nomination->bonus_code
                    ], ['%d', '%s', '%s']);

                    $wpdb->insert( $wpdb->usermeta, [
                        'user_id' => $nomination->user_id,
                        'meta_key' => '_cp_nominate_shelter_bonus_multiple',
                        'meta_value' => $nomination->bonus_multiple
                    ], ['%d', '%s', '%s']);

                    $wpdb->insert( $wpdb->usermeta, [
                        'user_id' => $nomination->user_id,
                        'meta_key' => '_cp_nominate_shelter_bonus_entered',
                        'meta_value' => $nomination->bonus_first_entered
                    ], ['%d', '%s', '%s']);

                }

            }

        }

        $wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}cp_migrations" );
        $wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}cp_nominations" );

        // We are adding the migrations table in this migration, so we will be dropping it on rollback...
        // parent::rollback();

    }

}



