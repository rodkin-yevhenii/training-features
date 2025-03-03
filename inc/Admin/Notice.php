<?php
/**
 * Render notification messages in admin panel
 *
 * @author Yevhenii Rodkin <rodkin.yevhenii@gmail.com>
 */

namespace BPPA\Admin;

/**
 * Class Notice
 */
class Notice {
	/**
	 * Show an error message if the vendor file isn't exists.
	 *
	 * @return void
	 */
	public static function vendor_not_exists(): void {
		ob_start();
		?>
		<div id="bppa-vendor-nope" class="notice notice-error">
			<p>Dependencies for Blog Post Popularity Analysis need to be installed. Run
				<code>composer install --no-dev</code> from the <code>%s</code> directory.</p>
		</div>
		<?php

		printf(
			ob_get_clean(),
			esc_html( BPPA_DIR )
		);
	}
}
