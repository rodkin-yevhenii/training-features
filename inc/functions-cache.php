<?php

/**
 * The transient cache functions.
 *
 * These functions get, save and update data in the transient cache.
 *
 * @author rodkin.yevhenii@gmail.com
 */

/**
 * Get latest posts data from the transient cache.
 *
 * @param int $posts_limit Latest posts number.
 *
 * @return array
 */
function get_cached_latest_posts( int $posts_limit ): array {
    $key               = 'latest-posts-display';
    $latest_posts_data = get_transient( $key );

    if ( empty( $latest_posts_data ) || count($latest_posts_data) < $posts_limit ) {
        $latest_posts_data = [];
        $query             = get_latest_posts_query( array( 'posts_per_page' => $posts_limit ) );

        while ( $query->have_posts() ) {
            $query->the_post();

            $latest_posts_data[ get_the_ID() ] = array(
                'title'     => get_the_title(),
                'date'      => get_the_date(),
                'thumbnail' => get_the_post_thumbnail( null, 'medium' ),
            );
        }

        $query->reset_postdata();
        set_transient( $key, $latest_posts_data, 5 * MINUTE_IN_SECONDS );
    }

    if ( count( $latest_posts_data ) > $posts_limit ) {
        $latest_posts_data = array_slice( $latest_posts_data, 0, $posts_limit );
    }

    return $latest_posts_data;
}
