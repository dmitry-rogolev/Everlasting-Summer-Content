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

// require('postcss-import'),
// require('tailwindcss'),
// require('autoprefixer'),

mix.sass('resources/scss/app.scss', 'public/css')
.sass("resources/scss/themes/light.scss", "public/css/themes")
.sass("resources/scss/themes/dark.scss", "public/css/themes")
.js("resources/js/app.js", "public/js");
