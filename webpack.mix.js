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

mix.copy('node_modules/sweetalert2/dist/sweetalert2.all.min.js', 'public/assets/js/app.js')
    .copy('resources/assets','public/assets')
    .js('resources/js/app.js', 'public/assets/js/in18.js')
