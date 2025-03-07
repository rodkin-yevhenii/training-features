<?php
/**
 * Class MostPopularPosts
 *
 * This class register [most_popular_posts]  shortcode .
 *
 * @author Yevhenii Rodkin <rodkin.yevhenii@gmail.com>
 * @package BPPA\Shortcode
 */

namespace BPPA\Shortcode;

use BPPA\Helpers\DB;
use BPPA\Plugin;
use WP_Query;

/**
 * Class MostPopularPosts
 */
class MostPopularPosts {
	/**
	 * Class instance.
	 *
	 * @var MostPopularPosts
	 */
	protected static MostPopularPosts $instance;

	/**
	 * Class construct.
	 */
	protected function __construct() {
		add_shortcode( 'most_popular_posts', array( $this, 'most_popular_posts_callback' ) );
	}

	/**
	 * Render [most_popular_posts] shortcode.
	 *
	 * @param array $atts Shortcode attributes.
	 *
	 * @return string
	 */
	public function most_popular_posts_callback( array $atts ): string {
		$atts = shortcode_atts(
			array(
				'limit'      => 8,
				'start_date' => '',
				'end_date'   => '',
			),
			$atts,
			'latest_posts'
		);

		$start_date = str_replace( array( ' ', '.', ':', '_' ), '-', $atts['start_date'] );
		$end_date   = str_replace( array( ' ', '.', ':', '_' ), '-', $atts['end_date'] );

		ob_start();

		// Start profiling.
		if ( defined( 'QM_VERSION' ) && current_user_can( 'manage_options' ) ) {
			// @codingStandardsIgnoreLine WordPress.NamingConventions.ValidHookNameSniff
			do_action( 'qm/start', 'most_popular_posts_shortcode' );
		}

		$posts_data = $this->get_cached_popular_posts( $atts['limit'], $start_date, $end_date );

		require Plugin::get_plugin_file_path( 'templates/shortcodes/most-popular-posts.php' );

		// Stop profiling.
		if ( defined( 'QM_VERSION' ) && current_user_can( 'manage_options' ) ) {
            // @codingStandardsIgnoreLine WordPress.NamingConventions.ValidHookNameSniff
			do_action( 'qm/stop', 'most_popular_posts_shortcode' );
		}

		return ob_get_clean();
	}

	/**
	 * Get popular posts cached data.
	 *
	 * @param int    $limit Posts limit.
	 * @param string $start_date Older date. Format: Y-m-d H:i:s.
	 * @param string $end_date Never date.Format: Y-m-d H:i:s.
	 *
	 * @return array
	 */
	protected function get_cached_popular_posts(
		int $limit = 8,
		string $start_date = '',
		string $end_date = ''
	): array {
		$key = 'bppa';

		if ( ! empty( $start_date ) ) {
			$key .= '_' . $start_date;
		}

		if ( ! empty( $end_date ) ) {
			$key .= '_' . $end_date;
		}

		$key = str_replace( ' ', '_', $key );

		$data = get_transient( $key );

		if ( empty( $data ) || count( $data ) < $limit ) {
			$fresh_data  = array();
			$db          = DB::get_instance();
			$data        = $db->get_popular_posts();
			$posts_ids   = array();
			$posts_views = array();

			foreach ( $data as $post ) {
				$id                 = $post['post_id'];
				$posts_ids[]        = $id;
				$posts_views[ $id ] = $post['views'];
			}

			$query = $this->get_most_popular_posts_query( $posts_ids, $limit, $start_date, $end_date );

			while ( $query->have_posts() ) {
				$query->the_post();

				$fresh_data[ get_the_ID() ] = array(
					'title'     => get_the_title(),
					'date'      => get_the_date(),
					'thumbnail' => get_the_post_thumbnail( null, 'medium' ),
					'permalink' => get_permalink(),
					'views'     => $posts_views[ get_the_ID() ],
				);
			}

			$query->reset_postdata();
			$data = $fresh_data;
			set_transient(
				$key,
				$data,
				apply_filters( 'bppa_transient_cache_lifetime', 5 * MINUTE_IN_SECONDS )
			);
		}

		if ( count( $data ) > $limit ) {
			$data = array_slice( $data, 0, $limit );
		}

		return $data;
	}

	/**
	 * Get most popular posts query.
	 *
	 * @param array  $posts_ids Most popular posts ids.
	 * @param int    $limit Posts limit.
	 * @param string $start_date Older date. Format: Y-m-d H:i:s.
	 * @param string $end_date Never date.Format: Y-m-d H:i:s.
	 *
	 * @return WP_Query
	 */
	protected function get_most_popular_posts_query(
		array $posts_ids,
		int $limit = 8,
		string $start_date = '',
		string $end_date = ''
	): WP_Query {
		$args = array(
			'post_type'      => 'post',
			'post_status'    => 'publish',
			'posts_per_page' => $limit,
			'post__in'       => $posts_ids,
			'fields'         => 'ids',
			'orderby'        => 'post__in',
		);

		$date_query_arr = array();

		if ( ! empty( $start_date ) ) {
			$date_query_arr['after']     = $start_date;
			$date_query_arr['inclusive'] = true;
		}

		if ( ! empty( $end_date ) ) {
			$date_query_arr['before']    = $end_date;
			$date_query_arr['inclusive'] = true;
		}

		if ( ! empty( $date_query_arr ) ) {
			$args['date_query'][] = $date_query_arr;
		}

		return new WP_Query( $args );
	}

	/**
	 * Return class instance.
	 *
	 * @return MostPopularPosts
	 */
	public static function init(): MostPopularPosts {
		if ( empty( self::$instance ) ) {
			self::$instance = new MostPopularPosts();
		}

		return self::$instance;
	}
}
