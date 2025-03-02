<?php

/**
 * The query functions.
 *
 * These query functions will get results from the database.
 *
 * @author  rodkin.yevhenii@gmail.com
 */

/**
 * @param array $args
 *
 * @return WP_Query
 */
function get_latest_posts_query( array $args ): WP_Query {
    $args = array_merge(
        array(
            'post_type'      => 'post',
            'posts_per_page' => LATEST_POSTS_DEFAULT_NUMBER,
            'post_status'    => 'publish',
            'fields'         => 'ids',
            'orderby'        => 'date',
        ),
        $args
    );

    return new WP_Query( $args );
}
