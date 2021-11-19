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

Route::get('/', 'App\Http\Controllers\LoginController@loginpage');
Route::get('paypal',function(){
    return view('welcome');
});
Route::get('/login', 'App\Http\Controllers\LoginController@loginpage')->name('login');
Route::get('/dashboard','App\Http\Controllers\LoginController@dashboardpage')->name('dashboard')->middleware('auth');
Route::post('login-check', 'App\Http\Controllers\LoginController@loginCheck')->name('login.check');
Route::get('/logout','App\Http\Controllers\LoginController@logout')->name('logout');
Route::post('/password-reset', 'App\Http\Controllers\LoginController@passwordReset')->name('pssword.reset');

Route::post('check-email','App\Http\Controllers\LoginController@checkEmail')->name('check.email');




Route::get('paywithpaypal', array('as' => 'paywithpaypal','uses' => 'App\Http\Controllers\paypalController@payWithPaypal',));
Route::post('paypal', array('as' => 'paypal','uses' => 'App\Http\Controllers\paypalController@postPaymentWithpaypal',));
Route::get('paypal', array('as' => 'status','uses' => 'App\Http\Controllers\paypalController@getPaymentStatus',));
