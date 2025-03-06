<?php
/**
 * Class DB
 *
 * Get data from the database, create/delete tables.
 *
 * @author Yevhenii Rodkin <rodkin.yevhenii@gmail.com>
 * @package BPPA\Helpers
 */

namespace BPPA\Helpers;

use Exception;
use wpdb;

/**
 * Class DB
 */
class DB {
	/**
	 * Date range constants.
	 */
	const RANGE_ALL     = 'ALL';
	const RANGE_DAY     = 'DAY';
	const RANGE_WEEK    = 'WEEK';
	const RANGE_2_WEEKS = '2 WEEKS';
	const RANGE_MONTH   = 'MONTH';
	const RANGE_3_MONTHS = '3 MONTHS';

	/**
	 * Possible date ranges for views filtering.
	 */
	private const DATE_RANGES = array(
		'ALL'      => 'all',
		'DAY'      => '-1 day',
		'WEEK'     => '-1 week',
		'2 WEEKS'  => '-2 weeks',
		'MONTH'    => '-1 month',
		'3 MONTHS' => '-3 months',
	);

	/**
	 * Class instance.
	 *
	 * @var DB
	 */
	private static DB $instance;

	/**
	 * WPDB class instance.
	 *
	 * @var wpdb
	 */
	private wpdb $wpdb;

	/**
	 * Table name.
	 *
	 * @var string
	 */
	private string $table_name;

	/**
	 * DB Class constructor.
	 */
	protected function __construct() {
		global $wpdb;

		// Set properties.
		$this->table_name = $wpdb->prefix . 'bppa_posts_analysis';
		$this->wpdb       = $wpdb;
	}

	/**
	 * Add a new view to the table.
	 *
	 * @param int $post_id Post ID.
	 *
	 * @return void
	 */
	public function insert_view( int $post_id ): void {
		$this->wpdb->insert(
			$this->table_name,
			array(
				'post_id' => $post_id,
				'date'    => current_datetime()->format( 'Y-m-d H:i:s' ),
			),
			array(
				'%d',
				'%s',
			)
		);
	}

	/**
	 * Remove all analytics data connected to the post.
	 *
	 * @param int $post_id Post ID.
	 *
	 * @return void
	 */
	public function remove_posts_data( int $post_id ): void {
		$this->wpdb->delete( $this->table_name, array( 'post_id' => $post_id ), array( '%d' ) );
	}

	/**
	 * Get post views for a specific range.
	 *
	 * @param string $range Dates range for filtering.
	 *
	 * @return array
	 */
	public function get_popular_posts( string $range = 'ALL' ): array {
		$sql = "SELECT post_id, COUNT(post_id) AS views FROM {$this->table_name}";

		if ( array_key_exists( $range, static::DATE_RANGES ) && static::RANGE_ALL !== $range ) {
			$date = current_datetime();
			$date = $date->modify( static::DATE_RANGES[ $range ] );
			$sql .= $this->wpdb->prepare( ' WHERE date >= %s', $date->format( 'Y-m-d H:i:s' ) );
		}

		$sql .= ' GROUP BY post_id ORDER BY views DESC';

		return $this->wpdb->get_results(
			$sql,
			ARRAY_A
		);
	}

	/**
	 * Create table for views data.
	 *
	 * @return void
	 */
	public function create_table(): void {
		$charset_collate = $this->wpdb->get_charset_collate();

		$sql = "CREATE TABLE {$this->table_name} (
          id bigint(20) NOT NULL AUTO_INCREMENT,
          post_id bigint(20) NOT NULL,
          date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
          PRIMARY KEY  (id)
        ) $charset_collate;";

		require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		dbDelta( $sql );
	}

	/**
	 * Drop table for views data.
	 *
	 * @return void
	 */
	public function drop_table(): void {
		$this->wpdb->query( "DROP TABLE IF EXISTS {$this->table_name}" );
	}

	/**
	 * Remove all data and restore autoincrement.
	 *
	 * @return void
	 */
	public function reset_table(): void {
		$this->wpdb->query( "TRUNCATE TABLE {$this->table_name}" );
	}

	/**
	 * Class initialization.
	 *
	 * @return DB
	 */
	public static function get_instance(): DB {
		if ( empty( static::$instance ) ) {
			static::$instance = new DB();
		}

		return static::$instance;
	}
}
