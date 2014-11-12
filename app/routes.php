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
	* ------------------------------ Rutas para productos -----------------------
	**/
	Route::get(LaravelLocalization::transRoute('products.create'), ['as' => 'products.create', 'uses' => 'ProductController@create'] );
	Route::post(LaravelLocalization::transRoute('products.store'), ['as' => 'products.store', 'uses' => 'ProductController@store' ] );
	Route::get(LaravelLocalization::transRoute('products.index'),  ['as' => 'products.index','uses' => 'ProductController@index' ] );
	Route::get(LaravelLocalization::transRoute('products.edit'),  ['as' => 'products.edit','uses' => 'ProductController@edit' ] );
	Route::post('product/update/{id}' ,  ['as' => 'products.update','uses' => 'ProductController@update' ] );
	Route::post('product/delete/{id}' ,  ['as' => 'products.destroy','uses' => 'ProductController@destroy' ] );

	//Datatable Products
	Route::get('api/products', array('as'=>'api.products', 'uses'=>'ProductController@getDatatable'));

	/**
	* ------------------------------ Rutas para Descuentos ----------------------
	**/


	Route::get(LaravelLocalization::transRoute('discounts.create'),'DiscountController@create');
	Route::post(LaravelLocalization::transRoute('discounts.store'),'DiscountController@store');
	Route::get(LaravelLocalization::transRoute('discounts.index'),'DiscountController@index');

	Route::get('delete/{id}','DiscountController@destroy');
	Route::post('checkCode','DiscountController@checkCode');
	Route::get('api/discounts', array('as'=>'api.discounts', 'uses'=>'DiscountController@getDatatable'));

	/**
		* ------------------------------ Rutas para Typo de descuento -----------------------
	**/
	Route::get(LaravelLocalization::transRoute('discountType.create'),'DiscountTypeController@create');
	Route::post(LaravelLocalization::transRoute('discountType.store'),'DiscountTypeController@store');
	Route::post('checkName','DiscountTypeController@checkName');

	/**
		* ------------------------------ Rutas para lenguajes -----------------------
	**/

	Route::get(LaravelLocalization::transRoute('languages.create'),'LanguageController@create');
	Route::post(LaravelLocalization::transRoute('languages.store'),'LanguageController@store');
	Route::post('checkIsoCodeLang','LanguageController@checkIsoCodeLang');
	Route::get('returnLanguages','LanguageController@returnLanguages');
	Route::post('getIdLanguage','LanguageController@getIdLanguage');
	Route::get('mostar','LanguageController@mostrar');
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
