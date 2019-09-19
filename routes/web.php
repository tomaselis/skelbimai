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

Route::get('/', function () {
    return view('welcome');
});


Route::get('home', 'HomeController@index');
Route::get('advert/nt', 'AdvertController@nt')->name('adverts.nt');

Auth::routes();

Route::resource('admin', 'AdminController');
////Route::get('/home', 'HomeController@index')

Route::resource('advert', 'AdvertController');
Route::resource('category', 'CategoryController');
Route::resource('comment', 'CommentController');
Route::resource('city', 'CityController');
Route::resource('messages', 'MessageController');
Route::get('messages', 'MessageController@index')->name('messages.index');
Route::get('messages/{id}', 'MessageController@show')->name('message.show');

Route::get('attributes', 'AttributesController@index')->name('attributes.index');
Route::get('attributes/storeset', 'AttributesController@storeSet')->name('attributes.storeSet');
Route::get('attributes/storeattribute', 'AttributesController@storeAttribute')->name('attributes.storeAttribute');

//Route::get('messages', 'MessageController@index')->name('messages.index');
//Route::get('messages/{id}', 'MessageController@show')->name('message.show');
//Route::get('messages/{id}', 'MessageController@create')->name('message.create');
//Route::get('messages/{id}', 'MessageController@store')->name('message.store');


