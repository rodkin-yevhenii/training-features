# Latest Posts Display plugin

It's a simple WordPress plugin that provides the `[latest_posts]` shortcode to display a list of the latest posts

![](https://github.com/rodkin-yevhenii/training-features/blob/images/latest-posts-display/screenshot.png)

## Available Shortcode variations

- `[latest_posts]` - display 10 latest posts;
- `[latest_posts count=6]` - display  6 latest posts. You can use any number instead of 6 but we recommend using numbers
that are multiples of 2;

## Performance
To improve website performance, the latest posts data is stored in the Transient cache. The
updated data will be displayed on the front end within 5 minutes (cache lifespan).

## Installation
### Via admin panel
- Download the archive with codebase from the GitHub repository;
- Upload this archive to the site. Use uploader on the "**Add Plugins**" page (`/wp-admin/plugin-install.php`) in the
admin panel;
- Activate the plugin on the Plugins page in the admin panel;

### Via composer
The installation of packages should be configured on your server.
- Add `"yevhenii_rodkin/latest-posts-display": "dev-latest-posts-display"` to the `require` section of **composer.json** in the WordPress
root folder;
- Add the code below to the `repositories` section of **composer.json** in the WordPress root folder;
```json
"latest-posts-display": {
  "type": "vcs",
  "url": "https://github.com/yevhenii_rodkin/latest-posts-display"
},
```
- Run command `composer update yevhenii_rodkin/latest-posts-display` in the system console (root WordPress folder);
- Commit and push **composer.json** and **composer.lock** files.

## Plugin Structure
```
- latest-posts-displays.php - Main plugin file (entry point).
- assets                    - Styles, scripts, images, etc.
- build                     - Compiled styles and scripts
- inc                       - Core functionality in PHP
- templates                 - Templates with markup that should be used in render methods
```
