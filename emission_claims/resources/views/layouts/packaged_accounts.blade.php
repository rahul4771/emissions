<!DOCTYPE html>
<html lang="en">
   <head>
      @yield('gtmhead')
      <meta charset="utf-8">
      @yield('title')
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="">
      <meta name="author" content="">
      <meta name="csrf-token" content="{{ csrf_token() }}" />
      <link href="{{ $resourcePath }}css/main.css" rel="stylesheet" type="text/css">
      <link rel="icon" type="image/png" href="{{ $resourcePath }}img/favicon.png">
   </head>
   <body>
      @yield('gtmbody')
      <div class="col-lg-12 d-none d-sm-none d-md-none  d-lg-block adv_head text-center">
         <p>Advertorial</p>
      </div>      
      <header>
         <div class="container">
            <div class="row">
               <div class="col-lg-3 col-md-4 col-sm-12 col-12 logo">
                  <a class="btn_optimize" data-id="SITE_LOGO" href="#"> 
                     <img src="{{ $resourcePath }}img/logo.png" alt="Logo"> 
                  </a>
               </div>
               <div class="col-lg-9 col-md-8 col-sm-12 col-12 top_bnr d-none d-sm-none d-md-block d-lg-block">
                  <a href="{{ $data['redirect_url'] }}" data-id="TOP_SITE_BANNER">
                     <img src="{{ $resourcePath }}img/right_hed.jpg" alt="">
                  </a>
               </div>
               <h1>Married Couples Are Getting Up To £1,188 In Tax Breaks – Here’s How To Join Them</h1>

            </div>
         </div>
      </header>
      
<!--       <header>
         <div class="container">
            <div class="row">
               <div class="col-lg-12 col-md-12 d-none d-sm-block text-center">
                  <p>Advertorial</p>
               </div>
               <div class="col-lg-4 col-md-4 col-sm-6 col-7 ">
                  <a href="{{ $data['redirect_url'] }}"><img src="{{ $resourcePath }}img/logo.png" alt="" class="logo" data-id="SITE_lOGO"></a>
               </div>
               <div class="col-lg-8 col-md-8 d-none d-md-block bnr_top">
                  <a href="{{ $data['redirect_url'] }}" data-id="TOP_SITE_BANNER"> <img src="{{ $resourcePath }}img/Top_banner.jpg" alt=""> </a>
               </div>
               <div class="d-sm-none col-sm-6 col-5 mob_view text-center">
                  <p>Advertorial</p>
               </div>
            </div>
         </div>
      </header> -->
      @yield('content')
      @yield('script')
      @include('includes.advertorials.advertorialsclicktrack',[])
      
   </body>
</html>