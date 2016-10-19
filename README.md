# WordPress Starter Theme

Version: 2.0.0

## Author:

- Thanh Hoang
- Thuan Nguyen
- Vuong Nguyen

## Contributor:

Anyone and everyone is welcome to contribute!
Please feel free to fork this repository and send us a pull request.

## Summary

WordPress Starter Theme for use as a starting template for building custom themes. Using modern front-end stack like SASS, Javascript ES6, Bower for dependencies management and Gulp for all processing tasks. Syncs changes across local development devices with BrowserSync.

## Usage

The theme is setup to use [Gulp](http://gruntjs.com/) to compile SCSS (with source maps), run it through [AutoPrefixer](https://github.com/ai/autoprefixer), lint, concatenate and minify JavaScript (with source maps), optimize images, and syncs changes across local development devices with [BrowserSync](https://github.com/shakyShane/browser-sync), with flexibility to add any additional tasks via the Gulpfile.

- Install dependencies by running `bower install`
- Install package by running `npm install` (maybe require `sudo npm install`)
- Edit your theme information in `src/scss/_config.scss`
- Change your theme folder name in `gulpfile.js`
- Using gulp to execute tasks by running `gulp`
- Update your styling in `assets/scss/*`
- Update your JS files in `assets/scripts/*`

### Deployment

- Run `gulp build` to build the production theme
- Add `screenshot.png` to the production theme

### Features

1. Normalized stylesheet for cross-browser compatibility using Normalize.css version 3 (IE8+)
2. Easy to customize
3. Gulp for processing all SASS, JavaScript and images, and cross-device refreshing with BrowserSync
4. Flexible grid like Bootstrap
5. Media Queries can be nested in each selector using SASS
6. SCSS with plenty of mixins ready to go

### Suggested Plugins

* [Advanced Custom Field Pro](http://www.advancedcustomfields.com)
* [Gravity Forms](http://www.gravityforms.com/)
* [WordPress SEO by Yoast](http://wordpress.org/extend/plugins/wordpress-seo/)
* [Google Analytics for WordPress by Yoast](http://wordpress.org/extend/plugins/google-analytics-for-wordpress/)
* [W3 Total Cache](http://wordpress.org/extend/plugins/w3-total-cache/)

### Credits

Without these projects, this WordPress Starter Theme wouldn't be where it is today.

* [Normalize.css](http://necolas.github.com/normalize.css)
* [Browserify] (http://browserify.org)
* [SASS / SCSS](http://sass-lang.com/)
* [AutoPrefixer](https://github.com/ai/autoprefixer)
* [BrowserSync](https://github.com/shakyShane/browser-sync)
* [Gulp](http://gulpjs.com)
