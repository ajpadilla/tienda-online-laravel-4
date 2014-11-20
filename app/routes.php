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

	Route::get(LaravelLocalization::transRoute('discounts.create'), [
		'as' => 'discounts.create',
		'uses' => 'DiscountController@create'
	]);

	Route::post(LaravelLocalization::transRoute('discounts.store'), [
		'as' => 'discounts.store',
		'uses' => 'DiscountController@store'
	]);


	Route::get(LaravelLocalization::transRoute('discounts.index'), [
		'as' => 'discounts.index',
		'uses' => 'DiscountController@index'
	]);


	Route::get(LaravelLocalization::transRoute('discounts.show'), [
		'as' => 'discounts.show',
		'uses' => 'DiscountController@show'
	]);

	Route::get(LaravelLocalization::transRoute('discounts.edit'), [
		'as' => 'discounts.edit',
		'uses' => 'DiscountController@edit'
	]);

	Route::post(LaravelLocalization::transRoute('discounts.update'), [
		'as' => 'discounts.update',
		'uses' => 'DiscountController@update'
	]);

	Route::get(LaravelLocalization::transRoute('discounts.destroy'), [
		'as' => 'discounts.destroy',
		'uses' => 'DiscountController@destroy'
	]);

	Route::get('delete/{id}','DiscountController@destroy');
	Route::post('checkCode','DiscountController@checkCode');
	Route::post('checkCodeForEdit','DiscountController@checkCodeForEdit');
	Route::get('api/discounts', array('as'=>'api.discounts', 'uses'=>'DiscountController@getDatatable'));

	/**
		* ------------------------------ Rutas para Typo de descuento -----------------------
	**/
	Route::get(LaravelLocalization::transRoute('discountType.create'), [
		'as' => 'discountType.create',
		'uses' => 'DiscountTypeController@create'
	]);

	Route::post(LaravelLocalization::transRoute('discountType.store'), [
		'as' => 'discountType.store',
		'uses' => 'DiscountTypeController@store'
	]);

	Route::get(LaravelLocalization::transRoute('discountType.index'), [
		'as' => 'discountType.index',
		'uses' => 'DiscountTypeController@index'
	]);


	Route::get(LaravelLocalization::transRoute('discountType.show'), [
		'as' => 'discountType.show',
		'uses' => 'DiscountTypeController@show'
	]);

	Route::get(LaravelLocalization::transRoute('discountType.edit'), [
		'as' => 'discountType.edit',
		'uses' => 'DiscountTypeController@edit'
	]);

	Route::post(LaravelLocalization::transRoute('discountType.update'), [
		'as' => 'discountType.update',
		'uses' => 'DiscountTypeController@update'
	]);

	Route::get(LaravelLocalization::transRoute('discountType.destroy'), [
		'as' => 'discountType.destroy',
		'uses' => 'DiscountTypeController@destroy'
	]);

	Route::post('checkName','DiscountTypeController@checkName');

	Route::get('api/discountType', array('as'=>'api.discountType', 'uses'=>'DiscountTypeController@getDatatable'));


	/**
		* ------------------------------ Rutas para lenguajes -----------------------
	**/

	Route::get(LaravelLocalization::transRoute('languages.create'),'LanguageController@create');
	Route::post(LaravelLocalization::transRoute('languages.store'),'LanguageController@store');
	Route::post('checkIsoCodeLang','LanguageController@checkIsoCodeLang');
	Route::get('returnLanguages','LanguageController@returnLanguages');
	Route::post('getIdLanguage','LanguageController@getIdLanguage');
	Route::get('mostar','LanguageController@mostrar');

	/**
		* ------------------------------ Rutas shipment status  -----------------------
	**/

	Route::get(LaravelLocalization::transRoute('shipmentStatus.create'), [
		'as' => 'shipmentStatus.create',
		'uses' => 'ShipmentStatusController@create'
	]);

	Route::post(LaravelLocalization::transRoute('shipmentStatus.store'), [
		'as' => 'shipmentStatus.store',
		'uses' => 'ShipmentStatusController@store'
	]);

	Route::get(LaravelLocalization::transRoute('shipmentStatus.index'), [
		'as' => 'shipmentStatus.index',
		'uses' => 'ShipmentStatusController@index'
	]);

	Route::get(LaravelLocalization::transRoute('shipmentStatus.edit'), [
		'as' => 'shipmentStatus.edit',
		'uses' => 'ShipmentStatusController@edit'
	]);

	Route::get(LaravelLocalization::transRoute('shipmentStatus.show'), [
		'as' => 'shipmentStatus.show',
		'uses' => 'ShipmentStatusController@show'
	]);

	Route::post(LaravelLocalization::transRoute('shipmentStatus.update'), [
		'as' => 'shipmentStatus.update',
		'uses' => 'ShipmentStatusController@update'
	]);

	Route::get(LaravelLocalization::transRoute('shipmentStatus.destroy'), [
		'as' => 'shipmentStatus.destroy',
		'uses' => 'ShipmentStatusController@destroy'
	]);


	Route::get('api/shipmentStatus', array('as'=>'api.shipmentStatus', 'uses'=>'ShipmentStatusController@getDatatable'));

	Route::post('checkColorShipmentStatus','ShipmentStatusController@checkColorShipmentStatus');
	Route::post('checkNameShipmentStatus','ShipmentStatusController@checkNameShipmentStatus');

	/**
		* ------------------------------ Rutas Invoice status  -----------------------
	**/

	Route::get(LaravelLocalization::transRoute('invoiceStatus.create'), [
		'as' => 'invoiceStatus.create',
		'uses' => 'InvoiceStatusController@create'
	]);

	Route::post(LaravelLocalization::transRoute('invoiceStatus.store'), [
		'as' => 'invoiceStatus.store',
		'uses' => 'InvoiceStatusController@store'
	]);

	Route::get(LaravelLocalization::transRoute('invoiceStatus.index'), [
		'as' => 'invoiceStatus.index',
		'uses' => 'InvoiceStatusController@index'
	]);

	Route::get(LaravelLocalization::transRoute('invoiceStatus.edit'), [
		'as' => 'invoiceStatus.edit',
		'uses' => 'InvoiceStatusController@edit'
	]);

	Route::get(LaravelLocalization::transRoute('invoiceStatus.show'), [
		'as' => 'invoiceStatus.show',
		'uses' => 'InvoiceStatusController@show'
	]);

	Route::post(LaravelLocalization::transRoute('invoiceStatus.update'), [
		'as' => 'invoiceStatus.update',
		'uses' => 'InvoiceStatusController@update'
	]);

	Route::get(LaravelLocalization::transRoute('invoiceStatus.destroy'), [
		'as' => 'invoiceStatus.destroy',
		'uses' => 'InvoiceStatusController@destroy'
	]);


	Route::get('api/invoiceStatus', array('as'=>'api.invoiceStatus', 'uses'=>'InvoiceStatusController@getDatatable'));
	Route::post('checkNameInvoiceStatus','InvoiceStatusController@checkNameInvoiceStatus');

	/**
		* ------------------------------ Rutas classified type -----------------------
	**/

	Route::get(LaravelLocalization::transRoute('classifiedTypes.create'), [
		'as' => 'classifiedTypes.create',
		'uses' => 'ClassifiedTypeController@create'
	]);

	Route::post(LaravelLocalization::transRoute('classifiedTypes.store'), [
		'as' => 'classifiedTypes.store',
		'uses' => 'ClassifiedTypeController@store'
	]);

	Route::get(LaravelLocalization::transRoute('classifiedTypes.index'), [
		'as' => 'classifiedTypes.index',
		'uses' => 'ClassifiedTypeController@index'
	]);


	Route::get(LaravelLocalization::transRoute('classifiedTypes.show'), [
		'as' => 'classifiedTypes.show',
		'uses' => 'ClassifiedTypeController@show'
	]);

	Route::get(LaravelLocalization::transRoute('classifiedTypes.edit'), [
		'as' => 'classifiedTypes.edit',
		'uses' => 'ClassifiedTypeController@edit'
	]);

	Route::post(LaravelLocalization::transRoute('classifiedTypes.update'), [
		'as' => 'classifiedTypes.update',
		'uses' => 'ClassifiedTypeController@update'
	]);

	Route::get(LaravelLocalization::transRoute('classifiedTypes.destroy'), [
		'as' => 'classifiedTypes.destroy',
		'uses' => 'ClassifiedTypeController@destroy'
	]);

	Route::post('checkNameClassifiedType','ClassifiedTypeController@checkName');

	Route::get('api/classifiedTypes', array('as'=>'api.classifiedTypes', 'uses'=>'ClassifiedTypeController@getDatatable'));

	/**
		* ------------------------------ Rutas classified conditions -----------------------
	**/

	Route::get(LaravelLocalization::transRoute('classifiedConditions.create'), [
		'as' => 'classifiedConditions.create',
		'uses' => 'ClassifiedConditionController@create'
	]);

	Route::post(LaravelLocalization::transRoute('classifiedConditions.store'), [
		'as' => 'classifiedConditions.store',
		'uses' => 'ClassifiedConditionController@store'
	]);

	Route::get(LaravelLocalization::transRoute('classifiedConditions.index'), [
		'as' => 'classifiedConditions.index',
		'uses' => 'ClassifiedConditionController@index'
	]);


	Route::get(LaravelLocalization::transRoute('classifiedConditions.show'), [
		'as' => 'classifiedConditions.show',
		'uses' => 'ClassifiedConditionController@show'
	]);

	Route::get(LaravelLocalization::transRoute('classifiedConditions.edit'), [
		'as' => 'classifiedConditions.edit',
		'uses' => 'ClassifiedConditionController@edit'
	]);

	Route::post(LaravelLocalization::transRoute('classifiedConditions.update'), [
		'as' => 'classifiedConditions.update',
		'uses' => 'ClassifiedConditionController@update'
	]);

	Route::get(LaravelLocalization::transRoute('classifiedConditions.destroy'), [
		'as' => 'classifiedConditions.destroy',
		'uses' => 'ClassifiedConditionController@destroy'
	]);

	Route::post('checkNameClassifiedCondition','ClassifiedConditionController@checkName');

	Route::get('api/classifiedConditions', array('as'=>'api.classifiedConditions', 'uses'=>'ClassifiedConditionController@getDatatable'));


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
