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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'posts'], function () {
    Route::get('/', 'PostController@index');
    Route::get('{id}', 'PostController@show');
});

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});

Route::group(['prefix' => 'posts'], function () {
    Route::get('/', 'PostController@index');
    Route::get('{id}', 'PostController@show');
    Route::group(['middleware' => 'checkAuthor'], function () {
        Route::post('store', 'PostController@store');
    });
    Route::group(['middleware' => 'isAuthorOrModer'], function () {
        Route::post('update/{post}', 'PostController@update');
        Route::delete('delete/{post}', 'PostController@delete');
    });
});
