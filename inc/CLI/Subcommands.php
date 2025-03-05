<?php
/**
 * Class Subcommands
 *
 * This class register subcommands for bppa cli command.
 *
 * @author Yevhenii Rodkin <rodkin.yevhenii@gmail.com>
 * @package BPPA\CLI
 */

namespace BPPA\CLI;

use BPPA\Helpers\DB;

/**
 * Class Subcommands
 */
class Subcommands {
	/**
	 * Remove all analytics data.
	 *
	 * @param array $args Subcommand arguments.
	 * @param array $flags Subcommand flags.
	 *
	 * @return void
	 */
	public function reset( array $args, array $flags ): void {
		$db = DB::get_instance();

		if ( ! empty( $args ) || ! empty( $flags ) ) {
			\WP_CLI::warning( 'This command doesn\'t support any arguments.' );
		}

		if ( empty( $db->get_popular_posts() ) ) {
			\WP_CLI::warning( 'There are no analytics data.' );

			return;
		}

		$db->reset_table();

		if ( ! empty( $db->get_popular_posts() ) ) {
			\WP_CLI::error( 'Something went wrong while resetting posts views.' );

			return;
		}

		\WP_CLI::success( 'Posts views analytics has been removed.' );
	}

	/**
	 * Generate demo data.
	 *
	 * @param array $args Subcommand arguments.
	 * @param array $flags Subcommand flags.
	 *
	 * @return void
	 */
	public function generate( array $args, array $flags ): void {
		$allowed_flags = array(
			'limit',
		);

		if ( ! empty( $args ) ) {
			\WP_CLI::warning( 'This command doesn\'t support any arguments.' );
		}

		foreach ( $flags as $flag => $value ) {
			if ( ! in_array( $flag, $allowed_flags, true ) ) {
				\WP_CLI::error( sprintf( 'Flag --%s is not allowed.', $flag ) );

				return;
			}
		}

		$limit = (int) $flags['limit'] ?? 50;
		$args  = array(
			'post_type'      => 'post',
			'post_status'    => 'publish',
			'posts_per_page' => $limit,
			'fields'         => 'ids',
		);

		$query = new \WP_Query( $args );
		$db    = DB::get_instance();

		if ( ! $query->have_posts() ) {
			\WP_CLI::warning( 'There are no posts on the website.' );

			return;
		}

		if ( $query->post_count < $limit ) {
			\WP_CLI::warning( 'There are less posts on the website that you\'ve requested.' );
		}

		foreach ( $query->posts as $post ) {
			$views_limit = wp_rand( 150, 600 );

			for ( $i = 0; $i <= $views_limit; $i++ ) {
				$db->insert_view( $post, '172.168.0.1' );
			}
		}

		\WP_CLI::success( 'Demo data generated successfully.' );
	}
}
