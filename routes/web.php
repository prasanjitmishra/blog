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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/listPosts', 'postsController@list')->name('listPosts');
Route::post('/addPost', 'postsController@add')->name('addPost');
Route::post('/deletePost', 'postsController@deletePost')->name('deletePost');
Route::post('/updatePost', 'postsController@updatePost')->name('updatePost');
