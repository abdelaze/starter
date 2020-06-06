<?php

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

Auth::routes(['verify'=>true]);

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/comment', 'HomeController@saveComment')->name('comment.save');
// facebook login
Route::get('login/{provider}','SocialController@redirectToProvider');
Route::get('callback/{provider}','SocialController@Callback');
