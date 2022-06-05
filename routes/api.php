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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['middleware' => 'api_key_auth'], function() {
    Route::get('products', 'App\Http\Controllers\Api\ProductController@index');
    Route::post('products', 'App\Http\Controllers\Api\ProductController@store');
    Route::get('products/{id}', 'App\Http\Controllers\Api\ProductController@show');
    Route::patch('products/{id}', 'App\Http\Controllers\Api\ProductController@update');
    Route::delete('products/{id}', 'App\Http\Controllers\Api\ProductController@destroy');
    Route::post('products/search', 'App\Http\Controllers\Api\ProductController@search');

    Route::get('categories', 'App\Http\Controllers\Api\CategoryController@index');
    Route::post('categories', 'App\Http\Controllers\Api\CategoryController@store');
    Route::get('categories/{id}', 'App\Http\Controllers\Api\CategoryController@show');
    Route::patch('categories/{id}', 'App\Http\Controllers\Api\CategoryController@update');
    Route::delete('categories/{id}', 'App\Http\Controllers\Api\CategoryController@destroy');
    Route::post('categories/search', 'App\Http\Controllers\Api\CategoryController@search');
});
