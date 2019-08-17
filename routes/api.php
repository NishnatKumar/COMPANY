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
Route::middleware(['cors'])->group(function(){
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');

Route::post('admins', 'API\UserController@adminregister');

Route::group(['middleware' => 'auth:api'], function(){

    Route::get('users','API\UserController@getUsers');

    Route::post('details', 'API\UserController@details');
    Route::post('document-upload', 'API\DocumentController@uploadDocument');

    Route::post('document-get', 'API\DocumentController@getDocuments');
    Route::post('document-status', 'API\DocumentController@changeStatus');
});

});
