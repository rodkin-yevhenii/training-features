<?php
/**
 * Class Commands
 *
 * This class register bppa cli command.
 *
 * @author Yevhenii Rodkin <rodkin.yevhenii@gmail.com>
 * @package BPPA\CLI
 */

namespace BPPA\CLI;

/**
 * Class Commands
 */
class Commands {
	/**
	 * Main command
	 */
	private const COMMAND = 'bppa';

	/**
	 * Class instance.
	 *
	 * @var Commands
	 */
	private static Commands $instance;

	/**
	 * Class constructor.
	 */
	private function __construct() {
		// Hooks.
		add_action( 'cli_init', array( $this, 'register_commands' ) );
	}

	/**
	 * Register CLI commands classes.
	 *
	 * @return void
	 */
	public function register_commands(): void {
		\WP_CLI::add_command( static::COMMAND, Subcommands::class );
	}

	/**
	 * Class initialization.
	 *
	 * @return Commands
	 */
	public static function init(): Commands {
		if ( empty( self::$instance ) ) {
			self::$instance = new Commands();
		}

		return self::$instance;
	}
}
