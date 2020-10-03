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




 
Route::get('/login', function () { return view('login'); });



Route::post('/login', 'RegisterController@login');

Route::get('/logout', 'RegisterController@logout');

Route::get('/','RegisterController@profile')->middleware('CustomAuth');
Route::get('/profile','RegisterController@profile')->middleware('CustomAuth');
Route::get('/register', function () { return view('register'); })->middleware('CustomAuth');
Route::post('/register', 'RegisterController@register')->middleware('CustomAuth');
Route::get('/register', 'RegisterController@user_role_list')->middleware('CustomAuth');

Route::get('user/userList',           'RegisterController@userList')->name('index.userList')->middleware('CustomAuth');
Route::get('user/edit/{id}',       'RegisterController@edit')->name('edit.userList')->middleware('CustomAuth');
Route::post('user/update/{id}',    'RegisterController@update')->name('update.userList')->middleware('CustomAuth');

//Product routes--------------------------------

Route::get('Product/index',           'ProductController@index')->name('index.product')->middleware('CustomAuth');
Route::get('Product/create',          'ProductController@create')->name('create.product')->middleware('CustomAuth');
Route::post('Product/create',         'ProductController@store')->name('store.product')->middleware('CustomAuth');
Route::get('Product/edit/{id}',       'ProductController@edit')->name('edit.product')->middleware('CustomAuth');
Route::post('Product/update/{id}',   'ProductController@update')->name('update.product')->middleware('CustomAuth');


//ProductStock routes--------------------------------

Route::get('ProductStock/index',           'ProductStockController@index')->name('index.productStock')->middleware('CustomAuth');
Route::get('ProductStock/create',          'ProductStockController@create')->name('create.productStock')->middleware('CustomAuth');
Route::post('ProductStock/create',         'ProductStockController@store')->name('store.productStock')->middleware('CustomAuth');
Route::get('ProductStock/edit/{id}',       'ProductStockController@edit')->name('edit.productStock')->middleware('CustomAuth');
Route::post('ProductStock/update/{id}',    'ProductStockController@update')->name('update.productStock')->middleware('CustomAuth');
 

//VendorRoute routes--------------------------------

Route::get('VendorRoute/index',           'VendorRouteController@index')->name('index.VendorRoute');
Route::get('VendorRoute/create',          'VendorRouteController@create')->name('create.VendorRoute');
Route::post('VendorRoute/create',         'VendorRouteController@store')->name('store.VendorRoute');
Route::get('VendorRoute/edit/{id}',       'VendorRouteController@edit')->name('edit.VendorRoute');
Route::post('VendorRoute/update/{id}',    'VendorRouteController@update')->name('update.VendorRoute');

 


//VendorDetail routes--------------------------------
 
Route::get('VendorDetail/index',           'VendorDetailController@index')->name('index.VendorDetail');
Route::get('VendorDetail/create',          'VendorDetailController@create')->name('create.VendorDetail');
Route::post('VendorDetail/create',         'VendorDetailController@store')->name('store.VendorDetail');
Route::get('VendorDetail/edit/{id}',       'VendorDetailController@edit')->name('edit.VendorDetail');
Route::post('VendorDetail/update/{id}',    'VendorDetailController@update')->name('update.VendorDetail');
Route::get('vendorLedger', 'VendorDetailController@get_vendors' );



/* /{vendor_id}{date_from}{date_to} */
 Route::get('vendorLedgerDetail/{vendor_id}/{date_from}/{date_to}','VendorDetailController@vendorLedgerDetail') ;
 Route::post('/vendorLedger','VendorDetailController@vendorLedger') ;


 
 

//Task routes--------------------------------
Route::get('/set_task', 'CollectorController@collector_list');
Route::post('/set_task', 'CollectorController@set_task');
Route::get('/task_list',  'CollectorController@task_list');
Route::get('/task_collection/{id}',  'CollectorController@task_vendors'); 

Route::post('/task_collection',  'CollectorController@task_collection_entry');


//Role routes--------------------------------

Route::get('Role/index',           'RoleController@index')->name('index.role');
Route::get('Role/create',          'RoleController@create')->name('create.role');
Route::post('Role/create',         'RoleController@store')->name('store.role');

Route::get('/add_sub_roles', 'RoleController@load_roles');
Route::post('/add_sub_roles', 'RoleController@add_sub_roles');

Route::get('/payment',  'PaymentContrller@userList'); 
Route::post('/payment',  'PaymentContrller@payment_to'); 

