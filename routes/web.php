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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::prefix('admin')->group(function () {

    Route::middleware('auth:admin')->group(function () {
        Route::get('/', 'Backend\DashboardController@index')->name('admin.dashboard');
        Route::resource('roles', 'Backend\RolesController',['names' => 'admin.roles']);
        Route::resource('admins', 'Backend\AdminsController',['names' => 'admin.admins']);
    });
    

    //login routes
    Route::get('/login','Backend\Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login/submit','Backend\Auth\LoginController@login')->name('admin.login.submit');
    //logout routes
    Route::post('/logouts/submit','Backend\Auth\LoginController@logout')->name('admin.logout.submit');
    //forget password routes
    Route::get('/password/reset','Backend\Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');

    Route::post('/password/email','Backend\Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');

    Route::get('/password/reset/{token}','Backend\Auth\ResetPasswordController@showResetForm')->name('admin.password.reset');

    Route::post('/password/reset','Backend\Auth\ResetPasswordController@reset')->name('admin.password.update');
});