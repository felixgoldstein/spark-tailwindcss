const mix = require('laravel-mix');

require('laravel-mix-tailwind');
require('laravel-mix-purgecss');

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
  .js('resources/js/app.js', 'public/js')
  .sass('resources/css/app.scss', 'public/css')
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
  })
  .tailwind('./tailwind.config.js');

if (mix.inProduction()) {
  mix
   .version()
   .purgeCss();
}
