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
Route::get('/register', function () { return view('register'); });
Route::post('/register', 'RegisterController@register');
Route::get('/register', 'RegisterController@user_role_list');

//country state city drop down

Route::get('country-state-city','CountryStateCityController@index');
Route::post('get-states-by-country','CountryStateCityController@getState');
Route::post('get-cities-by-state','CountryStateCityController@getCity');