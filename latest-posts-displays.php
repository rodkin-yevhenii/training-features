<?php

/**
 * Plugin Name:         Latest Posts Display plugin.
 * Plugin URI:          https://github.com/rodkin-yevhenii/training-features/tree/plugins/latest-posts-display
 * Description:         provides a simple shortcode [latest_posts count="X"] to display the latest blog posts in a stylized format.
 * Version:             1.0.0
 * Requires at least:   4.0
 * Requires PHP:        8.0
 * Author:              Yevhenii Rodkin
 * Author URI:          https://www.linkedin.com/in/yevhenii-rodkin/
 * Text Domain:         latest-posts-display
 */

if (!defined('ABSPATH')) {
    return;
}

define('LATEST_POSTS_DIR', plugin_dir_path(__FILE__));
define('LATEST_POSTS_URL', plugin_dir_url(__FILE__));

const LATEST_POSTS_DEFAULT_NUMBER = 10;

include LATEST_POSTS_DIR . 'inc/functions-cache.php';
include LATEST_POSTS_DIR . 'inc/functions-query.php';
include LATEST_POSTS_DIR . 'inc/functions-shortcodes.php';
