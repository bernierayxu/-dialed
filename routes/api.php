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

Route::resource('users', 'Api\UserController')
    ->only(['index', 'store', 'destroy']);

// Route::group(['prefix' => 'users'], function () {
// 	Route::delete('/', 'UserController@delete');
// 	Route::post('/', 'UserController@store');
// 	Route::get('/', 'UserController@index');
	
// });