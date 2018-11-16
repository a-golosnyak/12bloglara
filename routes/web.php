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
Route::get ('/registration', 	'Auth\RegisterController@reg');
Route::get ('/about', 			'PostController@aboutSite');
Route::get ('/profile/{id}', 	'ProfileController@getUser');
Route::get ('/{id}', 			'PostController@getPost');
Route::get ('/', 				'PostController@getPosts');
Route::get ('/addpost/{id}', 	'PostController@editPost');
Route::get ('/addpost', 		'PostController@addPost');
Route::post('/addpost/submit',	'PostController@submit');


//Auth::routes();

