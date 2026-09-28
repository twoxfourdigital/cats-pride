<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * CP_Migrations class
 *
 * @class CP_Migrations
 */
class CP_Migrations {

    /**
     * @var mixed|void
     */
    protected $db_version;

    /*
     * Name of the table that stores all migrations
     */
    protected $migrations_table = 'cp_migrations';

    /**
     * @var array
     */
    protected $migrations;

    public function __construct() {

        $this->migrations = array(
            '1.0.4' => 'CP_Migration_1_0_4',
            '1.0.5' => 'CP_Migration_1_0_5',
            '1.0.6' => 'CP_Migration_1_0_6',
            '1.0.7' => 'CP_Migration_1_0_7'
            // Next version should be added here
        );

        $this->db_version = get_option( 'cp_database_version', null );

        /*
         * If the database version isn't set, let's see if we have any migrations and set it based on that.
         */
        if ( $this->db_version === null ) {
            
            $this->db_version = $this->get_latest_migration();
            
            if ( $this->db_version !== null ) {
                add_option( 'cp_database_version', $this->db_version );
            }
            
        }

        /*
         * Set whether or not we need migrations to be run.
         */
        $this->migration_needed = $this->is_migration_needed();

        if ( $this->migration_needed === true ) {

            if ( isset( $_GET['run_migrations'] ) && $_GET['run_migrations'] === '1'  ) {

                $this->run_migrations();

                add_action( 'admin_notices', function() {

                    ?>
                    <div class="updated is-dismissable">
                        <p><?php _e( 'Database updates have been completed. Thank you!', 'catspride' ); ?></p>
                    </div>
                    <?php

                });

            } else {

                add_action( 'admin_notices', function() {

                    ?>
                    <div class="updated">
                        <p><?php _e( 'Database updates are required. Please backup your database before updating.', 'catspride' ); ?> <a class="" href="<?php echo get_admin_url() . '?run_migrations=1'; ?>">Update Database</a></p>
                    </div>
                    <?php

                });

            }

        }

    }

    /**
     * Runs checks to determine if a migration is currently needed
     *
     * @return bool
     */
    public function is_migration_needed()
    {
        if ( ( $this->db_version === null || ( $this->db_version !== null && version_compare( $this->db_version, CP_VERSION ) < 0 ) ) && count( $this->migrations ) > 0 ) {

            foreach ($this->migrations as $migration_version => $migration_class) {

                if (version_compare($this->db_version, $migration_version) === -1) {

                    if (class_exists($migration_class)) {

                        return true;

                    }
                }
            }
        }

        return false;

    }

    /**
     * Retrieve the last migration that was inserted into the migrations table.
     * 
     * @return null
     */
    protected function get_latest_migration()
    {
        global $wpdb;

        $last_migration = $wpdb->get_row("SELECT migration_version FROM {$wpdb->prefix }{$this->migrations_table} ORDER BY migration_version DESC;");

        if ( $last_migration !== null ) {
            return $last_migration->migration_version;
        }

        return null;
    }

    /**
     * If the migrations are needed let's run them.
     */
    protected function run_migrations()
    {

        if ( $this->is_migration_needed() ) {

            foreach ( $this->migrations as $migration_version => $migration_class ) {

                if ( version_compare( $this->db_version, $migration_version ) === -1 ) {

                    if ( class_exists( $migration_class ) ) {

                        /**
                         * @var $migration CP_Migration
                         */
                        $migration = new $migration_class();
                        $migration->run();

                        /**
                         * @var $logger CP_Logger
                         */
                        $logger = cp_get_logger();

                        $logger->info(
                            'Running migration version: ' . $migration_version,
                            array( 'migration_version' => $migration_version ),
                            'migration'
                        );

                        $this->db_version = $migration_version;

                    }

                }

            }

            update_option( 'cp_database_version', $this->db_version );

        }

    }

}

new CP_Migrations();
