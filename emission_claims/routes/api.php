<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['namespace' => 'Api','prefix'=>'v1'], function () {    
    
	//Route::get('/test','TestController@index');	
	Route::get('/buyer_response','BuyerResponseController@buyerApiResponse');	

});
