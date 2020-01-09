const mix = require('laravel-mix');

mix.webpackConfig({devtool: 'source-map'})
    .sourceMaps()
    .version()
    .js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');
