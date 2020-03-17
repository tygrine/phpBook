<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Home
Route::get('/home', 'HomeController@index')->name('home');

// Forum
Route::get('/forum', 'ForumController@index')->name('forum');
Route::get('/forum/create', 'ForumController@create')->name('create');
Route::post('/forum', 'ForumController@store')->name('store');
Route::get('/forum/show/{post_id}', 'ForumController@show')->name('show');
Route::get('/forum/edit/{post_id}', 'ForumController@edit')->name('edit');
Route::put('/forum/edit/{post_id}', 'ForumController@update')->name('update');
Route::get('/forum/delete/{post_id}', 'ForumController@delete')->name('delete');
Route::post('/like', 'ForumController@like')->name('like');

//Comments
Route::post('/comments/{post_id}', 'CommentsController@store')->name('comments.store');
Route::get('/comments/delete/{comment_id}', 'CommentsController@delete')->name('comments.delete');

// Notifications
Route::post('/notification/get', 'NotificationController@get');
Route::post('/notification/read', 'NotificationController@read');
Route::post('/notification/clear', 'NotificationController@clear');

//Error
Route::get('/error', 'HomeController@error')->name('error');