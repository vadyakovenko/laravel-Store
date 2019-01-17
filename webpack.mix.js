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

mix.scripts([
   // 'resources/vendor/jquery/jquery-3.2.1.min.js',
   // 'resources/vendor/animsition/js/animsition.min.js',
   // 'resources/vendor/bootstrap/js/popper.js',
   // 'resources/vendor/bootstrap/js/bootstrap.min.js',
   // 'resources/vendor/select2/select2.min.js',
   // 'resources/vendor/daterangepicker/moment.min.js',
   // 'resources/vendor/daterangepicker/daterangepicker.js',
   // 'resources/vendor/slick/slick.min.js',
      //'resources/js/slick-custom.js',
   // 'resources/vendor/parallax100/parallax100.js',
   // 'resources/vendor/MagnificPopup/jquery.magnific-popup.min.js',
   // 'resources/vendor/isotope/isotope.pkgd.min.js',
   // 'resources/vendor/sweetalert/sweetalert.min.js',
   // 'resources/vendor/perfect-scrollbar/perfect-scrollbar.min.js',
   'resources/js/main.js'
], 'public/js/app.js');

mix.styles([
      //'resources/css/until.css',
      'resources/css/main.css'
      // 'resources/vendor/bootstrap/css/bootstrap.min.css',
      // 'resources/fonts/font-awesome-4.7.0/css/font-awesome.min.css',
      // 'resources/fonts/iconic/css/material-design-iconic-font.min.css',
      // 'resources/fonts/linearicons-v1.0.0/icon-font.min.css',
      // 'resources/vendor/animate/animate.css',
      // 'resources/vendor/css-hamburgers/hamburgers.min.css',
      // 'resources/vendor/animsition/css/animsition.min.css',
      // 'resources/vendor/select2/select2.min.css',
      // 'resources/vendor/daterangepicker/daterangepicker.css',
      // 'resources/vendor/slick/slick.css',
      // 'resources/vendor/MagnificPopup/magnific-popup.css',
      // 'resources/vendor/perfect-scrollbar/perfect-scrollbar.css'
   ], 'public/css/app.css');

   mix.styles([
      'resources/admin/css/custom.css'

   ], 'public/css/custom.css');

mix.copy('resources/fonts', 'public/fonts');
mix.copy('resources/admin', 'public/admin');