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
		add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_assets' ) );
	}

	/**
	 * Register dashboard scripts.
	 *
	 * @param string $hook_suffix Page suffix.
	 *
	 * @return void
	 */
	public function register_admin_assets( string $hook_suffix ): void {
		if ( 'posts_page_bppa-analytics' !== $hook_suffix ) {
			return;
		}

		// Scripts.
		wp_enqueue_script(
			'bppa-dashboard',
			Plugin::get_plugin_file_url( 'public/admin.js' ),
			array( 'jquery' ),
			fileatime( Plugin::get_plugin_file_path( 'public/admin.js' ) ),
			true
		);

		// Styles.
		wp_enqueue_style(
			'data-tables',
			'https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css',
			array(),
			'2.2.2'
		);

		wp_enqueue_style(
			'bppa-dashboard',
			Plugin::get_plugin_file_url( 'public/admin.min.css' ),
			array(),
			fileatime( Plugin::get_plugin_file_path( 'public/admin.min.css' ) ),
		);

		wp_localize_script(
			'bppa-dashboard',
			'bppa_dashboard',
			array(
				'nonce' => wp_create_nonce( 'wp_rest' ),
			)
		);
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
			'bppa-frontend',
			Plugin::get_plugin_file_url( 'public/main.js' ),
			array(),
			fileatime( Plugin::get_plugin_file_path( 'public/main.js' ) ),
			true
		);

		wp_localize_script(
			'bppa-frontend',
			'bppa_ajax',
			array(
				'ajax_url' => admin_url( 'admin-ajax.php' ),
				'post_id'  => get_the_ID(),
				'nonce'    => wp_create_nonce( 'bppa_add_view' ),
			)
		);
	}

	/**
	 * Register shortcode styles.
	 *
	 * @return void
	 */
	public static function register_shortcode_styles(): void {
		wp_enqueue_style(
			'bppa-shortcode',
			Plugin::get_plugin_file_url( 'public/front.min.css' ),
			array(),
			fileatime( Plugin::get_plugin_file_path( 'public/front.min.css' ) )
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
