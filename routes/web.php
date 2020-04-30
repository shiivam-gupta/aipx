<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
    return redirect(route('login'));
});

Route::group(['namespace' => 'Auth', 'prefix' => ''], function () {

    Route::get('/register', 'RegisterController@showRegistration')->name('register');
    Route::post('register-step-1', 'RegisterController@storeRegistrationStep1')->name('register.step1');
    Route::get('/register-step-2/{id?}', 'RegisterController@showRegistrationForm2')->name('register.form2');
    Route::post('/register-step-2', 'RegisterController@storeRegistrationStep2')->name('register.step2');
    Route::get('/login', 'LoginController@showLoginForm')->name('login');
    Route::post('/login', 'LoginController@login')->name('login.post');

    Route::get('/logout', 'LoginController@logout')->name('customer.logout');
});


Route::middleware(['auth'])->group(function () {
    Route::group(['namespace' => 'Backend', 'prefix' => ''], function () {

        Route::get('/company', 'CompanyController@index')->name('company.dashboard');
        Route::get('/customer', 'CustomerController@index')->name('customer.dashboard');
        



    });
});

//Auth::routes();


