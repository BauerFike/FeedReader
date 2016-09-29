<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/feeds','FeedController@index');
Route::post('/feeds','FeedController@insert');
Route::delete('/feeds/{feed}','FeedController@delete');
Route::get('/articles','ArticleController@index');
Route::get('/articles/{page}','ArticleController@index');
