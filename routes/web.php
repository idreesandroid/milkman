<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GenericController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductStockController;
use App\Http\Controllers\VendorDetailController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\DistributorController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DistributorPaymentController;

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
//     return view('login');
// });

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
 
//Login Register routes--------------------------------
Route::get('/',                    [LoginController::class, 'login'])->name('user.login');
Route::get('register',             [RegisterController::class, 'showRegistrationForm'])->name('user.register')->middleware('can:Register-User');
//Users routes--------------------------------
Route::get('user/userList',        [RegisterController::class, 'allUserList'])->name('index.userList')->middleware('can:See-User');
Route::get('user/profile/{id}',    [RegisterController::class, 'profile'])->name('profile.user')->middleware('can:See-profile');
Route::post('user/update/{id}',    [RegisterController::class,'update'])->name('update.userList')->middleware('can:Edit-User');
//Role routes--------------------------------

Route::get('role/index',           [RoleController::class, 'index'])->name('index.role')->middleware('can:See-Role');
Route::get('role/create',          [RoleController::class, 'create'])->name('create.role')->middleware('can:Create-Role');
Route::post('role/create',         [RoleController::class, 'store'])->name('store.role')->middleware('can:Create-Role');
Route::get('role/edit/{id}',       [RoleController::class, 'edit'])->name('edit.role')->middleware('can:Edit-Role');
Route::post('role/update/{id}',    [RoleController::class, 'update'])->name('update.role')->middleware('can:Edit-Role');
Route::Delete('role/delete/{id}',  [RoleController::class, 'deleteRole'])->name('delete.role')->middleware('can:Delete-Role');
//Role routes--------------------------------
Route::get('permission/index',      [PermissionController::class, 'index'])->name('index.permission')->middleware('can:See-Permission');
Route::get('permission/create',     [PermissionController::class, 'create'])->name('create.permission')->middleware('can:Create-Permission');
Route::post('permission/create',    [PermissionController::class, 'store'])->name('store.permission')->middleware('can:Create-Permission');

//Product routes--------------------------------

Route::get('product/index',           [ProductController::class, 'index'])->name('index.product')->middleware('can:See-Product');
Route::get('product/create',          [ProductController::class, 'create'])->name('create.product')->middleware('can:Create-Product');
Route::post('product/create',         [ProductController::class, 'store'])->name('store.product')->middleware('can:Create-Product');
Route::get('product/edit/{id}',       [ProductController::class, 'edit'])->name('edit.product')->middleware('can:Edit-Product');
Route::post('product/update/{id}',    [ProductController::class, 'update'])->name('update.product')->middleware('can:Edit-Product');
Route::Delete('product/delete/{id}',  [ProductController::class, 'deleteProduct'])->name('delete.product')->middleware('can:Delete-Product');

//ProductStock routes--------------------------------

Route::get('product-stock/index',           [ProductStockController::class, 'index'])->name('index.productStock')->middleware('can:See-Product-Stock');
Route::get('product-stock/create',          [ProductStockController::class, 'create'])->name('create.productStock')->middleware('can:Create-Product-Stock');
Route::post('product-stock/create',         [ProductStockController::class, 'store'])->name('store.productStock')->middleware('can:Create-Product-Stock');
Route::get('product-stock/edit/{id}',       [ProductStockController::class, 'edit'])->name('edit.productStock')->middleware('can:Edit-Product-Stock');
Route::post('product-stock/update/{id}',    [ProductStockController::class, 'update'])->name('update.productStock')->middleware('can:Edit-Product-Stock');
Route::Delete('product-stock/delete/{id}',  [ProductStockController::class, 'deleteProductStock'])->name('delete.productStock')->middleware('can:Delete-Product-Stock');

//VendorDetail routes--------------------------------
 
