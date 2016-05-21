var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir.config.sourcemaps = false;

elixir(function(mix) {
    mix.sass('app.scss', 'public/css');
    mix.scripts([
        'thirdparty/bootstrap.js',
        'thirdparty/highlight.js',
        'thirdparty/sweetalert.js',
        'thirdparty/uploadcare.js',
        'app.js',
    ], 'public/js/app.js');
});
