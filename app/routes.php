<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/','BaseController@getIndex');
//Route::controller('account','AccountController');
Route::controller('cases','CasesController');
    Route::get('account/activate/{code}','AccountController@getActivate');
    Route::get('account/ppt','AccountController@getPpt');
Route::group(array('before'=>'auth'),function(){
   Route::get('account/logout','AccountController@getLogout');
    Route::get('account/change-password','AccountController@getChangePassword');
    Route::post('account/change-password','AccountController@postChangePassword');
    Route::get('account/create-password','AccountController@getCreatePassword');
});
Route::group(array('before'=>'guest'),function(){
   Route::get('account/create','AccountController@getCreate');
   Route::post('account/create','AccountController@postCreate');
   Route::post('account/login','AccountController@postLogin');
   Route::get('account/login','AccountController@getLogin');
   Route::get('account/forget-password','AccountController@getForgetPassword');
   Route::post('account/forget-password','AccountController@postForgetPassword');
   Route::get('account/recover/{code}','AccountController@getRecover');
});
Route::group(array('before'=>'auth'),function(){

});