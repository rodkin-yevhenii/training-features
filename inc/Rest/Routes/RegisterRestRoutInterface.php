<?php
/**
 * Interface RegisterRestRoutInterface
 *
 * Interface for all analytics rest routes.
 *
 * @package BPPA\Rest\Routes
 * @author Yevhenii Rodkin <rodkin.yevhenii@gmail.com>
 */

namespace BPPA\Rest\Routes;

/**
 * Interface RegisterRestRoutInterface
 */
interface RegisterRestRoutInterface {
	/**
	 * Get uniq part for the rest route
	 *
	 * @return string
	 */
	public function get_name(): string;

	/**
	 * Get a common part of the route
	 *
	 * @return string
	 */
	public function get_route(): string;

	/**
	 * Route arguments
	 *
	 * @return array[]
	 */
	public function get_arguments(): array;
}
