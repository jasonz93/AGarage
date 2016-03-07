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


elixir(function(mix) {
    mix.styles(['bootstrap.min.css'], 'public/css/base.css');
    mix.scripts(['jquery.min.js', 'bootstrap.min.js'], 'public/js/base.js');
    mix.copy('resources/assets/markdown', 'public/markdown');
    mix.exec('php artisan migrate');
});
