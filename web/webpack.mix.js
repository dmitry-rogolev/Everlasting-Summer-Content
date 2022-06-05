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

mix.postCss('resources/css/app.css', 'public/css', 
[
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer'),
])
.postCss("resources/css/theme/light.css", "public/css/theme", 
[
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer'),
])
.postCss("resources/css/theme/dark.css", "public/css/theme", 
[
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer'),
]);
