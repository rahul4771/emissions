const mix = require('laravel-mix');
require('dotenv').config();

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


mix.copyDirectory('resources/assets/HFDC_V1/img', 'public/assets/HFDC_V1/img');
mix.js('resources/assets/HFDC_V1/js/app.js', 'public/assets/HFDC_V1/js')
  .autoload({
    jquery: ['$', 'window.jQuery', 'jQuery'],
  })
  .sass('resources/assets/HFDC_V1/scss/main.scss', 'public/assets/HFDC_V1/css')
  .options({
    processCssUrls: false,
  });

mix.copyDirectory('resources/assets/HFDC_V2/img', 'public/assets/HFDC_V2/img');
mix.js('resources/assets/HFDC_V2/js/app.js', 'public/assets/HFDC_V2/js')
  .autoload({
    jquery: ['$', 'window.jQuery', 'jQuery'],
  })
  .sass('resources/assets/HFDC_V2/scss/main.scss', 'public/assets/HFDC_V2/css')
  .options({
    processCssUrls: false,
  });
    
mix.copyDirectory('resources/assets/web-thankyou/img', 'public/assets/web-thankyou/img');
mix.js('resources/assets/web-thankyou/js/app.js', 'public/assets/web-thankyou/js')
  .autoload({
        jquery: ['$', 'window.jQuery', 'jQuery'],
    })

    .sass('resources/assets/web-thankyou/scss/main.scss', 'public/assets/web-thankyou/css')
    .options({
        processCssUrls: false,
    });

mix.copyDirectory('resources/assets/intermediate_thankyou/img', 'public/assets/intermediate_thankyou/img');
mix.js('resources/assets/intermediate_thankyou/js/app.js', 'public/assets/intermediate_thankyou/js')
  .autoload({
    jquery: ['$', 'window.jQuery', 'jQuery'],
  })
  .sass('resources/assets/intermediate_thankyou/scss/main.scss', 'public/assets/intermediate_thankyou/css')
  .options({
    processCssUrls: false,
  });

mix.copyDirectory('resources/assets/analyzing_request/img', 'public/assets/analyzing_request/img');
mix.js('resources/assets/analyzing_request/js/app.js', 'public/assets/analyzing_request/js')
  .autoload({
    jquery: ['$', 'window.jQuery', 'jQuery'],
  })
  .sass('resources/assets/analyzing_request/scss/main.scss', 'public/assets/analyzing_request/css')
  .options({ 
    processCssUrls: false,
  });


mix.copyDirectory('resources/assets/unqualified-thankyou/img', 'public/assets/unqualified-thankyou/img');
mix.js('resources/assets/unqualified-thankyou/js/app.js', 'public/assets/unqualified-thankyou/js')
  .autoload({
      jquery: ['$', 'window.jQuery', 'jQuery'],
  })
  .sass('resources/assets/unqualified-thankyou/scss/main.scss', 'public/assets/unqualified-thankyou/css')
  .options({
      processCssUrls: false,
  });
 
  
mix.copyDirectory('resources/assets/followup/img', 'public/assets/followup/img');
mix.copyDirectory('resources/assets/followup/fonts', 'public/assets/followup/fonts');
mix.js('resources/assets/followup/js/app.js', 'public/assets/followup/js')
  .autoload({
    jquery: ['$', 'window.jQuery', 'jQuery'],
  })
  .sass('resources/assets/followup/scss/main.scss', 'public/assets/followup/css')
  .options({
    processCssUrls: false,
  });    

mix.copyDirectory('resources/assets/HFDC_V3/img', 'public/assets/HFDC_V3/img');
mix.js('resources/assets/HFDC_V3/js/app.js', 'public/assets/HFDC_V3/js')
  .autoload({
    jquery: ['$', 'window.jQuery', 'jQuery'],
  })
  .sass('resources/assets/HFDC_V3/scss/main.scss', 'public/assets/HFDC_V3/css')
  .options({
    processCssUrls: false,
  });

mix.copyDirectory('resources/assets/HFDC_V4/img', 'public/assets/HFDC_V4/img');
mix.js('resources/assets/HFDC_V4/js/app.js', 'public/assets/HFDC_V4/js')
  .autoload({
    jquery: ['$', 'window.jQuery', 'jQuery'],
  })
  .sass('resources/assets/HFDC_V4/scss/main.scss', 'public/assets/HFDC_V4/css')
  .options({
    processCssUrls: false,
  });