Route::get('vendor-detail/index',           [VendorDetailController::class, 'index'])->name('index.vendor-detail')->middleware('can:See-Vendor');
Route::get('vendor-detail/create',          [VendorDetailController::class, 'create'])->name('create.vendor-detail')->middleware('can:Create-Vendor');
Route::post('vendor-detail/create',         [VendorDetailController::class, 'store'])->name('store.vendor-detail')->middleware('can:Create-Vendor');
Route::get('vendor-detail/edit/{id}',       [VendorDetailController::class, 'edit'])->name('edit.vendor-detail')->middleware('can:Edit-Vendor');
Route::post('vendor-detail/update/{id}',    [VendorDetailController::class, 'update'])->name('update.vendor-detail')->middleware('can:Edit-Vendor');
Route::post('vendorAgreement/update/{id}',  [VendorDetailController::class,'agreementUpdate'])->name('agreementUpdate.vendor')->middleware('can:Edit-Agreement-Detail');
Route::post('bankDetails/update/{id}',      [VendorDetailController::class,'bankDetailsUpdate'])->name('detailsUpdate.bank')->middleware('can:Edit-Bank-Detail');

//Distributor Detail routes--------------------------------
 
Route::get('distributor-detail/index',           [DistributorController::class, 'index'])->name('index.distributor-detail')->middleware('can:See-Distributor');
Route::get('distributor-detail/create',          [DistributorController::class, 'create'])->name('create.distributor-detail')->middleware('can:Create-Distributor');
Route::post('distributor-detail/create',         [DistributorController::class, 'store'])->name('store.distributor-detail')->middleware('can:Create-Distributor');
Route::get('distributor-detail/edit/{id}',       [DistributorController::class, 'edit'])->name('edit.distributor-detail')->middleware('can:Edit-Distributor');
Route::post('distributor-detail/update/{id}',    [DistributorController::class, 'update'])->name('update.distributor-detail')->middleware('can:Edit-Distributor');
Route::post('companyDetail/update/{id}',    [DistributorController::class,'companyDetailUpdate'])->name('companyDetail.distributor')->middleware('can:Edit-Company-Detail');

//Cart routes--------------------------------

Route::get('cart/index',                    [SaleController::class, 'index'])->name('index.sale')->middleware('can:See-Cart');
Route::get('cart/reserveInvoice',           [SaleController::class, 'reserveInvoice'])->name('reserve.invoice')->middleware('can:See-Cart');
Route::get('Invoice/status/{id}',           [SaleController::class, 'reserveStatus'])->name('update.Stock_status')->middleware('can:See-Cart');

Route::get('cart/onHoldInvoice',            [SaleController::class, 'onHoldInvoice'])->name('onHold.invoice')->middleware('can:See-Cart');

Route::get('cart/create',                   [SaleController::class, 'generateInvoice'])->name('create.invoice')->middleware('can:Generate-Invoice');
Route::post('cart/create',                  [SaleController::class, 'SaveInvoice'])->name('save.invoice')->middleware('can:Generate-Invoice');
Route::get('cart/selectbatch',              [SaleController::class, 'selectBatch'])->name('select.batch')->middleware('can:Generate-Invoice');
Route::Delete('cart/deleteInvoice/{id}',    [SaleController::class, 'deleteInvoice'])->name('delete.invoice')->middleware('can:Delete-Invoice');

//payment routes-------------------------------------------
Route::get('payment/receipt/{id}',           [DistributorPaymentController::class, 'receipt'])->name('payment.receipt');

//ajax routes-------------------------------

Route::post('selectbatch/{id}',             [SaleController::class, 'SaveBatch'])->name('save.Batch')->middleware('can:Generate-Invoice');
Route::get('batch_selection/ajax/{id}',     [SaleController::class, 'batchSelection'])->name('select.Batch')->middleware('can:Generate-Invoice');

//collection routes-------------------------------
Route::get('collection/create',[CollectionController::class, 'create'])->name('create.collection');
Route::post('collection/store', [CollectionController::class, 'store'])->name('store.collection');
Route::get('collections', [CollectionController::class, 'index'])->name('index.collection');
