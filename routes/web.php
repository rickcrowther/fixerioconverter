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

Route::get('/', ['as'=>'home', 'uses' => 'FixerController@index']);
Route::get('/birthday-rates/{birthday}', ['as'=>'get-rates', 'uses' => 'FixerController@getBirthdayRates']);
Route::get('/conversion-history/', ['as'=>'get-history', 'uses' => 'FixerController@getConversionHistory']);
