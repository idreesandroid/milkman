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

Route::get('/', function () { return view('welcome'); });
Route::get('/login', function () { return view('login'); });
Route::get('/logout', 'RegisterController@logout');
Route::post('/login', 'RegisterController@login');

Route::get('/','RegisterController@profile')->middleware('CustomAuth');
Route::get('/profile','RegisterController@profile')->middleware('CustomAuth');
Route::get('/register', function () { return view('register'); })->middleware('CustomAuth');
Route::post('/register', 'RegisterController@register')->middleware('CustomAuth');
Route::get('/register', 'RegisterController@user_role_list')->middleware('CustomAuth');

Route::get('country-state-city','CountryStateCityController@index')->middleware('CustomAuth');
Route::post('get-states-by-country','CountryStateCityController@getState')->middleware('CustomAuth');
Route::post('get-cities-by-state','CountryStateCityController@getCity')->middleware('CustomAuth');
//Product routes--------------------------------

Route::get('Product/index',           'ProductController@index')->name('index.product');
Route::get('Product/create',          'ProductController@create')->name('create.product');
Route::post('Product/create',         'ProductController@store')->name('store.product');
Route::get('Product/edit/{id}',       'ProductController@edit')->name('edit.product');
Route::post('Product/update/{id}',   'ProductController@update')->name('update.product');
//Route::delete('Product/destroy/{id}', 'ProductController@destroy')->name('destroy.product');

//ProductStock routes--------------------------------

Route::get('ProductStock/index',           'ProductStockController@index')->name('index.productStock');
Route::get('ProductStock/create',          'ProductStockController@create')->name('create.productStock');
Route::post('ProductStock/create',         'ProductStockController@store')->name('store.productStock');
Route::get('ProductStock/edit/{id}',       'ProductStockController@edit')->name('edit.productStock');
Route::post('ProductStock/update/{id}',    'ProductStockController@update')->name('update.productStock');
//Route::delete('Product/destroy/{id}', 'ProductController@destroy')->name('destroy.product'); 