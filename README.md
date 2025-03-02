# Latest Posts Display plugin

It's a simple wordpress plugin that provides the `[latest_posts]` shordcode to display a list of latest posts

![](https://github.com/rodkin-yevhenii/training-features/blob/images/latest-posts-display/screenshot.png)

## Available Shortcode variatins

- `[latest_posts]` - display 10 latest posts;
- `[latest_posts count=6]` - display  6 latest posts. You can use any number istaed of 6 but we recommend using numbers
that are multiples of 2;

## Performance
To improve website performance, the latest posts data is stored in the Transient cache. The
updated data will be displayed on the front end within 5 minutes (cache lifespan).

## Instalation
### Via admin panel
- Download the archive with codebase from the GitHub repository;
- Upload this archive to the site. Use uploader on the "**Add Plugins**" page (`/wp-admin/plugin-install.php`) in the
admin panel;
- Activate the plugin on the Plugins page in the admin panel;

### Via composer
The installation of packages should be configured on your server.
- Add `"yevhenii_rodkin/latest-posts-display": "dev-master"` to the `require` section of **composer.json** in the WordPress
root folder;
- Add the code below to the `repositories` section of **composer.json** in the WordPress root folder;
```json
"catena-hub-plugin": {
  "type": "vcs",
  "url": "https://github.com/CatenaUS/Catena-HUB-Plugin"
},
```
- Run command `composer update yevhenii_rodkin/latest-posts-display` in the system console (root WordPress folder);
- Commit and push **composer.json** and **composer.lock** files.

## Plugin Structure
```
- latest-posts-displays.php - Main plugin file (entrypoint).
- assets                    - Styles, scripts, image, etc.
- build                     - Compiled styles and scripts
- inc                       - Core functionality in PHP
- templates                 - Templetes with markup that should be used in render methods
```
