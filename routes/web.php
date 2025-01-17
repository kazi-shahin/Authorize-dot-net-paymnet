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

Route::get('/checkout', 'AuthorizeController@index');
Route::post('/checkout', 'AuthorizeController@chargeCreditCard');
Route::get('/recurringbilling', 'AuthorizeController@recurringbilling');
Route::post('/recurringbilling', 'AuthorizeController@createSubscription');
Route::get('/chargeCreditCardForService', 'AuthorizeController@chargeCreditCardForServiceview');
Route::post('/chargeCreditCardForService', 'AuthorizeController@chargeCreditCardForService');
//Route::post('/checkout', 'AuthorizeController@chargeCreditCard');
