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
Route::get('/','TasksController@todays_tasks')->middleware('CustomAuth');


Route::get('/profile','TasksController@todays_tasks')->middleware('CustomAuth');



Route::get('/register',array('as'=>'register','uses'=> 'RegisterController@register'))->middleware('CustomAuth');

Route::post('/register', 'RegisterController@register')->middleware('CustomAuth');
Route::get('/register', 'RegisterController@user_role_list')->middleware('CustomAuth');
//Get Users by role routes-------------------------------
Route::get('roles/roleList', array('as'=>'roleList.ajax','uses'=>  'RegisterController@roleList'))->middleware('CustomAuth');
Route::get('user/specificUserList/{rid}',           'RegisterController@specificUserList')->middleware('CustomAuth');
//All User routes-------------------------------
Route::get('user/userList',           'RegisterController@userList')->name('index.userList')->middleware('CustomAuth');
//Edit for all type od user record routes-------------------------------
Route::get('user/edit/{id}',       'RegisterController@edit')->name('edit.userList')->middleware('CustomAuth');
Route::post('user/update/{id}',    'RegisterController@update')->name('update.userList')->middleware('CustomAuth');

//Product routes--------------------------------

Route::get('Product/index',           'ProductController@index')->name('index.product')->middleware('CustomAuth');
Route::get('Product/create',          'ProductController@create')->name('create.product')->middleware('CustomAuth');
Route::post('Product/create',         'ProductController@store')->name('store.product')->middleware('CustomAuth');
Route::get('Product/edit/{id}',       'ProductController@edit')->name('edit.product')->middleware('CustomAuth');
Route::post('Product/update/{id}',    'ProductController@update')->name('update.product')->middleware('CustomAuth');
Route::Delete('Product/delete/{id}',  'ProductController@deleteProduct')->name('delete.product')->middleware('CustomAuth');

//ProductStock routes--------------------------------

Route::get('ProductStock/index',           'ProductStockController@index')->name('index.productStock')->middleware('CustomAuth');
Route::get('ProductStock/create',          'ProductStockController@create')->name('create.productStock')->middleware('CustomAuth');
Route::post('ProductStock/create',         'ProductStockController@store')->name('store.productStock')->middleware('CustomAuth');
Route::get('ProductStock/edit/{id}',       'ProductStockController@edit')->name('edit.productStock')->middleware('CustomAuth');
Route::post('ProductStock/update/{id}',    'ProductStockController@update')->name('update.productStock')->middleware('CustomAuth');
Route::Delete('ProductStock/delete/{id}',  'ProductStockController@deleteProductStock')->name('delete.productStock')->middleware('CustomAuth');


//VendorRoute routes--------------------------------

Route::get('VendorRoute/index',           'VendorRouteController@index')->name('index.VendorRoute')->middleware('CustomAuth');
Route::get('VendorRoute/create',          'VendorRouteController@create')->name('create.VendorRoute')->middleware('CustomAuth');
Route::post('VendorRoute/create',         'VendorRouteController@store')->name('store.VendorRoute')->middleware('CustomAuth');
Route::get('VendorRoute/edit/{id}',       'VendorRouteController@edit')->name('edit.VendorRoute')->middleware('CustomAuth');
Route::post('VendorRoute/update/{id}',    'VendorRouteController@update')->name('update.VendorRoute')->middleware('CustomAuth');
Route::Delete('VendorRoute/delete/{id}',  'VendorRouteController@deleteVendorRoute')->name('delete.VendorRoute')->middleware('CustomAuth');

 


//VendorDetail routes--------------------------------
 
Route::get('VendorDetail/index',           'VendorDetailController@index')->name('index.VendorDetail')->middleware('CustomAuth');
Route::get('VendorDetail/create',          'VendorDetailController@create')->name('create.VendorDetail')->middleware('CustomAuth');
Route::post('VendorDetail/create',         'VendorDetailController@store')->name('store.VendorDetail')->middleware('CustomAuth');
Route::get('VendorDetail/edit/{id}',       'VendorDetailController@edit')->name('edit.VendorDetail')->middleware('CustomAuth');
Route::post('VendorDetail/update/{id}',    'VendorDetailController@update')->name('update.VendorDetail')->middleware('CustomAuth');
Route::get('vendorLedger',                 'VendorDetailController@get_vendors' )->middleware('CustomAuth');


 
/* /{vendor_id}{date_from}{date_to} */
 Route::get('vendorLedgerDetail/{vendor_id}/{date_from}/{date_to}','VendorDetailController@vendorLedgerDetail')->middleware('CustomAuth') ;
 Route::post('/vendorLedger','VendorDetailController@vendorLedger') ->middleware('CustomAuth');

