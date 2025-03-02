<?php

/**
 * The shortcodes registration.
 *
 * @author  rodkin.yevhenii@gmail.com
 */

/**
 * Filters
 */
add_shortcode( 'latest_posts', 'latest_posts_display_callback' );

/**
 * Functions
 */

/**
 * Render html markup of the latest_posts shortcode.
 *
 * @param array $atts
 *
 * @return string
 */
function latest_posts_display_callback( array $atts ): string {
    $atts = shortcode_atts(
        array(
            'count' => LATEST_POSTS_DEFAULT_NUMBER
        ),
        $atts,
        'latest_posts'
    );

    ob_start();

    // Start profiling.
    if ( defined( 'QM_VERSION' ) && current_user_can( 'manage_options' ) ) {
        do_action( 'qm/start', 'render_results' );
    }

    include LATEST_POSTS_DIR . 'templates/latest-posts.php';

    // Stop profiling.
    if ( defined( 'QM_VERSION' ) && current_user_can( 'manage_options' ) ) {
        do_action( 'qm/stop', 'render_results' );
    }

    return ob_get_clean();
}
