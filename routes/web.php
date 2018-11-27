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

Route::get ('/profile/{id}', 		'UserController@getUser');
Route::get ('/', 					'PostController@getPosts');
Route::get ('/ofuser/{id}', 		'PostController@getPosts');
Route::get ('/categoty/{id}', 		'PostController@getPosts');
Route::get ('/addpost', 			'PostController@addPost');
Route::get ('/addpost/{id}', 		'PostController@editPost');
Route::post('/addpost/update', 		'PostController@updatePost');
Route::post('/addpost/submit',		'PostController@submit');
Route::get('/delpost/{id}',			'PostController@deletePost');

Route::post ('/addcomment/submit',	'CommentController@submit');

//--- Ajax-----------------------------------------------------------------
Route::post ('/editcomment',		'CommentController@editComment');
Route::post ('/delcomment',			'CommentController@delComment');
Route::post ('/checkuser', 			'UserController@checkUser');
Route::post ('/setimage', 			'UserController@setImage');
//-------------------------------------------------------------------------

Route::post ('/setname', 			'UserController@setName');
Route::post ('/setemail', 			'UserController@setEmail');
Route::post ('/setpassword', 		'UserController@setPassword');


//This functions don't work in HomeController. Maybe __construct() -> this->middleware('auth'); is the reason
Route::get ('/about', 				'PostController@aboutSite');	
Route::get ('/contacts', 			'PostController@contacts');

Route::get ('/{id}', 				'PostController@getPost');		// last

Auth::routes();

