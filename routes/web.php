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
    Route::get('/register-comany/{id?}', 'RegisterController@showRegistrationForm2')->name('register.form2');
    Route::post('/register-comany', 'RegisterController@storeRegistrationStep2')->name('register.step2');
    Route::get('/login', 'LoginController@showLoginForm')->name('login');
    Route::post('/login', 'LoginController@login')->name('login.post');

    Route::get('/logout', 'LoginController@logout')->name('customer.logout');
    Route::get('admin/login', 'LoginController@showLoginForm')->name('admin.login');
    Route::post('admin/login', 'LoginController@login')->name('admin.login.post');
});

// Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
//     Route::get('/login', 'AdminAuthController@adminloginform')->name('admin.login');
// });

Route::middleware(['auth'])->group(function () {
    Route::group(['namespace' => 'Backend', 'prefix' => ''], function () {

        // for company middleware and routes
        // Route::middleware(['company'])->group(function () {
            Route::get('/company', 'CompanyController@index')->name('company.dashboard');
        // });

        // for customer middleware and routes
        // Route::middleware(['customer'])->group(function () {
            Route::get('/customer', 'CustomerController@index')->name('customer.dashboard');
        // });
    });

    // for admin middleware and routes
    Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
        Route::middleware(['Admin'])->group(function () {
            Route::get('/', 'AdminController@index')->name('admin.dashboard');
        });
    });

});

//Auth::routes();


