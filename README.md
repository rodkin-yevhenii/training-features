# Latest Posts Display plugin

It's a simple wordpress plugin that provides the `[latest_posts]` shordcode to display a list of latest posts

## Available Shortcode variatins

- `[latest_posts]` - display 10 latest posts;
- `[latest_posts count=6]` - display  6 latest posts. You can use any number istaed of 6 but we recommend using numbers
that are multiples of 2;

## Performance
To improve website performance, the latest posts data is stored in the Transient cache. The
updated data will be displayed on the front end within 5 minutes (cache lifespan).

### Set up on production
- Download the archive with codebase from the GitHub repository;
- Upload this archive to the site. Use uploader on the "**Add Plugins**" page (`/wp-admin/plugin-install.php`) in the admin panel;
- Activate the plugin on the Plugins page in the admin panel;
