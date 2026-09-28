<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Cat's Pride Log Handler Interface
 *
 * Functions that must be defined to correctly fulfill log handler API.
 *
 */
interface CP_Log_Handler_Interface {

	/**
	 * Handle a log entry.
	 *
	 * @param int $timestamp Log timestamp.
	 * @param string $level emergency|alert|critical|error|warning|notice|info|debug
	 * @param string $message Log message.
	 * @param array $context Additional information for log handlers.
     * @param string $group Useful for filtering and sorting.
     * @param string $object_type Useful for associating a log with another post/user
     * @param int $object_type_id  Used in conjunction with $object_type to define which post/user
	 *
	 * @return bool False if value was not handled and true if value was handled.
	 */
	public function handle( $timestamp, $level, $message, $context, $group = null, $object_type = null, $object_type_id = null );
}
