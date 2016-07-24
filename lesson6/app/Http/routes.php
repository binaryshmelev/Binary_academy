<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
Route::resource('books', 'BookController');
Route::resource('users', 'UserController');
*/

Route::group(['prefix' => 'api'], function() {
    Route::group(['prefix' => 'book'], function() {
        Route::get('', 'BookController@index');
        Route::get('{id}', 'BookController@details');
        Route::post('', 'BookController@store');
        Route::put('{id}', 'BookController@update');
        Route::delete('{id}', 'BookController@destroy');
    });
    Route::group(['prefix' => 'user'], function() {
        Route::get('{id}', 'UserController@index');
        Route::put('{id}', 'UserController@update');
    });
});