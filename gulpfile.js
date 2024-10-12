var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.copy('resources/assets/img','public/img');
    mix.copy('vendor/acacha/admin-lte-template-laravel/public/css/skins','public/css/skins');
    mix.copy('vendor/acacha/admin-lte-template-laravel/public/plugins','public/plugins');
    mix.copy('vendor/acacha/admin-lte-template-laravel/public/js','public/js');
    mix.copy('vendor/acacha/admin-lte-template-laravel/public/img','public/img');
    mix.copy('node_modules/bootstrap-sass/assets/fonts','public/fonts');
    mix.less('app.less');
    mix.less('admin-lte/AdminLTE.less');
    mix.less('bootstrap/bootstrap.less');
    mix.webpack('app.js');
});