//Task routes--------------------------------
Route::get('/set_task', 'CollectorController@collector_list')->middleware('CustomAuth');
Route::post('/set_task', 'CollectorController@set_task')->middleware('CustomAuth');
Route::get('/task_list',  'CollectorController@task_list')->middleware('CustomAuth');
Route::get('/task_collection/{id}',  'CollectorController@task_vendors')->middleware('CustomAuth'); 

Route::post('/task_collection',  'CollectorController@task_collection_entry')->middleware('CustomAuth');


//Role routes--------------------------------

Route::get('Role/index',           'RoleController@index')->name('index.role')->middleware('CustomAuth');
Route::get('Role/create',          'RoleController@create')->name('create.role')->middleware('CustomAuth');
Route::post('Role/create',         'RoleController@store')->name('store.role')->middleware('CustomAuth');

Route::get('/add_sub_roles', 'RoleController@load_roles')->middleware('CustomAuth');
Route::post('/add_sub_roles', 'RoleController@add_sub_roles')->middleware('CustomAuth');
Route::get('/add_designation', 'DesignationController@load_designation')->middleware('CustomAuth');
Route::post('/add_designation', 'DesignationController@add_designation')->middleware('CustomAuth');


Route::get('/payment',  'PaymentController@userList')->middleware('CustomAuth'); 
Route::post('/payment',  'PaymentController@payment_to')->middleware('CustomAuth'); 

Route::get('/payment_request',  'PaymentController@payment_request_load')->middleware('CustomAuth'); 
Route::post('/payment_request',  'PaymentController@payment_request')->middleware('CustomAuth'); 
Route::get('/payment_request_detail/{id}',  'PaymentController@payment_request_detail')->middleware('CustomAuth'); 

Route::post('/payment_next_back',  'PaymentController@payment_next_back')->middleware('CustomAuth'); 




//Cart routes--------------------------------

Route::get('Cart/index',           'SaleController@index')->name('index.sale')->middleware('CustomAuth');
//Route::get('Cart/edit/{id}',           'SaleController@productInCart')->name('cart.product')->middleware('CustomAuth');

Route::get('Cart/reserveInvoice',  'SaleController@reserveInvoice')->name('reserve.invoice')->middleware('CustomAuth');
Route::get('Invoice/status/{id}',    'SaleController@reserveStatus')->name('update.Stock_status')->middleware('CustomAuth');
Route::get('Cart/onHoldInvoice',  'SaleController@onHoldInvoice')->name('onHold.invoice')->middleware('CustomAuth');

Route::get('Cart/create',          'SaleController@generateInvoice')->name('create.invoice')->middleware('CustomAuth');
Route::post('Cart/create',         'SaleController@SaveInvoice')->name('save.invoice')->middleware('CustomAuth');
//Route::get('Cart/edit/{id}',       'CartController@edit')->name('edit.cart');
// Route::post('Cart/update/{id}',   'CartController@update')->name('update.cart');

Route::get('Cart/selectbatch',          'SaleController@selectBatch')->name('select.batch')->middleware('CustomAuth');
Route::post('selectbatch/{id}',         'SaleController@SaveBatch')->name('save.Batch')->middleware('CustomAuth');


Route::Delete('Cart/deleteInvoice/{id}',     'SaleController@deleteInvoice')->name('delete.invoice')->middleware('CustomAuth');

//GenericController routes------------------
//ajax routes-------------------------------
Route::get('register/ajax/{id}',array('as'=>'register.ajax','uses'=>'GenericController@cityAjax'))->middleware('CustomAuth');


Route::get('batch_selection/ajax/{id}',array('as'=>'batchSelection.ajax','uses'=>'SaleController@batchSelection'))->middleware('CustomAuth');

//Route::get('add_batch_selection/ajax/{id}',array('as'=>'addBatchSelection.ajax','uses'=>'SaleController@SaveBatch'))->middleware('CustomAuth');

