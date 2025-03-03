<?php
/**
 * Works with activation, deactivation, uninstalling hooks.
 *
 * @author Yevhenii Rodkin <rodkin.yevhenii@gmail.com>
 */

namespace BPPA;

use BPPA\Helpers\DB;

class Activation {
	/**
	 * @var Activation Class instance.
	 */
	private static Activation $instance;

	/**
	 * @param string $file
	 */
	private function __construct( string $file ) {
		// Activation and deactivation
		register_activation_hook( $file, array( $this, 'activate' ) );
		register_uninstall_hook( $file, array( self::class, 'uninstall' ) );
	}

	/**
	 * Create a new table.
	 *
	 * @return void
	 */
	public function activate(): void {
		$db = DB::get_instance();
		$db->create_table();
	}

	/**
	 * Clear database before plugin uninstalling.
	 *
	 * @return void
	 */
	public static function uninstall(): void {
		$db = DB::get_instance();
		$db->drop_table();
	}

	/**
	 * Return class instance.
	 *
	 * @param string $file Main plugin file path.
	 *
	 * @return Activation
	 */
	public static function init( string $file ): Activation {
		if ( empty( self::$instance ) ) {
			self::$instance = new Activation( $file );
		}

		return self::$instance;
	}
}
