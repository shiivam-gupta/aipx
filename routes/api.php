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

// Route::group(['namespace' => 'Api', 'prefix' => 'api'], function () {
	Route::post('login', 'Api\ApiUsersController@login');
	Route::post('register-step-1', 'Api\ApiUsersController@registerStep1');
	Route::post('register-step-2', 'Api\ApiUsersController@registerStep2');
// });
 
// Route::middleware('auth:api')->group(function () {
//     Route::get('user', 'PassportController@details');
 
//     Route::resource('products', 'ProductController');
// });

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
