<?php
/**
 * Plugin Name:       Blog Post Popularity Analysis
 * Plugin URI:        https://github.com/rodkin-yevhenii/training-features/tree/plugins/posts-popularity-analusis-plugin
 * Description:       The plugin allows to analyze blog post popularity directly within the WordPress admin dashboard.
 * Version:           1.0.0
 * Requires at least: 5.6
 * Requires PHP:      8.0
 * Author:            Yevhenii Rodkin
 * Author URI:        https://www.linkedin.com/in/yevhenii-rodkin/
 * Text Domain:       posts-popularity-analysis
 * Domain Path:       /languages
 *
 * @package           BPPA
 * @author            Yevhenii Rodkin <rodkin.yevhenii@gmail.com>
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'BPPA_DIR', plugin_dir_path( __FILE__ ) );
define( 'BPPA_URL', plugin_dir_url( __FILE__ ) );

require_once BPPA_DIR . 'inc/Admin/Notice.php';

if ( ! file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	add_action( 'all_admin_notices', 'BPPA\Admin\Notice::vendor_not_exists' );

	return;
}

// Autoload.
require_once plugin_dir_path( __FILE__ ) . '/vendor/autoload.php';

BPPA\Plugin::init( __FILE__ );
