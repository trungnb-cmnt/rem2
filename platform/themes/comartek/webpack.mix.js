let mix = require('laravel-mix');

const resourcePath = 'platform/themes/comartek';
const publicPath = 'public/themes/comartek';

mix
    .sass(resourcePath + '/assets/sass/style.scss', publicPath + '/css')
    .copy(publicPath + '/css/style.css', resourcePath + '/public/css')
    .js(resourcePath + '/assets/js/ripple.js', publicPath + '/js')
    .js(resourcePath + '/assets/js/script.js', publicPath + '/js')
    .copy(publicPath + '/js/ripple.js', resourcePath + '/public/js')
    .copy(publicPath + '/js/script.js', resourcePath + '/public/js');
