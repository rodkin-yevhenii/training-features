<?php

/**
 * Plugin Name:         Latest Posts Display plugin.
 * Plugin URI:          https://github.com/rodkin-yevhenii/training-features/tree/plugins/latest-posts-display
 * Description:         provides a simple shortcode [latest_posts count="X"] to display the latest blog posts in a
 * stylized format.
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

include dir(__FILE__) . 'inc/functions-cache.php';
include dir(__FILE__) . 'inc/functions-query.php';
include dir(__FILE__) . 'inc/functions-shortcodes.php';
