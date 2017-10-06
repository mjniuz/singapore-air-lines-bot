let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

// mix.js('resources/assets/js/app.js', 'public/js')
//    .sass('resources/assets/sass/app.scss', 'public/css');

// mix.js('resources/assets/js/front.js', 'public/js/app.min.js');
// css
mix.combine([
	'resources/assets/css/bootstrap.min.css',
	'resources/assets/css/app.css', 
	'resources/assets/css/style.css',
	], 'public/css/site.min.css');
// javascripts
mix.js([
	'resources/assets/js/bootstrap.min.js',
	'resources/assets/js/front.js', 
	], 'public/css/js/app.min.js');