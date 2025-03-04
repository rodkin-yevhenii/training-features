<?php
/**
 * Class Assets
 *
 * This class register styles, scripts, etc.
 *
 * @package BPPA\Register
 * @author Yevhenii Rodkin <rodkin.yevhenii@gmail.com>
 */

namespace BPPA\Register;

use BPPA\Plugin;

/**
 * Class Assets
 */
final class Assets {
	/**
	 * Class instance.
	 *
	 * @var Assets
	 */
	private static Assets $instance;

	/**
	 * Class construct.
	 */
	protected function __construct() {
		// Actions.
		add_action( 'wp_enqueue_scripts', array( $this, 'register_front_scripts' ) );
	}

	/**
	 * Register plugin scripts.
	 *
	 * @return void
	 */
	public function register_front_scripts(): void {
		// Register the script only on posts.
		if ( ! is_singular( 'post' ) ) {
			return;
		}

		wp_enqueue_script(
			'bbpa-frontend',
			Plugin::get_plugin_file_url( 'public/main.js' ),
			array(),
			fileatime( Plugin::get_plugin_file_path( 'public/main.js' ) ),
			true
		);
	}

	/**
	 * Get class instance.
	 *
	 * @return Assets
	 */
	public static function init(): Assets {
		if ( empty( self::$instance ) ) {
			self::$instance = new Assets();
		}

		return self::$instance;
	}
}
