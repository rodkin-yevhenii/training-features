# Blog Post Popularity Analysis  plugin

The plugin allows to analyze blog posts popularity directly within the WordPress admin dashboard. It tracks blog post
views and displays insights on the most viewed content. Also this plagin registered `[most_popular_posts]`  shortcode.
This shordcode shows on the frontend the most viewed post. One more feature that provide custom WP CLI commands that
can generate demo analitics data or remove all analytics data.

## Dashdoard

The plugin register a new page with custom dashboard in the Posts menu.

![](https://github.com/rodkin-yevhenii/training-features/blob/images/posts-popularity-analysis/dashboard.png)

There are you can find anatics data with total views number. The site administator can clear all data (red button).

**Feel free to use**:
- Search;
- Sorting;
- Filter by time range;
- Pagination;
- Manage the number of visible posts;

## The most popular posts shortcode

This `[most_popular_posts]` shordcode shows the most popular posts on the frontent. The number of posts can be changed.
Also, you can show posts that have been published in a specified time interval. To increase the site performance we
added to transient cache the data of the most popular posts. All analytics data stored in the custom table. This table
will be removed when you decide to remove the plugin.

![](https://github.com/rodkin-yevhenii/training-features/blob/images/posts-popularity-analysis/shortcode.png)

**Shortcode attributes**
- **limit** - set the number of visible posts;
- **start_date** - show the posts that has been puplished at that date or after. Date format: YYYY-MM-DD;
- **end_date** - show the posts that has been puplished at that date or before. Date format: YYYY-MM-DD;

## Custom `wp cli` commands
### Reset analytics data
`wp bppa reset` - This command remove all data from the table in the database. It doesn't have any arguments or flags.

###  Generate demo data
`wp bppa generate` - Generate demo data for the dashboard. All views records will have current date. It doesn't have
any arguments and support some `limit` flag.t magage have many

The `limit` flag manage have many posts will be added to the demo data. I'd recommend to set more than 20th posts.
**Pay attention** this feature add demo data for already published posts, so if you have 5 published posts but you've set
limit 50, you will see just 5 posts in the dashboard.

## Requirements
- PHP >= 8.0
- WordPress >= 5.6

## Installation
1. Clone plugin repository into your Plugins folder in the WordPress folder. Run these commands in the plugin folder:
```
mkdir posts-popularity-analysis
cd posts-popularity-analysis
git clone git@github.com:rodkin-yevhenii/training-features.git .
git checkout plugins/posts-popularity-analysis-plugin
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

## Useful commands
`composer lint <file/folder>` - run php linter for specific file/folder. Uses WordPress standards;

`composer fixer <file/folder>` - run php code beautifier  for specific file/folder. Uses WordPress standards;

`composer fix <file/folder>` - run php code beautifier  and linter;

`npm run start:js` - run JS watcher;

`npm run build:js` - run JS builder;

`npm run start:sass` - run scss watcher;

`npm run build:sass` - run scss builder;

`npm run start` - run watcher for scripts and styles;

`npm run build` - run builder for scripts and styles;

## Plugin structure
```
- posts-popularity-analysis.php - main plugin file (entrypoint);
- assets                        - styles, scripts, image, etc;
- public                        - compiled styles and scripts;
- inc                           - Core functionality, busines logic;
- templates                     - templetes with markup;
```

## Contacts
- **Author**: Yevhenii Rodkin
- **Email**: rodkin.yevhenii@gmail.com
- **LinkedIn**: https://www.linkedin.com/in/yevhenii-rodkin/
