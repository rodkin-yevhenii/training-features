<?php
/**
 * Get data from the database, create/delete tables.
 *
 * @author Yevhenii Rodkin <rodkin.yevhenii@gmail.com>
 */

namespace BPPA\Helpers;

class DB {
	/**
	 * @var DB Class instance.
	 */
	private static DB $instance;

	/**
	 * @var string Table name
	 */
	private string $table_name;

	protected function __construct() {
		global $wpdb;

		// Set properties.
		$this->table_name = $wpdb->prefix . 'bppa_posts_analysis';
	}

	/**
	 * Create table for views data.
	 *
	 * @return void
	 */
	public function create_table(): void {
		global $wpdb;

		$charset_collate = $wpdb->get_charset_collate();

		$sql = "CREATE TABLE {$this->table_name} (
          id bigint(20) NOT NULL AUTO_INCREMENT,
          post_id bigint(20) NOT NULL,
          ip_address varchar(15) NOT NULL,
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
		global $wpdb;

		$wpdb->query( "DROP TABLE IF EXISTS {$this->table_name}" );
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
