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
    return view('home');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/article', function () {
    return view('article');
});

Route::get('/profile/{id}', 'ProfileController@getUser');
Route::get('/addpost/{id}', 'PostController@editPost');
Route::get('/addpost', 		'PostController@addPost');

/*
Route::get('/login', function () {
    return view('registration');
});	*/

Route::get('/registration', function () {
    return view('registration');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

