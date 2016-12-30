var gulp = require('gulp');
var elixir = require('laravel-elixir');

elixir(function(mix) {
  mix.sass([
		'app.scss'
	], 'public/style/app.css')

  mix.sass([
		'app-login.scss'
	], 'public/style/app-login.css')

  mix.scripts([
    'framework/jquery/jquery-3.1.1.js'
  ], 'public/javascript/jquery.min.js')

  mix.scripts([
    'framework/chartjs-2.4.0/Chart.bundle.js',
    'framework/chartjs-2.4.0/Chart.js',
    'framework/tether-1.3.3/tether.js',
    'framework/bootstrap4/bootstrap.js',
    'framework/ajax_callback.js',
    'lib/users.js',
    'lib/rooms.js',
    'app.js'
  ], 'public/javascript/app.min.js')
});
