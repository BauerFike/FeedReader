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
Route::get('/feeds/create',function(){ return view('feeds.insert');});
Route::post('/feeds','FeedController@insert');
Route::get('/feeds/{feed}/edit','FeedController@edit');
Route::patch('/feeds/{feed}','FeedController@update');
Route::delete('/feeds/{feed}','FeedController@delete');

Route::get('/categories','CategoryController@index');
Route::get('/categories/create',function(){ return view('categories.insert');});
Route::post('/categories','CategoryController@insert');
Route::get('/categories/{category}/edit','CategoryController@edit');
Route::patch('/categories/{category}','CategoryController@update');
Route::delete('/categories/{category}','CategoryController@delete');


Route::get('/','ArticleController@index');
Route::get('/articles/{feed}','ArticleController@feeds');
Route::get('/articles/category/{category}','ArticleController@categories');
