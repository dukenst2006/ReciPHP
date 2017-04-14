const {mix} = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
    .stylus('resources/assets/stylus/app.styl', 'public/css')
    .combine(["public/css/app.css", "node_modules/vue-animate/dist/vue-animate.min.css"], "public/css/app.css");