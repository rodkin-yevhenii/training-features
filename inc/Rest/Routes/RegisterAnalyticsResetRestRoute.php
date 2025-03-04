<?php
/**
 * Class RegisterAnalyticsResetRestRoute
 *
 * This class register rest route that reset all views data.
 *
 * @package BPPA\Rest\Routes
 * @author Yevhenii Rodkin <rodkin.yevhenii@gmail.com>
 */

namespace BPPA\Rest\Routes;

use BPPA\Rest\Handlers\AnalyticsResetHandler;

/**
 * Class RegisterAnalyticsResetRestRoute
 */
class RegisterAnalyticsResetRestRoute implements RegisterRestRoutInterface {
	/**
	 * Get rout name.
	 *
	 * @return string
	 */
	public function get_name(): string {
		return '/reset';
	}

	/**
	 * Get route namespace.
	 *
	 * @return string
	 */
	public function get_route(): string {
		return 'bppa/v1/analytics';
	}

	/**
	 * Get rout arguments.
	 *
	 * @return array[]
	 */
	public function get_arguments(): array {
		$handler = new AnalyticsResetHandler();

		return array(
			array(
				'methods'             => 'POST',
				'callback'            => array( $handler, 'handle' ),
				'args'                => array(),
				'permission_callback' => function () {
					return current_user_can( 'edit_others_posts' );
				},
			),
		);
	}
}
