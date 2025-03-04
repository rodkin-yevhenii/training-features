<?php
/**
 * Class AnalyticsResetHandler
 *
 * This class prepare data for the 'bppa/v1/analytics/reset'
 * rest route.
 *
 * @package BPPA\Rest\Handlers
 * @author Yevhenii Rodkin <rodkin.yevhenii@gmail.com>
 */

namespace BPPA\Rest\Handlers;

use BPPA\Helpers\DB;
use WP_REST_Request;

/**
 * Class AnalyticsResetHandler
 */
class AnalyticsResetHandler implements HandleRequestInterface {
	/**
	 * Reset analytica data.
	 *
	 * @param WP_REST_Request $request Request instance.
	 *
	 * @return array
	 */
	public function handle( WP_REST_Request $request ): array {
		$data = $request->get_params();

		if (
			empty( $data['nonce'] )
			|| ! wp_verify_nonce( $data['nonce'], 'wp_rest' )
		) {
			return array(
				'data'         => array(),
				'success'      => false,
				'error'        => 'Suspicious request',
				'errorMessage' => 'Cannot validate this request. Refresh the page and try again.',
			);
		}

		$db = DB::get_instance();
		$db->reset_table();

		return array(
			'data'    => array(),
			'success' => true,
		);
	}
}
