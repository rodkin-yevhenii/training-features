<?php
/**
 * Class Router
 *
 * This class register callbacks for ajax actions
 *
 * @package BPPA\Ajax
 * @author Yevhenii Rodkin <rodkin.yevhenii@gmail.com>
 */

namespace BPPA\Ajax;

/**
 * Class Router
 */
final class Router {
	/**
	 * Class instance.
	 *
	 * @var Router
	 */
	private static Router $instance;

	/**
	 * Constant that store ajax actions and callback classes for them.
	 */
	private const ACTIONS = array(
		'add_new_view' => Callback\RegisterPostView::class,
	);

	/**
	 * Class construct.
	 */
	private function __construct() {
		$actions = apply_filters( 'bppa_ajax_actions', self::ACTIONS );

		foreach ( $actions as $action => $callback_class ) {
			add_action( "wp_ajax_$action", array( $callback_class, 'callback' ) );
			add_action( "wp_ajax_nopriv_$action", array( $callback_class, 'callback' ) );
		}
	}

	/**
	 * Class initialization.
	 *
	 * @return Router
	 */
	public static function init(): Router {
		if ( empty( self::$instance ) ) {
			self::$instance = new Router();
		}

		return self::$instance;
	}
}
