let mix = require('laravel-mix');
require('laravel-mix-purgecss');
let exec = require('child_process').exec;
let path = require('path');

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

mix
    .sass('resources/sass/app.scss', 'public/css')
    .js('resources/js/app.js', 'public/js')
    .copy('node_modules/sweetalert2/dist/sweetalert2.min.js', 'public/js/sweetalert.min.js')
    .webpackConfig({
        resolve: {
            modules: [
                path.resolve(__dirname, 'vendor/laravel/spark-aurelius/resources/assets/js'),
                'node_modules'
            ],
            alias: {
                'vue$': mix.inProduction() ? 'vue/dist/vue.min' : 'vue/dist/vue.js'
            }
        }
    });


if (mix.inProduction()) {
    mix.version();
}


mix.postCss('resources/css/tailwind.css', 'public/css/app.css', [
    require('postcss-import'),
    require('tailwindcss'),
]);

if (mix.inProduction()) {
    mix.purgeCss();
}
