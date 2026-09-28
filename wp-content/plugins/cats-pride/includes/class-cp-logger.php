<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Provides logging capabilities for debugging purposes.
 *
 * @class          CP_Logger
 */
class CP_Logger implements CP_Logger_Interface {

	/**
	 * Stores registered log handlers.
	 *
	 * @var array
	 */
	protected $handlers;

	/**
	 * Minimum log level this handler will process.
	 *
	 * @var int Integer representation of minimum log level to handle.
	 */
	protected $threshold;

	/**
	 * Constructor for the logger.
	 *
	 * @param array $handlers Optional. Array of log handlers. If $handlers is not provided,
	 *     the filter 'catspride_register_log_handlers' will be used to define the handlers.
	 *     If $handlers is provided, the filter will not be applied and the handlers will be
	 *     used directly.
	 * @param string $threshold Optional. Define an explicit threshold. May be configured
	 *     via  CP_LOG_THRESHOLD. By default, all logs will be processed.
	 */
	public function __construct( $handlers = null, $threshold = null ) {
		if ( null === $handlers ) {
			$handlers = apply_filters( 'cp_register_log_handlers', array() );
		}

		$register_handlers = array();

		if ( ! empty( $handlers ) && is_array( $handlers ) ) {
			foreach ( $handlers as $handler ) {
				$implements = class_implements( $handler );
				if ( is_object( $handler ) && is_array( $implements ) && in_array( 'CP_Log_Handler_Interface', $implements ) ) {
					$register_handlers[] = $handler;
				} else {
					wc_doing_it_wrong(
						__METHOD__,
						sprintf(
							__( 'The provided handler <code>%s</code> does not implement CP_Log_Handler_Interface.', 'catspride' ),
							esc_html( is_object( $handler ) ? get_class( $handler ) : $handler )
						),
						'3.0'
					);
				}
			}
		}

		if ( null !== $threshold ) {
			$threshold = CP_Log_Levels::get_level_severity( $threshold );
		} elseif ( defined( 'CP_LOG_THRESHOLD' ) && CP_Log_Levels::is_valid_level( CP_LOG_THRESHOLD ) ) {
			$threshold = CP_Log_Levels::get_level_severity( CP_LOG_THRESHOLD );
		} else {
			$threshold = null;
		}

		$this->handlers  = $register_handlers;
		$this->threshold = $threshold;
	}

	/**
	 * Determine whether to handle or ignore log.
	 *
	 * @param string $level emergency|alert|critical|error|warning|notice|info|debug
	 * @return bool True if the log should be handled.
	 */
	protected function should_handle( $level ) {
		if ( null === $this->threshold ) {
			return true;
		}
		return $this->threshold <= CP_Log_Levels::get_level_severity( $level );
	}

	/**
	 * Add a log entry.
	 *
	 * @param string $level One of the following:
	 *     'emergency': System is unusable.
	 *     'alert': Action must be taken immediately.
	 *     'critical': Critical conditions.
	 *     'error': Error conditions.
	 *     'warning': Warning conditions.
	 *     'notice': Normal but significant condition.
	 *     'info': Informational messages.
	 *     'debug': Debug-level messages.
	 * @param string $message Log message.
	 * @param array $context Optional. Additional information for log handlers.
	 */
	public function log( $level, $message, $context = array(), $group = null, $object_type = null, $object_type_id = null ) {

		if ( ! CP_Log_Levels::is_valid_level( $level ) ) {
			wc_doing_it_wrong( __METHOD__, sprintf( __( 'CP_Logger::log was called with an invalid level "%s".', 'catspride' ), $level ), '3.0' );
		}

		if ( $this->should_handle( $level ) ) {
			$timestamp = current_time( 'timestamp' );
			$message = apply_filters( 'catspride_logger_log_message', $message, $level, $context, $group, $object_type, $object_type_id );

			foreach ( $this->handlers as $handler ) {
				$handler->handle( $timestamp, $level, $message, $context, $group, $object_type, $object_type_id );
			}
		}
	}

	/**
	 * Adds an emergency level message.
	 *
	 * System is unusable.
	 *
	 * @see CP_Logger::log
	 *
	 * @param string $message
	 * @param array $context
	 */
	public function emergency( $message, $context = array(), $group = null, $object_type = null, $object_type_id = null ) {
		$this->log( CP_Log_Levels::EMERGENCY, $message, $context, $group, $object_type, $object_type_id );
	}

	/**
	 * Adds an alert level message.
	 *
	 * Action must be taken immediately.
	 * Example: Entire website down, database unavailable, etc.
	 *
	 * @see CP_Logger::log
	 *
	 * @param string $message
	 * @param array $context
	 */
	public function alert( $message, $context = array(), $group = null, $object_type = null, $object_type_id = null ) {
		$this->log( CP_Log_Levels::ALERT, $message, $context, $group, $object_type, $object_type_id );
	}

	/**
	 * Adds a critical level message.
	 *
	 * Critical conditions.
	 * Example: Application component unavailable, unexpected exception.
	 *
	 * @see CP_Logger::log
	 *
	 * @param string $message
	 * @param array $context
	 */
	public function critical( $message, $context = array(), $group = null, $object_type = null, $object_type_id = null ) {
		$this->log( CP_Log_Levels::CRITICAL, $message, $context, $group, $object_type, $object_type_id );
	}

	/**
	 * Adds an error level message.
	 *
	 * Runtime errors that do not require immediate action but should typically be logged
	 * and monitored.
	 *
	 * @see CP_Logger::log
	 *
	 * @param string $message
	 * @param array $context
	 */
	public function error( $message, $context = array(), $group = null, $object_type = null, $object_type_id = null ) {
		$this->log( CP_Log_Levels::ERROR, $message, $context, $group, $object_type, $object_type_id );
	}

	/**
	 * Adds a warning level message.
	 *
	 * Exceptional occurrences that are not errors.
	 *
	 * Example: Use of deprecated APIs, poor use of an API, undesirable things that are not
	 * necessarily wrong.
	 *
	 * @see CP_Logger::log
	 *
	 * @param string $message
	 * @param array $context
	 */
	public function warning( $message, $context = array(), $group = null, $object_type = null, $object_type_id = null ) {
		$this->log( CP_Log_Levels::WARNING, $message, $context, $group, $object_type, $object_type_id );
	}

	/**
	 * Adds a notice level message.
	 *
	 * Normal but significant events.
	 *
	 * @see CP_Logger::log
	 *
	 * @param string $message
	 * @param array $context
	 */
	public function notice( $message, $context = array(), $group = null, $object_type = null, $object_type_id = null ) {
		$this->log( CP_Log_Levels::NOTICE, $message, $context, $group, $object_type, $object_type_id );
	}

	/**
	 * Adds a info level message.
	 *
	 * Interesting events.
	 * Example: User logs in, SQL logs.
	 *
	 * @see CP_Logger::log
	 *
	 * @param string $message
	 * @param array $context
	 */
	public function info( $message, $context = array(), $group = null, $object_type = null, $object_type_id = null ) {
		$this->log( CP_Log_Levels::INFO, $message, $context, $group, $object_type, $object_type_id );
	}

	/**
	 * Adds a debug level message.
	 *
	 * Detailed debug information.
	 *
	 * @see CP_Logger::log
	 *
	 * @param string $message
	 * @param array $context
	 */
	public function debug( $message, $context = array(), $group = null, $object_type = null, $object_type_id = null ) {
		$this->log( CP_Log_Levels::DEBUG, $message, $context, $group, $object_type, $object_type_id );
	}

}
