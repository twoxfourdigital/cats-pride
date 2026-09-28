<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Abstract CP Log Handler Class
 *
 * @version        1.0.0
 */
abstract class CP_Log_Handler implements CP_Log_Handler_Interface {

	/**
	 * Formats a timestamp for use in log messages.
	 *
	 * @param int $timestamp Log timestamp.
	 * @return string Formatted time for use in log entry.
	 */
	protected static function format_time( $timestamp ) {
		return date( 'c', $timestamp );
	}

	/**
	 *
	 * @param int $timestamp Log timestamp.
	 * @param string $level emergency|alert|critical|error|warning|notice|info|debug
	 * @param string $message Log message.
	 * @param array $context Additional information for log handlers.
     * @param string $group Useful for filtering and sorting.
     * @param string $object_type Useful for associating a log with another post/user
     * @param int $object_type_id  Used in conjunction with $object_type to define which post/user
	 *
	 * @return string Formatted log entry.
	 */
	protected static function format_entry( $timestamp, $level, $message, $context, $group = null, $object_type = null, $object_type_id = null ) {

		$context = self::mask_sensitive_context( $context );

		return apply_filters( 'catspride_format_log_entry', array(
			'timestamp' => $timestamp,
			'level' => $level,
			'message' => $message,
			'context' => $context,
            'group' => $group,
            'object_type' => $object_type,
            'object_type_id' => $object_type_id
		) );
	}

    /**
     * We want to be sure and mask anything that is sensitive from getting into the logs. By default, we will
     * look for any keys that contain 'password' in the key name, and will replace the value with asterisks instead
     * of the original value.
     *
     * @param $context
     * @return array|bool
     */
	protected static function mask_sensitive_context( $context )
    {

        if ( defined( 'CP_LOG_MASK_CONTEXT' ) && CP_LOG_CONTEXT_MASK == false ) {
            return false;
        }

        if ( $context && is_array( $context ) && count( $context ) > 0) {

            $sensitive_keys = apply_filters( 'cp_log_mask_context_keys', [ 'password' ] );

            foreach( $context as $context_key => $context_value ) {

                if ( is_array( $context_value ) ) {

                    $context[$context_key] = self::mask_sensitive_context( $context_value );

                } else {

                    if ( in_array( $context_key, $sensitive_keys ) ) {

                        $context[$context_key] = str_repeat('*', strlen( $context[$context_key] ) );

                    }

                }

            }

        }

        return $context;

    }
}
