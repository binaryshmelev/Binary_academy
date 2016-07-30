<?php
use App\User;
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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'books'], function() {
    Route::get('', 'BookController@index');
    Route::get('{id}', 'BookController@details');
    Route::post('', 'BookController@store');
    Route::put('{id}', 'BookController@edit');
    Route::delete('{id}', 'BookController@destroy');
});

Route::group(['prefix' => 'users'], function() {
    Route::get('', 'UserController@all');
    Route::get('{id}', 'UserController@index');
});