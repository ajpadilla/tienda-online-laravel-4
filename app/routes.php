<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
 */

Route::group(array('prefix' => LaravelLocalization::setLocale(),
					'before' => 'LaravelLocalizationRoutes|LaravelLocalizationRedirectFilter'), 
function () {
	/** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/

	Route::get('/', [
		'as' => 'pages.home',
		'uses' => 'PageController@home'
	]);

	/**
		* ------------------------------ Rutas para descuentos -----------------------
	**/
	Route::get(LaravelLocalization::transRoute('discounts.create'),'DiscountController@create');
	Route::post(LaravelLocalization::transRoute('discounts.store'),'DiscountController@store');
	Route::get('delete/{id}','DiscountController@destroy');
	Route::post('verificarCodigo','DiscountController@verificarCodigo');
	Route::get('api/discounts', array('as'=>'api.discounts', 'uses'=>'DiscountController@getDatatable'));

	/**
		* ------------------------------ Rutas para Typo de descuento -----------------------
	**/
	Route::resource('discounts_type','DiscountTypeController');

});

// Confide routes
Route::get('user/create', 'UserController@create');
Route::post('user', 'UserController@store');
Route::get('login', 'UserController@login');
Route::post('login', 'UserController@do_login');
Route::get('user/confirm/{code}', 'UserController@confirm');
Route::get('user/forgot_password', 'UserController@forgot_password');
Route::post('user/forgot_password', 'UserController@do_forgot_password');
Route::get('user/reset_password/{token}', 'UserController@reset_password');
Route::post('user/reset_password', 'UserController@do_reset_password');
Route::get('user/logout', 'UserController@logout');
