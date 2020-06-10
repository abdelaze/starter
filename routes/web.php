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



Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){
    Route::group(['prefix' => 'offers'],function() {

        Route::get('create', 'OffersController@create');
        Route::post('store', 'OffersController@store')->name('offers.store');
        Route::get('all', 'OffersController@getallOffers')->name('offers.all');;
        Route::get('edit/{offer_id}','OffersController@edit');
        Route::post('update/{offer_id}', 'OffersController@update')->name('offers.update');
        Route::get('delete/{offer_id}','OffersController@delete')->name('offers.delete');


    });
    Route::get('video','OffersController@getvideos');

});
