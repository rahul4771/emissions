<?php

use App\Http\Controllers\Splits\Desktop\Split_HFDC_V1_Controller;
use App\Http\Controllers\Splits\Desktop\Split_HFDC_V2_Controller;
use App\Http\Controllers\Splits\Desktop\Split_HFDC_V3_Controller;
use App\Http\Controllers\Splits\Desktop\Split_HFDC_V4_Controller;
use App\Http\Controllers\Splits\Desktop\ConfirmController;
use App\Http\Controllers\Splits\Desktop\ThankyouController;
//use App\Http\Controllers\Splits\SignatureController;
use App\Http\Controllers\Followup\FollowupController;
use App\Http\Controllers\Followup\FollowupAnalyzeController;


Route::get('/HFDC_V1', [Split_HFDC_V1_Controller::class, 'index'])->name('Split_HFDC_V1.index');
Route::post('/HFDC_V1', [Split_HFDC_V1_Controller::class, 'store'])->name('Split_HFDC_V1.store');

Route::get('/HFDC_V2', [Split_HFDC_V2_Controller::class, 'index'])->name('Split_HFDC_V2.index');
Route::post('/HFDC_V2', [Split_HFDC_V2_Controller::class, 'store'])->name('Split_HFDC_V2.store');

Route::get('/HFDC_V3', [Split_HFDC_V3_Controller::class, 'index'])->name('Split_HFDC_V3.index');
Route::post('/HFDC_V3', [Split_HFDC_V3_Controller::class, 'store'])->name('Split_HFDC_V3.store');

Route::get('/HFDC_V4', [Split_HFDC_V4_Controller::class, 'index'])->name('Split_HFDC_V4.index');
Route::post('/HFDC_V4', [Split_HFDC_V4_Controller::class, 'store'])->name('Split_HFDC_V4.store');

Route::get('/HFDC_V4_final_index',[Split_HFDC_V4_Controller::class,'final_index'])->name('HFDC_V4_final_index');
Route::post('/HFDC_V4_final_store',[Split_HFDC_V4_Controller::class,'final_store'])->name('Split_HFDC_V4.final_store');
Route::get('/intermediate_thankyou',[ThankyouController::class,'intermediateThankYou'])->name('intermediate_thankyou');
Route::get('analyzing_request',[ThankyouController::class,'anayzingRequest'])->name('analyzing_request');
Route::get('/web/analyze-end',[ThankyouController::class,'analyzeEndPage'])->name('web/analyze-end');
Route::get('/web/thankyou',[ThankyouController::class,'index'])->name('web/thankyou');

Route::get('/web/thankyou-error',[ThankyouController::class,'errorPage'])->name('web/thankyou-error');
Route::post('/web/thankyou',[ThankyouController::class,'store'])->name('web.thankyou.store');
Route::get('/web/thankyou-unqualified',[ThankyouController::class,'unqualified'])->name('web/thankyou-unqualified');
Route::get('/web/thanx',[ThankyouController::class,'visitorUnqualified'])->name('web/thanx');


//Route::get('/web/confirm', [ConfirmController::class, 'index'])->name('confirm');
//Route::post('/web/confirm', [ConfirmController::class, 'store'])->name('web.confirm.store');


// followup Routes
Route::get('/followup', [FollowupController::class, 'index'])->name('followup.index');
Route::post('/followup', [FollowupController::class, 'store'])->name('followup.store');
Route::get('/followup-anayzing-request', [FollowupAnalyzeController::class, 'followupAnayzingRequest'])->name('followup.anayzingrequest');
Route::get('/followup/analyze-end', [FollowupAnalyzeController::class,'followupAnalyzeEndPage'])->name('followup/analyze-end');