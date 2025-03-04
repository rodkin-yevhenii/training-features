<div class="bppa-dashboard">
	<div class="bppa-dashboard__header header">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<div class="actions">
			<?php if ( current_user_can( 'manage_options' ) ) : ?>
				<button id="reset-analytics">Reset analytics</button>
			<?php endif; ?>
		</div>
	</div>
	<div
		id="range"
		class="bppa-dashboard__range range"
		data-range="<?php echo filter_input( INPUT_GET, 'range' ) ?: 'all'; ?>"
	>
		<span>Show results for:</span>
		<a href="/wp-admin/edit.php?page=bppa-analytics&range=day">Day</a>
		<a href="/wp-admin/edit.php?page=bppa-analytics&range=week">Week</a>
		<a href="/wp-admin/edit.php?page=bppa-analytics&range=2_weeks">2 Weeks</a>
		<a href="/wp-admin/edit.php?page=bppa-analytics&range=month">Month</a>
		<a href="/wp-admin/edit.php?page=bppa-analytics&range=3_months">3 Months</a>
		<a href="/wp-admin/edit.php?page=bppa-analytics&range=all">All</a>
	</div>
	<div class="bppa-dashboard__body">
		<table id="bppa-dashboard__table" class="display" style="width:100%">
			<thead>
				<tr>
					<th>ID</th>
					<th>Title</th>
					<th>Views</th>
					<th>Published</th>
					<th>Author</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<th>ID</th>
					<th>Title</th>
					<th>Views</th>
					<th>Published</th>
					<th>Author</th>
				</tr>
			</tfoot>
		</table>
	</div>
</div>
