<?php 

use App\Http\Controllers\Ajax\AjaxController;

Route::get('/ajax/ajax-postcode-val',[AjaxController::class, 'postcodeValidation']);
Route::get('/ajax/get-addr-list-postcode-api',[AjaxController::class, 'getAddrListPostCodeAPI']);
Route::get('/ajax/ajax-phone-val',[AjaxController::class, 'getAjaxPhoneVal']);
Route::get('/ajax/get-addr-split-postcode-api',[AjaxController::class, 'getAddrSplitPostCodeAPI']);
Route::get('/ajax/ajax-email-val',[AjaxController::class, 'getAjaxEmailVal']);
Route::get('ajax/ajax-get-user-id',[AjaxController::class, 'getUserIdUsingEmail']);
Route::get('/ajax/ajax-update-resolution',[AjaxController::class, 'updateScreenSize']);
Route::get('/ajax/get-500-error-feedback-api',[AjaxController::class, 'usersFeedback']);
Route::get('/ajax/ajax-carno-val',[AjaxController::class, 'carregnoValidation']);
Route::get('/ajax/ajax-keeper-val',[AjaxController::class, 'findCarKeepers']);


Route::get('/ajax/ajax-find-keeper-date',[AjaxController::class, 'getKeeperDate']);
Route::get('/ajax/ajax-carno-val-followup',[AjaxController::class, 'carregnoValidationFollowup']);