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
Route::post('/signin', 'Api\AdminController@signin');

Route::group([], function () {

    Route::resource('users', 'Api\UserController')
        ->only(['index', 'store', 'destroy']);

    Route::resource('user-types', 'Api\UserTypeController')
        ->only(['index', 'store', 'destroy']);

    Route::resource('unit-of-measures', 'Api\UnitOfMeasureController')
        ->only(['index', 'store', 'destroy']);

    Route::resource('style-types', 'Api\StyleTypeController')
        ->only(['index', 'store', 'destroy']);

    Route::resource('style-locations', 'Api\StyleLocationController')
        ->only(['index', 'store', 'destroy']);

    Route::resource('sizes', 'Api\SizeController')
        ->only(['index', 'store', 'destroy']);

    Route::resource('sales-person-types', 'Api\SalesPersonTypeController')
        ->only(['index', 'store', 'destroy']);

    Route::resource('sales-persons', 'Api\SalesPersonController')
        ->only(['index', 'store', 'destroy']);

    Route::resource('prices', 'Api\PriceController')
        ->only(['index', 'store', 'destroy']);

    Route::resource('price-types', 'Api\PriceTypeController')
        ->only(['index', 'store', 'destroy']);

    Route::resource('price-steps', 'Api\PriceStepController')
        ->only(['index', 'store', 'destroy']);

    Route::resource('price-options', 'Api\PriceOptionController')
        ->only(['index', 'store', 'destroy']);

    Route::resource('organizations', 'Api\OrganizationController')
        ->only(['index', 'store', 'destroy']);

    Route::resource('organization-types', 'Api\OrganizationTypeController')
        ->only(['index', 'store', 'destroy']);

    Route::resource('lengths', 'Api\LengthController')
        ->only(['index', 'store', 'destroy']);

    Route::resource('currencys', 'Api\CurrencyController')
        ->only(['index', 'store', 'destroy']);

    Route::resource('contact-types', 'Api\ContactTypeController')
        ->only(['index', 'store', 'destroy']);

    Route::resource('component-types', 'Api\ComponentTypeController')
        ->only(['index', 'store', 'destroy']);



    // Route::group(['prefix' => 'users'], function () {
    // 	Route::delete('/', 'UserController@delete');
    // 	Route::post('/', 'UserController@store');
    // 	Route::get('/', 'UserController@index');
    	
    // });
});