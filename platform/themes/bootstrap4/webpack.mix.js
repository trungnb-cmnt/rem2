let mix = require('laravel-mix');

const resourcePath = 'platform/themes/bootstrap4';
const publicPath = 'public/themes/bootstrap4';

mix
    .sass(resourcePath + '/assets/sass/app.scss', publicPath + '/css')
    .copy(publicPath + '/css/app.css', resourcePath + '/public/css')
    .js(resourcePath + '/assets/js/app.js', publicPath + '/js').autoload({ jquery: ['$', 'window.jQuery', 'jQuery'] })
    .copy(publicPath + '/js/app.js', resourcePath + '/public/js');
