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

define('PAGINATION_COUNT',2);

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
        Route::get('all', 'OffersController@getallOffers')->name('offers.all');
        Route::get('edit/{offer_id}','OffersController@edit');
        Route::post('update/{offer_id}', 'OffersController@update')->name('offers.update');
        Route::get('delete/{offer_id}','OffersController@delete')->name('offers.delete');
        Route::get('get-inactive-offers', 'OffersController@inActiveOffers');

    });
    Route::get('video','OffersController@getvideos');

});

###################### Begin Ajax routes #####################
Route::group(['prefix' => 'ajax-offers'],function() {

    Route::get('create', 'Admin\AjaxofferController@create');
    Route::post('store', 'Admin\AjaxofferController@store')->name('ajax.offers.store');
    Route::post('delete','Admin\AjaxofferController@delete')->name('ajax.offers.delete');
    Route::get('edit/{offer_id}','Admin\AjaxofferController@edit')->name('ajax.offers.edit');
    Route::post('update', 'Admin\AjaxofferController@update')->name('ajax.offers.update');
    Route::get('all', 'Admin\AjaxofferController@getallOffers')->name('ajax.offers.all');

});

###################### End Ajax routes #####################
Route::get('/NotAdult',function (){
   return 'You Are Less Than 15 Years Old';
})->name('not.adult');
###################### Begin middleware and guards #####################
Route::group(['middleware'=>'CheckAge','namespace'=>'Auth'],function (){
     Route::get('/adults','CustomAuthController@adults')->name('adults');

});

Route::group(['namespace'=>'Auth'],function () {
    Route::get('/site', 'CustomAuthController@site')->name('site')->middleware('auth:web');
    Route::get('/admin', 'CustomAuthController@admin')->name('admin')->middleware('auth:admin');
    Route::get('admin/login', 'CustomAuthController@adminLogin')->name('admin.login');
    Route::post('admin/save', 'CustomAuthController@checkAdminLogin')->name('save.admin.login');
});

###################### End middleware and guards  #####################


####################### Start Relations ##############################

Route::get('has-one','Relations\RelationsController@hasOneRelation');
Route::get('get-user-with-phone','Relations\RelationsController@getUserHasPhone');
Route::get('get-all-doctors','Relations\RelationsController@getAllDoctors');

// get all hospitals and doctors
Route::get('hospitals','Relations\RelationsController@hospitals')->name('hospitals.all');
Route::get('doctors/{hospital_id}','Relations\RelationsController@doctors')->name('hospital.doctors');
Route::get('delete/{hospital_id}','Relations\RelationsController@delete')->name('hospital.delete');

//many to many relationships
Route::get('doctor-services','Relations\RelationsController@getDoctorServices');
Route::get('service-doctors','Relations\RelationsController@getServiceDoctors');
Route::get('doctor/services/{doctor_id}','Relations\RelationsController@getDoctorServicesById')->name('doctor.services');
Route::post('doctor-services-save','Relations\RelationsController@saveDoctorServices')->name('doctor.services.store');

// has one through
Route::get('has-one-through','Relations\RelationsController@getPatientDocotor');

// has many through
Route::get('has-many-through','Relations\RelationsController@getCountryDocotors');




###################### End Relations #################################
