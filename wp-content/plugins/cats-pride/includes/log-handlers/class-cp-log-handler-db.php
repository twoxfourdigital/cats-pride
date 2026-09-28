<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Handles log entries by writing to database.
 *
 * @class          CP_Log_Handler_DB

 */
class CP_Log_Handler_DB extends CP_Log_Handler {

	/**
	 * Handle a log entry.
	 *
	 * @param int $timestamp Log timestamp.
	 * @param string $level emergency|alert|critical|error|warning|notice|info|debug
	 * @param string $message Log message.
	 * @param array $context {
	 *     Additional information for log handlers.
	 *
	 *     @type string $source Optional. Source will be available in log table.
	 *                  If no source is provided, attempt to provide sensible default.
	 * }
	 *
	 * @see CP_Log_Handler_DB::get_log_source() for default source.
	 *
	 * @return bool False if value was not handled and true if value was handled.
	 */
	public function handle( $timestamp, $level, $message, $context, $group = null, $object_type = null, $object_type_id = null ) {

		if ( isset( $context['source'] ) && $context['source'] ) {
			$source = $context['source'];
		} else {
			$source = $this->get_log_source();
		}

        $entry = self::format_entry( $timestamp, $level, $message, $context, $group, $object_type, $object_type_id );

		return $this->add(
		    $entry['timestamp'],
            $entry['level'],
            $entry['message'],
            $source,
            $entry['context'],
            $entry['group'],
            $entry['object_type'],
            $entry['object_type_id']
        );
	}

	/**
	 * Add a log entry to chosen file.
	 *
	 * @param int $timestamp Log timestamp.
	 * @param string $level emergency|alert|critical|error|warning|notice|info|debug
	 * @param string $message Log message.
	 * @param string $source Log source. Useful for filtering and sorting.
	 * @param array $context {
	 *     Context will be serialized and stored in database.
	 * }
     * @param string $group Useful for filtering and sorting.
     * @param string $object_type Useful for associating a log with another post/user
     * @param int $object_type_id  Used in conjunction with $object_type to define which post/user
	 *
	 * @return bool True if write was successful.
	 */
	protected static function add( $timestamp, $level, $message, $source, $context, $group = null, $object_type = null, $object_type_id = null ) {

		global $wpdb;

		$insert = array(
		    'object_type' => $object_type,
			'object_type_id' => $object_type_id,
			'log_group' => $group,
			'log_timestamp' => date( 'Y-m-d H:i:s', $timestamp ),
			'log_level' => CP_Log_Levels::get_level_severity( $level ),
			'log_message' => $message,
			'log_source' => $source,
		);

		$format = array(
			'%s',
			'%d',
			'%s',
			'%s',
			'%s',
			'%s',
			'%s',
			'%s', // possible serialized context
		);

		if ( function_exists( 'wp_get_current_user' ) ) {

            $current_user = wp_get_current_user();

            if ($current_user instanceof WP_User) {
                $context['performed_by_user_id'] = $current_user->ID;
            }
        }

		if ( ! empty( $context ) ) {
			$insert['log_context'] = serialize( $context );
		}

		return false !== $wpdb->insert( "{$wpdb->prefix}cp_logs", $insert, $format );
	}

	/**
	 * Clear all logs from the DB.
	 *
	 * @return bool True if flush was successful.
	 */
	public static function flush() {
		global $wpdb;

		return $wpdb->query( "TRUNCATE TABLE {$wpdb->prefix}cp_logs" );
	}

	/**
	 * Delete selected logs from DB.
	 *
	 * @param int|string|array Log ID or array of Log IDs to be deleted.
	 *
	 * @return bool
	 */
	public static function delete( $log_ids ) {
		global $wpdb;

		if ( ! is_array( $log_ids ) ) {
			$log_ids = array( $log_ids );
		}

		$format = array_fill( 0, count( $log_ids ), '%d' );

		$query_in = '(' . implode( ',', $format ) . ')';

		$query = $wpdb->prepare(
			"DELETE FROM {$wpdb->prefix}cp_logs WHERE id IN {$query_in}",
			$log_ids
		);

		return $wpdb->query( $query );
	}

	/**
	 * Get appropriate source based on file name.
	 *
	 * Try to provide an appropriate source in case none is provided.
	 *
	 * @return string Text to use as log source. "" (empty string) if none is found.
	 */
	protected static function get_log_source() {
		static $ignore_files = array( 'class-cp-log-handler-db', 'class-cp-logger' );

		/**
		 * PHP < 5.3.6 correct behavior
		 * @see http://php.net/manual/en/function.debug-backtrace.php#refsect1-function.debug-backtrace-parameters
		 */
		if ( defined( 'DEBUG_BACKTRACE_IGNORE_ARGS' ) ) {
			$debug_backtrace_arg = DEBUG_BACKTRACE_IGNORE_ARGS;
		} else {
			$debug_backtrace_arg = false;
		}

		$trace = debug_backtrace( $debug_backtrace_arg );
		foreach ( $trace as $t ) {
			if ( isset( $t['file'] ) ) {
				$filename = pathinfo( $t['file'], PATHINFO_FILENAME );
				if ( ! in_array( $filename, $ignore_files ) ) {
					return $filename;
				}
			}
		}

		return '';
	}

}
