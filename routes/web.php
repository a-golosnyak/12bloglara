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
Route::get ('/registration', 		'Auth\RegisterController@reg');
Route::get ('/about', 				'PostController@aboutSite');
Route::get ('/profile/{id}', 		'ProfileController@getUser');
Route::get ('/', 					'PostController@getPosts');
Route::get ('/addpost', 			'PostController@addPost');
Route::get ('/addpost/{id}', 		'PostController@editPost');
Route::post('/addpost/update', 		'PostController@updatePost');
Route::post('/addpost/submit',		'PostController@submit');
Route::get('/delpost/{id}',			'PostController@deletePost');
Route::post ('/addcomment/submit',	'CommentController@submit');

Route::get ('/{id}', 			'PostController@getPost');		// last

Auth::routes();

