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
Route::get('/', function () {
    return view('welcome');

});

Route::get('/phone', function() {
    echo app()->make('Application')->show_info();
});

Route::get('/shorten', function() {
    $urls = ['http://google.com/',
             'http://facebook.com',
             'http://www.msn.com'];
    $url = $urls[array_rand($urls)];
    echo $url . ' => ' . Bitly::shorten($url)['data']['url'];
});
