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

Route::get('index','IndexController@index')->name('index');
Route::get('detail','IndexController@detail');
Route::get('bill','BillController@bill')->name('bill');
Route::get('cancel','BillController@cancel');
Route::post('toPay','BillController@toPay');
Route::post('cart/add','CartController@add');
Route::post('cart/delete','CartController@delete');
Route::post('pay','BillController@pay');
Route::get('waitPay','BillController@waitPay');
Route::get('choiceAddress','AddressController@choiceAddress');
Route::get('addAddress','AddressController@add');
Route::post('addAddressData','AddressController@addAddress');
Route::post('deleteAddressData','AddressController@delete');
Route::post('confirm','BillController@confirm');
Route::post('back','BillController@back');
Route::get('search','IndexController@search');
Route::get('search/view','IndexController@searchView');
