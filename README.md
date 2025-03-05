# Blog Post Popularity Analysis  plugin

The plugin allows to analyze blog posts popularity directly within the WordPress admin dashboard. It tracks blog post
views and displays insights on the most viewed content. Also this plagin registered `[most_popular_posts]`  shortcode.
This shordcode shows on the frontend the most viewed post.

## Requirements
- PHP >= 8.0
- WordPress >= 5.6

## Installation
1. Clone plugin repository into your Plugins folder in the WordPress folder. Run these commands in the plugin folder:
```
mkdir posts-popularity-analysis
cd posts-popularity-analysis
git clone git@github.com:rodkin-yevhenii/training-features.git .
git checkout plugins/posts-popularity-analusis-plugin
git pull origin plugins/posts-popularity-analusis-plugin
```
2. Install coposer dependecies. Run these commands in the plugin root folder:

Production:
```
composer install --no-dev
```

Local server for development:
```
composer install
```
In this case you will instal phpcs and phpcbf tools with WordPress code-standards.

3. Install node modules. Run these commands in the plugin root folder:

Production:
```
npm i --omit=dev
```

Local server for development:
```
npm i
```
In this case you will instal sass module.

4. Go to the admin panel and activate the plugin.
