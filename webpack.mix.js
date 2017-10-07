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

mix.js([
    // 'resources/assets/js/jquery.min.js',
    // 'node_modules/jquery/dist/jquery.min.js',
    // 'resources/assets/js/app.min.js',
    // 'resources/assets/js/bootstrap.min.js',
    // 'resources/assets/js/bootstrap-timepicker.min.js',
    'resources/assets/js/front.js',
    'node_modules/sweetalert2/dist/sweetalert2.min.js',
    'resources/assets/js/main.js',
], 'public/js/app.min.js');
mix.combine([
    'node_modules/sweetalert2/dist/sweetalert2.min.css',
	'resources/assets/css/app.css', 
	'resources/assets/css/style.css',
    'resources/assets/css/check-in.css',
	], 'public/css/site.min.css');
