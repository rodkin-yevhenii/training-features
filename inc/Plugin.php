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

		if ( ! defined( 'DOING_AJAX' ) ) {
			$db = DB::get_instance();
			// $db->insert_view( 273, '192.168.123.256' );
			$a = $db->get_posts_views_number( DB::RANGE_WEEK );
			$b = 1;
		}
	}
}
