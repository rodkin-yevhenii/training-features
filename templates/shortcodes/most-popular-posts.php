<?php
/**
 * Markup of the [most_popular_posts] shortcode.
 *
 * @var array $posts_data Cached posts data.
 */

use BPPA\Register\Assets;

if ( empty( $posts_data ) ) {
	return;
}

add_action( 'wp_enqueue_scripts', array( Assets::class, 'register_shortcode_styles' ) );
?>
<div id="bppa-most-popular-posts" class="popular-posts">
	<h2>The most popular posts</h2>
	<div class="cards">
		<?php foreach ( $posts_data as $post_data ) : ?>
			<div class="card">
				<h3>
					<a href="<?php echo esc_url( $post_data['permalink'] ); ?>">
						<?php echo esc_html( $post_data['title'] ); ?>
					</a>
				</h3>
				<figure class="card__image">
					<?php echo $post_data['thumbnail']; ?>
				</figure>
				<div class="card__date">
					<time><?php echo esc_html( $post_data['date'] ); ?></time>
					<div><?php echo esc_html( $post_data['views'] ); ?> views</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
</div>
