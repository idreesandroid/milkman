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


//(!session()->has('data')){ return redirect('/login'); }
Route::get('/logout', 'RegisterController@logout');
Route::get('/login', function () { return view('login'); });
Route::post('/login', 'RegisterController@login');
Route::get('/','RegisterController@profile')->middleware('CustomAuth');
Route::get('/register', function () { return view('register'); })->middleware('CustomAuth');
Route::post('/register', 'RegisterController@register')->middleware('CustomAuth');
Route::get('/register', 'RegisterController@user_role_list')->middleware('CustomAuth');

Route::get('country-state-city','CountryStateCityController@index')->middleware('CustomAuth');
Route::post('get-states-by-country','CountryStateCityController@getState')->middleware('CustomAuth');
Route::post('get-cities-by-state','CountryStateCityController@getCity')->middleware('CustomAuth');