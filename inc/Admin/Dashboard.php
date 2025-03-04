<?php
/**
 * Class Dashboard.
 *
 * Register admin dashboard for the posts popularity analysis.
 *
 * @package BPPA\Admin
 * @author Yevhenii Rodkin <rodkin.yevhenii@gmail.com>
 */

namespace BPPA\Admin;

use BPPA\Plugin;

/**
 * Class Dashboard.
 */
class Dashboard {
	/**
	 * Class instance.
	 *
	 * @var Dashboard
	 */
	private static Dashboard $instance;

	/**
	 * Class construct
	 */
	private function __construct() {
		// Hooks.
		add_action( 'admin_menu', array( $this, 'register_options_page' ) );
	}

	/**
	 * Register option page.
	 *
	 * @return void
	 */
	public function register_options_page(): void {
		add_submenu_page(
			'edit.php',
			'Blog Posts Popularity Analysis',
			'BPPA analytics',
			'edit_others_posts',
			'bppa-analytics',
			array( $this, 'render_dashboard_page' ),
			5
		);
	}

	/**
	 * Render dashboard.
	 *
	 * @return void
	 */
	public function render_dashboard_page(): void {
		require_once Plugin::get_plugin_file_path( 'templates/dashboard.php' );
	}

	/**
	 * Init class functionality.
	 *
	 * @return Dashboard
	 */
	public static function init(): Dashboard {
		if ( empty( self::$instance ) ) {
			self::$instance = new Dashboard();
		}

		return self::$instance;
	}
}
