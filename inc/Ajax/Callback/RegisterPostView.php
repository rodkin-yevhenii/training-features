<?php
/**
 * Class RegisterPostView
 *
 * Ajax callback for add_new_view action.
 *
 * @package BPPA\Ajax\Callback
 * @author Yevhenii Rodkin <rodkin.yevhenii@gmail.com>
 */

namespace BPPA\Ajax\Callback;

use BPPA\Helpers\DB;

/**
 * Class RegisterPostView
 */
class RegisterPostView {
	/**
	 * Add new record to database about new view.
	 *
	 * @return void
	 */
	public static function callback(): void {
		$nonce = filter_input( INPUT_POST, 'nonce' );

		if ( ! empty( $nonce ) && ! wp_verify_nonce( $nonce, 'bppa_add_view' ) ) {
			wp_send_json_error(
				array( 'message' => 'Verification by nonce code failed' ),
				403
			);
		}

		$post_id = filter_input( INPUT_POST, 'post_id', FILTER_VALIDATE_INT )
			? filter_input( INPUT_POST, 'post_id', FILTER_VALIDATE_INT )
			: 0;

		if ( empty( $post_id ) ) {
			wp_send_json_error(
				array( 'message' => 'Post ID is required.' ),
				403
			);
		}

		$db = DB::get_instance();
		$db->insert_view( $post_id );
	}
}
