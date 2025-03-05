<?php
/**
 * Class Helpers
 *
 * This class contain different small method with pretty
 * simple logic that can be used in the different parts
 * of the project.
 *
 * @author Yevhenii Rodkin <rodkin.yevhenii@gmail.com>
 * @package BPPA\Helpers
 */

namespace BPPA\Helpers;

/**
 * Class Helpers
 */
class Helpers {
	/**
	 * Class instance.
	 *
	 * @var Helpers
	 */
	protected static Helpers $instance;

	/**
	 * Class construct.
	 */
	protected function __construct() {
		$this->register_hooks();
	}

	/**
	 * Register WordPress hooks.
	 *
	 * @return void
	 */
	public function register_hooks(): void {
		add_action( 'deleted_post', array( $this, 'delete_post' ) );
	}

	/**
	 * @param int $post_id Post ID.
	 *
	 * @return void
	 */
	public function delete_post( int $post_id ): void {
		$db = DB::get_instance();
		$db->remove_posts_data( $post_id );
	}

	/**
	 * Return class instance.
	 *
	 * @return Helpers
	 */
	public static function init(): Helpers {
		if ( empty( self::$instance ) ) {
			self::$instance = new Helpers();
		}

		return self::$instance;
	}
}
