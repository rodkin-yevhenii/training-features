<?php
/**
 * Class AnalyticsResultsHandler
 *
 * This class prepare data for the 'bppa/v1/analytics/results'
 * rest route.
 *
 * @package BPPA\Rest\Handlers
 * @author Yevhenii Rodkin <rodkin.yevhenii@gmail.com>
 */

namespace BPPA\Rest\Handlers;

use BPPA\Helpers\DB;
use WP_REST_Request;

/**
 * Class AnalyticsResultsHandler
 */
class AnalyticsResultsHandler implements HandleRequestInterface {
	/**
	 * Get analytica data.
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

		$range = match ( $data['range'] ) {
			'day'      => DB::RANGE_DAY,
			'week'     => DB::RANGE_WEEK,
			'2_weeks'  => DB::RANGE_2_WEEKS,
			'month'    => DB::RANGE_MONTH,
			'3_months' => DB::RANGE_3_MOTHS,
			default    => DB::RANGE_ALL
		};
		$db        = DB::get_instance();
		$analytics = $db->get_popular_posts( $range );
		$data      = array();

		foreach ( $analytics as $post_data ) {
			$id        = $post_data['post_id'];
			$author_id = get_post_field( 'post_author', $id );
			$data[]    = array(
				'id'        => $id,
				'views'     => $post_data['views'],
				'title'     => sprintf(
					'<a href="%s" target="_blank">%s</a>',
					get_permalink( $id ),
					get_the_title( $id )
				),
				'author'    => get_the_author_meta( 'display_name', $author_id ),
				'published' => get_the_date( '', $id ),
			);
		}

		return array(
			'data'    => $data,
			'success' => true,
		);
	}
}
