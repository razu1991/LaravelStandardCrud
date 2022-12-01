const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/assets/js')
    .scripts([
        'public/assets/js/app.js',
        'resources/js/plugins/toastr.min.js'
    ], 'public/assets/js/all.js')
    .sass('resources/scss/app.scss','public/assets/css')
    .styles([
        'public/assets/css/app.css',
        'resources/scss/plugins/toastr.min.css'
    ], 'public/assets/css/all.css');
