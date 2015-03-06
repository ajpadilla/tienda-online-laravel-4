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
		'before' => 'auth',
		'as' => 'pages.home',
		'uses' => 'PageController@home'
	]);

	/**
	* ------------------------------ Rutas para productos -----------------------
	**/
	Route::get(LaravelLocalization::transRoute('products.create'), ['as' => 'products.create', 'uses' => 'ProductController@create'] );
	Route::post(LaravelLocalization::transRoute('products.store'), ['as' => 'products.store', 'uses' => 'ProductController@store' ] );
	Route::get(LaravelLocalization::transRoute('products.show'), ['as' => 'products.show', 'uses' => 'ProductController@show' ] );
	Route::get(LaravelLocalization::transRoute('products.index'),  ['as' => 'products.index','uses' => 'ProductController@index' ] );
	Route::get(LaravelLocalization::transRoute('products.edit'),  ['as' => 'products.edit','uses' => 'ProductController@edit' ] );
	Route::get(LaravelLocalization::transRoute('products.delete-ajax'),  ['as' => 'products.delete-ajax','uses' => 'ProductController@deleteAjax' ] );
	Route::post(LaravelLocalization::transRoute('products.update'),  ['as' => 'products.update','uses' => 'ProductController@update' ] );

	Route::post('product/delete/{id}' ,  ['as' => 'products.destroy','uses' => 'ProductController@destroy' ] );

	//Datatable Products
	Route::get('api/products', array('as'=>'api.products', 'uses'=>'ProductController@getAllProductsInCurrentLangData'));

	Route::get(LaravelLocalization::transRoute('products.search'), [
		'as' => 'products.search',
		'uses' => 'ProductController@search'
	]);

	Route::get('returnDataProduct','ProductController@returnDataProduct');

	Route::get('returnDataProductLang','ProductController@returnDataProductLang');

	Route::post(LaravelLocalization::transRoute('products.saveLang'), [
		'as' => 'products.saveLang',
		'uses' => 'ProductController@saveDataForLanguage'
	]);

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
	Route::post('checkNameForEditDiscountType','DiscountTypeController@checkNameForEdit');

	Route::get('api/discountType', array('as'=>'api.discountType', 'uses'=>'DiscountTypeController@getDatatable'));


	/**
		* ------------------------------ Rutas para lenguajes -----------------------
	**/

	Route::get(LaravelLocalization::transRoute('languages.create'), [
		'as' => 'languages.create',
		'uses' => 'LanguageController@create'
	]);

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
    Route::post('checkNameShipmentStatusEdit','ShipmentStatusController@checkNameForEdit');

   	Route::get('returnDatashipmentStatus','ShipmentStatusController@returnDataShipmentStatus');
	
	Route::get(LaravelLocalization::transRoute('shipmentStatus.delete-ajax'),  ['as' => 'shipmentStatus.delete-ajax','uses' => 'ShipmentStatusController@deleteAjax' ] );


	Route::get('returnDataShipmentStatusLang','ShipmentStatusController@returnDataShipmentStatusLang');

	Route::post(LaravelLocalization::transRoute('shipmentStatus.saveLang'), [
		'as' => 'shipmentStatus.saveLang',
		'uses' => 'ShipmentStatusController@saveDataForLanguage'
	]);

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
    Route::post('checkNameInvoiceStatusEdit','InvoiceStatusController@checkNameForEdit');


    
   	Route::get('returnDataInvoiceStatus','InvoiceStatusController@returnDataInvoiceStatus');
	
	Route::get(LaravelLocalization::transRoute('invoiceStatus.delete-ajax'),  ['as' => 'invoiceStatus.delete-ajax','uses' => 'InvoiceStatusController@deleteAjax' ] );


	Route::get('returnDatainvoiceStatusLang','InvoiceStatusController@returnDatainvoiceStatusLang');

	Route::post(LaravelLocalization::transRoute('invoiceStatus.saveLang'), [
		'as' => 'invoiceStatus.saveLang',
		'uses' => 'InvoiceStatusController@saveDataForLanguage'
	]);


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
    Route::post('checkNameClassifiedTypesEdit','ClassifiedTypeController@checkNameForEdit');


	Route::get('api/classifiedTypes', array('as'=>'api.classifiedTypes', 'uses'=>'ClassifiedTypeController@getDatatable'));

	Route::get('returnDataForLangClassifiedTypes','ClassifiedTypeController@returnDataForLang');

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

	Route::post('verificateNameClassifiedCondition','ClassifiedConditionController@checkNameClassifiedCondition');
	Route::post('checkNameClassifiedConditionEdit','ClassifiedConditionController@checkNameForEdit');


	Route::get('api/classifiedConditions', array('as'=>'api.classifiedConditions', 'uses'=>'ClassifiedConditionController@getDatatable'));

	Route::get('returnDataForLangClassifiedCondition','ClassifiedConditionController@returnDataForLang');

	/**
		* ------------------------------ Rutas ProductConditions -----------------------
	**/

		Route::get('returnDataForLangProductCondition','ProductConditionController@returnDataForLang');

	/**
		* ------------------------------ Rutas classifieds -----------------------
	**/

	Route::get(LaravelLocalization::transRoute('classifieds.create'), [
		'as' => 'classifieds.create',
		'uses' => 'ClassifiedController@create'
	]);

	Route::post(LaravelLocalization::transRoute('classifieds.store'), [
		'as' => 'classifieds.store',
		'uses' => 'ClassifiedController@store'
	]);

	Route::get(LaravelLocalization::transRoute('classifieds.index'), [
		'as' => 'classifieds.index',
		'uses' => 'ClassifiedController@index'
	]);


	Route::get(LaravelLocalization::transRoute('classifieds.show'), [
		'as' => 'classifieds.show',
		'uses' => 'ClassifiedController@show'
	]);

	Route::get(LaravelLocalization::transRoute('classifieds.edit'), [
		'as' => 'classifieds.edit',
		'uses' => 'ClassifiedController@edit'
	]);

	Route::post(LaravelLocalization::transRoute('classifieds.update'), [
		'as' => 'classifieds.update',
		'uses' => 'ClassifiedController@update'
	]);

	Route::get(LaravelLocalization::transRoute('classifieds.destroy'), [
		'as' => 'classifieds.destroy',
		'uses' => 'ClassifiedController@destroy'
	]);

	Route::get(LaravelLocalization::transRoute('classifieds.search'), [
		'as' => 'classifieds.search',
		'uses' => 'ClassifiedController@viewSearchClassifieds'
	]);

	Route::post(LaravelLocalization::transRoute('classifieds.filterClassified'), [
		'as' => 'classifieds.filterClassified',
		'uses' => 'ClassifiedController@searchClassified'
	]);

	Route::get('countries','ClassifiedController@countries');
	Route::get('statesForCountry','ClassifiedController@statesForCountry');
	Route::get('citiesForState','ClassifiedController@citiesForState');


	Route::get('returnDataClassifiedLang','ClassifiedController@returnDataClassifiedLang');

	Route::post(LaravelLocalization::transRoute('classifieds.saveLang'), [
		'as' => 'classifieds.saveLang',
		'uses' => 'ClassifiedController@saveCurrentLangAttribute'
	]);

	Route::get(LaravelLocalization::transRoute('classifieds.delete-ajax'),  ['as' => 'classifieds.delete-ajax','uses' => 'ClassifiedController@deleteAjax' ] );

	Route::post('checkNameClassified','ClassifiedController@checkNameClassified');
	Route::post('checkNameClassifiedEdit','ClassifiedController@checkNameForEdit');

	Route::get('returnDataClassified','ClassifiedController@returnDataClassified');

	Route::get('api/classifieds', array('as'=>'api.classifieds', 'uses'=>'ClassifiedController@getDatatable'));


	/**
		* ------------------------------ Rutas Photos Clasificados-----------------------
	**/

	Route::get(LaravelLocalization::transRoute('photoClassified.create'), [
		'as' => 'photoClassified.create',
		'uses' => 'PhotosClassifiedsController@create'
	]);

	Route::post(LaravelLocalization::transRoute('photoClassified.store'), [
		'as' => 'photoClassified.store',
		'uses' => 'PhotosClassifiedsController@store'
	]);

	/**
		* ------------------------------ Rutas Photos Productos-----------------------
	**/

	Route::get(LaravelLocalization::transRoute('photoProduct.create'), [
		'as' => 'photoProduct.create',
		'uses' => 'PhotosProductsController@create'
	]);

	Route::post(LaravelLocalization::transRoute('photoProduct.store'), [
		'as' => 'photoProduct.store',
		'uses' => 'PhotosProductsController@store'
	]);


	/**
		* ------------------------------ Rutas Categories -----------------------
	**/

	Route::get(LaravelLocalization::transRoute('categories.create'), [
		'as' => 'categories.create',
		'uses' => 'CategoriesController@create'
	]);

	Route::post(LaravelLocalization::transRoute('categories.store'), [
		'as' => 'categories.store',
		'uses' => 'CategoriesController@store'
	]);

	Route::get(LaravelLocalization::transRoute('categories.index'), [
		'as' => 'categories.index',
		'uses' => 'CategoriesController@index'
	]);


	Route::get(LaravelLocalization::transRoute('categories.show'), [
		'as' => 'categories.show',
		'uses' => 'CategoriesController@show'
	]);

	Route::get(LaravelLocalization::transRoute('categories.edit'), [
		'as' => 'categories.edit',
		'uses' => 'CategoriesController@edit'
	]);

	Route::post(LaravelLocalization::transRoute('categories.update'), [
		'as' => 'categories.update',
		'uses' => 'CategoriesController@update'
	]);

	Route::get(LaravelLocalization::transRoute('categories.destroy'), [
		'as' => 'categories.destroy',
		'uses' => 'CategoriesController@destroy'
	]);

	Route::get('api/categories', array('as'=>'api.categories', 'uses'=>'CategoriesController@getDatatable'));

	//Route::get('returnDataCategoriesLang','CategoriesController@returnDataCategoriesLang');	

	Route::get('returnDataCategoriesLang', [
		'as' => 'categories.dataLang',
		'uses' => 'CategoriesController@returnDataCategoriesLang'
	]);

	/**
		* ------------------------------ Rutas Categories -----------------------
	**/

	Route::get(LaravelLocalization::transRoute('attributeType.create'), [
		'as' => 'attributeType.create',
		'uses' => 'AttributeTypeController@create'
	]);

	Route::post(LaravelLocalization::transRoute('attributeType.store'), [
		'as' => 'attributeType.store',
		'uses' => 'AttributeTypeController@store'
	]);

	Route::get(LaravelLocalization::transRoute('attributeType.index'), [
		'as' => 'attributeType.index',
		'uses' => 'AttributeTypeController@index'
	]);


	Route::get(LaravelLocalization::transRoute('attributeType.show'), [
		'as' => 'attributeType.show',
		'uses' => 'AttributeTypeController@show'
	]);

	Route::get(LaravelLocalization::transRoute('attributeType.edit'), [
		'as' => 'attributeType.edit',
		'uses' => 'AttributeTypeController@edit'
	]);

	Route::post(LaravelLocalization::transRoute('attributeType.update'), [
		'as' => 'attributeType.update',
		'uses' => 'AttributeTypeController@update'
	]);

	Route::get(LaravelLocalization::transRoute('attributeType.destroy'), [
		'as' => 'attributeType.destroy',
		'uses' => 'AttributeTypeController@destroy'
	]);

	Route::get('api/attributeType', array('as'=>'api.attributeType', 'uses'=>'AttributeTypeController@getDatatable'));

	/**
		* ------------------------------ Rutas Carro de compras-----------------------
	**/
	Route::resource('cart', 'CartController', ['except' => ['create']]);
	Route::get(LaravelLocalization::transRoute('cart.create'), [
		'as' => 'cart.create',
		'uses' => 'CartController@create'
	]);

	/**
		* ------------------------------ Rutas Lista de Deseos-----------------------
	**/
	Route::get(LaravelLocalization::transRoute('wishlist.create'), [
		'as' => 'wishlist.create',
		'uses' => 'WishlistController@create'
	]);
	Route::get(LaravelLocalization::transRoute('wishlist.index'), [
		'as' => 'wishlist.index',
		'uses' => 'WishlistController@index'
	]);
	Route::get(LaravelLocalization::transRoute('wishlist.delete-ajax'), [
		'as' => 'wishlist.delete-ajax',
		'uses' => 'WishlistController@deleteAjax'
	]);

	/**
		* ------------------------------ Rutas Carrito de Compras-----------------------
	**/
	Route::get(LaravelLocalization::transRoute('cart.show'), [
		'as' => 'cart.show',
		'uses' => 'CartController@show'
	]);
	Route::get(LaravelLocalization::transRoute('cart.create'), [
		'as' => 'cart.create',
		'uses' => 'CartController@create'
	]);
	Route::get(LaravelLocalization::transRoute('cart.index'), [
		'as' => 'cart.index',
		'uses' => 'CartController@index'
	]);
	Route::get(LaravelLocalization::transRoute('cart.delete-ajax'), [
		'as' => 'cart.delete-ajax',
		'uses' => 'CartController@deleteAjax'
	]);
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
Route::get('user/logout', [
	'as' => 'logout',
	'uses' => 'UserController@logout'
]);
