<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Common Routes
Route::get('/','HomeController@index')->name('home');
Route::get('/fb-pixel', 'HomeController@fbPixelFire')->name('fb-pixel');
Route::get('/fb-pixel.php', 'HomeController@fbPixelFire')->name('fb-pixel');

//Split routes
Route::prefix('')->group(base_path('routes/web/splits.php'));

// Test Routes
Route::prefix('')->group(base_path('routes/web/test.php'));

// Ajax Routs
Route::prefix('')->group(base_path('routes/web/ajax.php'));

// sentry checking
Route::get('/sentry/test', function () { 
    throw new Exception('My first Sentry error'); 
});



