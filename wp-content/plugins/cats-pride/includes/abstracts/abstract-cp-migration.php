<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Abstract CP Migration Class
 *
 * @since          1.0.4
 * @version        1.0.0
 */
abstract class CP_Migration implements CP_Migration_Interface {

    /*
     * Name of the table that stores all migrations
     */
    public $migrations_table = 'cp_migrations';

    /*
     * Indicates whether a rollback can occur or not.
     */
    public $can_rollback     = true;

    /**
     * @var $migration_version;
     */
    protected $migration_version;

    public function run()
    {
       global $wpdb;

       $wpdb->insert( $wpdb->prefix . $this->migrations_table, ['migration_version' => $this->migration_version], ['%s']);

    }

    public function rollback()
    {
        if ( $this->can_rollback === false ) {
            throw new \Exception( 'Migration ' . $this->migration_version . ' is unable to perform a rollback.' );
        }

        global $wpdb;

        $wpdb->delete( $wpdb->prefix . $this->migrations_table, ['migration_version' => $this->migration_version], ['%s']);

        delete_option( 'cp_database_version' );

    }
}
