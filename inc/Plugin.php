<?php
/**
 * Main plugin entrypoint. This class init the plugin.
 *
 * @author Yevhenii Rodkin <rodkin.yevhenii@gmail.com>
 */

namespace BPPA;

use BPPA\Helpers\DB;

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
    }
}
