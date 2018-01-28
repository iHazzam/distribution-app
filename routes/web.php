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


Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => 'auth.admin', 'namespace' => 'Admin', 'as' => 'admin.'], function() {
    Route::resource('clients','ClientController');
    Route::resource('clients/app','ClientApplicationController');
});

Route::get('{client_slug}/{share_slug}','ClientApplicationController@share')->name('client.share');


Route::group(['middleware' => 'auth'],function (){
   Route::get('{client_slug}','ClientController@index')->name('client.home');
   Route::get('{client_slug}/app/{app}','ClientApplicationController@index')->name('client.app');
   Route::post('{client_slug}/app/{app}','ClientApplicationController@store')->name('client.generate');
});

 