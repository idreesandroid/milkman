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
//user route

Route::get('/', function () { return view('welcome'); });
Route::get('/login', function () { return view('login'); });
Route::get('/register', function () { return view('register'); });
Route::post('/register', 'RegisterController@register');
Route::get('/register', 'RegisterController@user_role_list');

Route::get('user/userList',           'RegisterController@userList')->name('index.userList');
Route::get('user/edit/{id}',       'RegisterController@edit')->name('edit.userList');
Route::post('user/update/{id}',    'RegisterController@update')->name('update.userList');



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