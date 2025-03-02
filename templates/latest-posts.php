<?php

/**
 * @var array $atts Shortcode attributes.
 */

$latest_posts_data = get_cached_latest_posts( $atts['count'] );

wp_enqueue_style(
    'latest-posts',
    LATEST_POSTS_URL . 'build/styles/styles.min.css',
    array(),
    fileatime( LATEST_POSTS_URL . 'build/styles/styles.min.css' )
);
?>
    <section id="latest-posts-display" class="latest-posts">
        <?php foreach ( $latest_posts_data as $post_id => $post_data ) : ?>
            <div id="post-<?php echo $post_id; ?>" class="latest-posts__card card">
                <h3><?php echo $post_data['title']; ?></h3>
                <figure class="card__image">
                    <?php echo $post_data['thumbnail']; ?>
                </figure>
                <span class="card__date">Published: <time><?php echo $post_data['date']; ?></time></span>
            </div>
        <?php
        endforeach; ?>
    </section>
<?php
