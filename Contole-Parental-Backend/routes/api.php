<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'auth'], function () {

    Route::post('token', 'AuthController@login');
    Route::post('signin','UserController@store');
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('user', 'AuthController@user');
        Route::delete('token', 'AuthController@logout');
   });

});

Route::group(['prefix' => 'users'],function(){
    Route::get('/{id}','UserController@show');
});

Route::group(['middleware' => 'auth:api'],function(){
    Route::group(['prefix' => 'chats'], function () {
        Route::post('', 'ChatController@newMessage');
        Route::get('/discussion/{id}', 'ChatController@discussionMessage');
        Route::get('/discussion/{id}/newmessages', 'ChatController@getNewMessages');
        Route::delete('/discussion/{id}', 'ChatController@deleteDiscussion');
        Route::delete('/{id}', 'ChatController@deleteMessage');
        Route::get('/discussions/{id}', 'ChatController@getDiscussions');
    });
    
});
