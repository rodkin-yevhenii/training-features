<?php
/**
 * Class Plugin.
 *
 * This class init whole plugin functionality. Also, it provides
 * methods for getting any plugin file path or URL.
 *
 * @package BPPA
 * @author Yevhenii Rodkin <rodkin.yevhenii@gmail.com>
 */

namespace BPPA;

use BPPA\Register\Assets;

/**
 * Class Plugin
 */
class Plugin {
	/**
	 * Init plugin functionality.
	 *
	 * @param string $file Main plugin file path.
	 *
	 * @return void
	 */
	public static function init( string $file ): void {
		Activation::init( $file );
		Assets::init();
		Ajax\Router::init();
	}

	/**
	 * Get plugin file path.
	 *
	 * @param string $path File path in the plugin folder. Don't use slash at the beginning of the path.
	 *
	 * @return string
	 */
	public static function get_plugin_file_path( string $path = '' ): string {
		return BPPA_DIR . $path;
	}

	/**
	 * Get plugin file URL.
	 *
	 * @param string $path File path in the plugin folder. Don't use slash in at the start of the path.
	 *
	 * @return string
	 */
	public static function get_plugin_file_url( string $path = '' ): string {
		return BPPA_URL . $path;
	}
}
