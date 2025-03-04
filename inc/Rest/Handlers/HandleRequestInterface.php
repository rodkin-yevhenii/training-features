<?php
/**
 * Interface HandleRequestInterface
 *
 * Interface for all rest routs handlers.
 *
 * @package BPPA\Rest\Handlers
 * @author Yevhenii Rodkin <rodkin.yevhenii@gmail.com>
 */

namespace BPPA\Rest\Handlers;

use WP_REST_Request;

/**
 * Interface HandleRequestInterface
 */
interface HandleRequestInterface {
	/**
	 * Method should be used as a callback function on REST API request
	 *
	 * @param WP_REST_Request $request
	 *
	 * @return mixed
	 */
	public function handle( WP_REST_Request $request ): mixed;
}
