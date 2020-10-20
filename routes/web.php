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
Route::get('/','RegisterController@profile');
Route::get('/profile','RegisterController@profile');
Route::get('/register',array('as'=>'register','uses'=> 'RegisterController@register'));

Route::post('/register', 'RegisterController@register');
Route::get('/register', 'RegisterController@user_role_list');
//Get Users by role routes-------------------------------
Route::get('roles/roleList', array('as'=>'roleList.ajax','uses'=>  'RegisterController@roleList'));
Route::get('user/specificUserList/{rid}',           'RegisterController@specificUserList');
//All User routes-------------------------------
Route::get('user/userList',           'RegisterController@userList')->name('index.userList');
//Edit for all type od user record routes-------------------------------
Route::get('user/edit/{id}',       'RegisterController@edit')->name('edit.userList');
Route::post('user/update/{id}',    'RegisterController@update')->name('update.userList');

//Product routes--------------------------------

Route::get('Product/index',           'ProductController@index')->name('index.product');
Route::get('Product/create',          'ProductController@create')->name('create.product');
Route::post('Product/create',         'ProductController@store')->name('store.product');
Route::get('Product/edit/{id}',       'ProductController@edit')->name('edit.product');
Route::post('Product/update/{id}',    'ProductController@update')->name('update.product');
Route::Delete('Product/delete/{id}',  'ProductController@deleteProduct')->name('delete.product');

//ProductStock routes--------------------------------

Route::get('ProductStock/index',           'ProductStockController@index')->name('index.productStock');
Route::get('ProductStock/create',          'ProductStockController@create')->name('create.productStock');
Route::post('ProductStock/create',         'ProductStockController@store')->name('store.productStock');
Route::get('ProductStock/edit/{id}',       'ProductStockController@edit')->name('edit.productStock');
Route::post('ProductStock/update/{id}',    'ProductStockController@update')->name('update.productStock');
Route::Delete('ProductStock/delete/{id}',  'ProductStockController@deleteProductStock')->name('delete.productStock');


//VendorRoute routes--------------------------------

Route::get('VendorRoute/index',           'VendorRouteController@index')->name('index.VendorRoute');
Route::get('VendorRoute/create',          'VendorRouteController@create')->name('create.VendorRoute');
Route::post('VendorRoute/create',         'VendorRouteController@store')->name('store.VendorRoute');
Route::get('VendorRoute/edit/{id}',       'VendorRouteController@edit')->name('edit.VendorRoute');
Route::post('VendorRoute/update/{id}',    'VendorRouteController@update')->name('update.VendorRoute');
Route::Delete('VendorRoute/delete/{id}',  'VendorRouteController@deleteVendorRoute')->name('delete.VendorRoute');

 


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
Route::get('/add_designation', 'DesignationController@load_designation');
Route::post('/add_designation', 'DesignationController@add_designation');


Route::get('/payment',  'PaymentController@userList'); 
Route::post('/payment',  'PaymentController@payment_to'); 

Route::get('/payment_request',  'PaymentController@payment_request_load'); 
Route::post('/payment_request',  'PaymentController@payment_request'); 
Route::get('/payment_request_detail/{id}',  'PaymentController@payment_request_detail'); 

Route::post('/payment_next_back',  'PaymentController@payment_next_back'); 




//Cart routes--------------------------------

Route::get('Cart/index',           'SaleController@index')->name('index.sale');
Route::get('Cart/pendingInvoice',  'SaleController@pendingInvoice')->name('pending.invoice');
Route::get('Cart/create',          'SaleController@generateInvoice')->name('create.invoice');
Route::post('Cart/create',         'SaleController@SaveInvoice')->name('save.invoice');
//Route::get('Cart/edit/{id}',       'CartController@edit')->name('edit.cart');
// Route::post('Cart/update/{id}',   'CartController@update')->name('update.cart');


Route::Delete('Cart/deleteInvoice/{id}',     'SaleController@deleteInvoice')->name('delete.invoice');

//GenericController routes-------------------------------
//ajax routes-------------------------------
Route::get('register/ajax/{id}',array('as'=>'register.ajax','uses'=>'GenericController@cityAjax'));

Route::get('batch_selection/ajax',array('as'=>'batchSelection.ajax','uses'=>'SaleController@batchSelection'));