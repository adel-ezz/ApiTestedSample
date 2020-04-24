<?php


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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


//===user before login
Route::post('login','Api\UserController@login');


//
Route::group(['middleware'=>'auth:api','namespace'=>'Api'],function (){

    //===list user message
    Route::get('/messageList','ChatController@index');
    //===Get message By id
    Route::get('/message/{id}','ChatController@show');
    //===list Archived message
    Route::get('/archive','ChatController@archivedMessage');
    //===Set Message To Archive
    Route::post('/archive','ChatController@setToArchive');

});
