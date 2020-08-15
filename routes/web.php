<?php

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
    return view('welcome');
});

// triggered payment
Route::get('payment', 'PayPalController@payment')->name('payment');
// cancel payment
Route::get('cancel', 'PayPalController@cancel')->name('payment.cancel');
// payment success
Route::get('payment/success', 'PayPalController@success')->name('payment.success');
