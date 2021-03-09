const mix = require('laravel-mix');

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

mix.js('resources/admin/js/admin.js', 'administrator/components/com_mrnegociosverde/js').vue()
   .sass('resources/admin/css/admin.scss', 'administrator/components/com_mrnegociosverde/css')
   //.sass('resources/admin/css/template.scss', 'administrator/templates/isis/css/')
   .js('resources/site/js/site.js', 'components/com_mrnegociosverde/views/mrnegociosverde/tmpl/js').vue()
   .sass('resources/site/css/site.scss', 'components/com_mrnegociosverde/views/mrnegociosverde/tmpl/css')
   .webpackConfig(require('./webpack.config'))


if (mix.inProduction()) {
    mix.version();
}
