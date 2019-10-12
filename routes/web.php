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

Route::get( '/', 'Logs@today' );
Route::get( '/view/{day}', 'Logs@givenDay' );
Route::get( '/nick/{nickname}', 'Logs@nickname' );

Route::post( '/search', 'Logs@search' );
