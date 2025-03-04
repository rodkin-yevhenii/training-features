<?php
/**
 * Class AnalyticsResultsHandler
 *
 * This class prepare data for the 'bppa/v1/analytics/results'
 * rest route.
 *
 * @package BPPA\Rest
 * @author Yevhenii Rodkin <rodkin.yevhenii@gmail.com>
 */

namespace BPPA\Rest;

use BPPA\Rest\Routes\RegisterAnalyticsResetRestRoute;
use BPPA\Rest\Routes\RegisterAnalyticsRestRoute;
use BPPA\Rest\Routes\RegisterRestRoutInterface;

/**
 * Class API
 */
class API {
	/**
	 * Class instance.
	 *
	 * @var API
	 */
	private static API $instance;

	const REST_ROUTS = array(
		RegisterAnalyticsRestRoute::class,
		RegisterAnalyticsResetRestRoute::class,
	);

	/**
	 * Class construct.
	 */
	private function __construct() {
		add_action( 'rest_api_init', array( $this, 'register_rest_routs' ) );
	}

	/**
	 * Register rest api routs.
	 *
	 * @return void
	 */
	public function register_rest_routs(): void {
		foreach ( self::REST_ROUTS as $class ) {
			$route = new $class();

			$this->register_rest_rout( $route );
		}
	}

	/**
	 * Register rest api route.
	 *
	 * @param RegisterRestRoutInterface $route Instance of the RegisterRestRoutInterface interface.
	 *
	 * @return void
	 */
	private function register_rest_rout( RegisterRestRoutInterface $route ): void {
		register_rest_route(
			$route->get_route(),
			$route->get_name(),
			$route->get_arguments(),
		);
	}

	/**
	 * Class initialization.
	 *
	 * @return API
	 */
	public static function init(): API {
		if ( empty( self::$instance ) ) {
			self::$instance = new API();
		}

		return self::$instance;
	}
}
