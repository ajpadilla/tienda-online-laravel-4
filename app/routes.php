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
	Route::get(LaravelLocalization::transRoute('products.prueba'), ['as' => 'prueba', 'uses' => 'ProductController@prueba'] );

	Route::get(LaravelLocalization::transRoute('products.routes.index'),  ['as' => 'products.index','uses' => 'ProductController@index' ] );
	Route::get(LaravelLocalization::transRoute('products.routes.create'), ['as' => 'products.create', 'uses' => 'ProductController@create'] );
	Route::post(LaravelLocalization::transRoute('products.routes.store'), ['as' => 'products.routes.store', 'uses' => 'ProductController@store' ] );
	Route::get(LaravelLocalization::transRoute('products.routes.show'), ['as' => 'products.show', 'uses' => 'ProductController@show' ] );
	Route::get(LaravelLocalization::transRoute('products.routes.edit'),  ['as' => 'products.edit','uses' => 'ProductController@edit' ] );
	Route::get(LaravelLocalization::transRoute('products.routes.api.delete'),  ['as' => 'products.api.delete','uses' => 'ProductController@destroyApi' ] );
	Route::post(LaravelLocalization::transRoute('products.routes.api.update'),  ['as' => 'products.api.update','uses' => 'ProductController@updateApi' ] );

	Route::post('product/delete/{id}' ,  ['as' => 'products.destroy','uses' => 'ProductController@destroy' ] );
	Route::get(LaravelLocalization::transRoute('products.routes.api.list'), ['as'=>'products.routes.api.list', 'uses'=>'ProductController@listApi']);

	Route::get(LaravelLocalization::transRoute('products.routes.search'), [
		'as' => 'products.search',
		'uses' => 'ProductController@search'
	]);

	Route::get(LaravelLocalization::transRoute('products.routes.filterWord'), [
		'as' => 'products.filterWord',
		'uses' => 'ProductController@getCurrentFilterWorld'
	]);

	Route::get('/ajax/paginator','ProductController@searchPaginator');

	Route::get('products/api-show',  ['as' => 'products.api.show','uses' => 'ProductController@showApi' ] );

	Route::get('products/api-show-lang', ['as'=>'products.api.show-lang','uses' => 'ProductController@showApiLang']);

	Route::post(LaravelLocalization::transRoute('products.routes.api.saveLang'), [
		'as' => 'products.routes.api.saveLang',
		'uses' => 'ProductController@updateApiLang'
	]);

	Route::get(LaravelLocalization::transRoute('products.routes.order-by-search'), [
		'as' => 'products.order-by-search',
		'uses' => 'ProductController@sortSearchResults'
	]);

	Route::post(LaravelLocalization::transRoute('products.routes.save-rating'), [
		'as' => 'products.save-rating',
		'uses' => 'ProductController@saveRating'
	]);

	/**
	* ------------------------------ Rutas para Descuentos ----------------------
	**/

	Route::get(LaravelLocalization::transRoute('discounts.routes.create'), [
		'as' => 'discounts.create',
		'uses' => 'DiscountController@create'
	]);

	Route::post(LaravelLocalization::transRoute('discounts.routes.store'), [
		'as' => 'discounts.store',
		'uses' => 'DiscountController@store'
	]);


	Route::get(LaravelLocalization::transRoute('discounts.routes.index'), [
		'as' => 'discounts.index',
		'uses' => 'DiscountController@index'
	]);


	Route::get(LaravelLocalization::transRoute('discounts.routes.show'), [
		'as' => 'discounts.show',
		'uses' => 'DiscountController@show'
	]);

	Route::get('discounts/api-show',  ['as' => 'discounts.api.show','uses' => 'DiscountController@showApi' ] );

	Route::get(LaravelLocalization::transRoute('discounts.routes.api.delete'),  ['as' => 'discounts.api.delete','uses' => 'DiscountController@destroyApi' ] );

	Route::get(LaravelLocalization::transRoute('discounts.routes.edit'), [
		'as' => 'discounts.edit',
		'uses' => 'DiscountController@edit'
	]);

	Route::post(LaravelLocalization::transRoute('discounts.routes.api.update'), [
		'as' => 'discounts.api.update',
		'uses' => 'DiscountController@updateApi'
	]);

	Route::get('discounts/api-show-lang', ['as'=>'discounts.api.show-lang','uses' => 'DiscountController@showApiLang']);

	Route::get(LaravelLocalization::transRoute('discounts.routes.destroy'), [
		'as' => 'discounts.destroy',
		'uses' => 'DiscountController@destroy'
	]);

	Route::get(LaravelLocalization::transRoute('discounts.routes.api.list'), ['as'=>'discounts.routes.api.list', 'uses'=>'DiscountController@listApi']);

	Route::get('delete/{id}','DiscountController@destroy');
	Route::post('checkCode','DiscountController@checkCode');
	Route::post('checkCodeForEdit','DiscountController@checkCodeForEdit');

	Route::post(LaravelLocalization::transRoute('discounts.routes.api.saveLang'), [
		'as' => 'discounts.routes.api.saveLang',
		'uses' => 'DiscountController@updateApiLang'
	]);


	
	/**
		* ------------------------------ Rutas para Typo de descuento -----------------------
	**/
	Route::get(LaravelLocalization::transRoute('discountType.routes.create'), [
		'as' => 'discountType.create',
		'uses' => 'DiscountTypeController@create'
	]);

	Route::post(LaravelLocalization::transRoute('discountType.routes.store'), [
		'as' => 'discountType.store',
		'uses' => 'DiscountTypeController@store'
	]);

	Route::get(LaravelLocalization::transRoute('discountType.routes.index'), [
		'as' => 'discountType.index',
		'uses' => 'DiscountTypeController@index'
	]);


	Route::get(LaravelLocalization::transRoute('discountType.routes.api.list'),[
		'as'=>'discountType.api.list', 
		'uses'=>'DiscountTypeController@listApi'
	 ]);


	Route::get(LaravelLocalization::transRoute('discountType.routes.show'), [
		'as' => 'discountType.show',
		'uses' => 'DiscountTypeController@show'
	]);

	Route::get('discountType/api-show',  [
		'as' => 'discountType.api.show',
		'uses' => 'DiscountTypeController@showApi' 
	] );

	Route::get('discountType/api-show-lang', [
		'as'=>'discountType.api.show-lang',
		'uses' => 'DiscountTypeController@showApiLang'
	]);

	Route::post(LaravelLocalization::transRoute('discountType.routes.api.saveLang'), [
		'as' => 'discountType.api.saveLang',
		'uses' => 'DiscountTypeController@updateApiLang'
	]);

	Route::get(LaravelLocalization::transRoute('discountType.routes.edit'), [
		'as' => 'discountType.edit',
		'uses' => 'DiscountTypeController@edit'
	]);

	Route::post(LaravelLocalization::transRoute('discountType.routes.update'), [
		'as' => 'discountType.update',
		'uses' => 'DiscountTypeController@update'
	]);

	Route::post(LaravelLocalization::transRoute('discountType.routes.api.update'), [
		'as' => 'discountType.api.update',
		'uses' => 'DiscountTypeController@updateApi'
	]);

	Route::get(LaravelLocalization::transRoute('discountType.routes.destroy'), [
		'as' => 'discountType.destroy',
		'uses' => 'DiscountTypeController@destroy'
	]);

	Route::get(LaravelLocalization::transRoute('discountType.routes.api.delete'),  [
		'as' => 'discountType.api.delete',
		'uses' => 'DiscountTypeController@destroyApi' 
	] );


	Route::post('checkName','DiscountTypeController@checkName');
	Route::post('checkNameForEditDiscountType','DiscountTypeController@checkNameForEdit');

	/**
		* ------------------------------ Rutas para lenguajes -----------------------
	**/

	Route::get(LaravelLocalization::transRoute('languages.routes.create'), [
		'as' => 'languages.create',
		'uses' => 'LanguageController@create'
	]);

	Route::post(LaravelLocalization::transRoute('languages.routes.store'),'LanguageController@store');
	Route::post('checkIsoCodeLang','LanguageController@checkIsoCodeLang');
	Route::get('returnLanguages','LanguageController@returnLanguages');
	Route::post('getIdLanguage','LanguageController@getIdLanguage');
	Route::get('mostar','LanguageController@mostrar');

	/**
		* ------------------------------ Rutas shipment status  -----------------------
	**/

	Route::get(LaravelLocalization::transRoute('shipmentStatus.routes.create'), [
		'as' => 'shipmentStatus.create',
		'uses' => 'ShipmentStatusController@create'
	]);

	Route::post(LaravelLocalization::transRoute('shipmentStatus.routes.store'), [
		'as' => 'shipmentStatus.store',
		'uses' => 'ShipmentStatusController@store'
	]);

	Route::get(LaravelLocalization::transRoute('shipmentStatus.routes.index'), [
		'as' => 'shipmentStatus.index',
		'uses' => 'ShipmentStatusController@index'
	]);

	Route::get(LaravelLocalization::transRoute('shipmentStatus.routes.api.list'),[
		'as'=>'shipmentStatus.api.list', 
		'uses'=>'ShipmentStatusController@listApi'
	 ]);

	Route::get(LaravelLocalization::transRoute('shipmentStatus.routes.edit'), [
		'as' => 'shipmentStatus.edit',
		'uses' => 'ShipmentStatusController@edit'
	]);

	Route::get(LaravelLocalization::transRoute('shipmentStatus.routes.show'), [
		'as' => 'shipmentStatus.show',
		'uses' => 'ShipmentStatusController@show'
	]);

	Route::get(LaravelLocalization::transRoute('shipmentStatus.routes.api.show'), [
		'as' => 'shipmentStatus.api.show',
		'uses' => 'ShipmentStatusController@showApi'
	]);

	Route::get('shipmentStatus/api-show-lang', [
		'as'=>'shipmentStatus.api.show-lang',
		'uses' => 'ShipmentStatusController@showApiLang'
	]);


	Route::post(LaravelLocalization::transRoute('shipmentStatus.routes.update'), [
		'as' => 'shipmentStatus.update',
		'uses' => 'ShipmentStatusController@update'
	]);

	Route::post(LaravelLocalization::transRoute('shipmentStatus.routes.api.update'), [
		'as' => 'shipmentStatus.api.update',
		'uses' => 'ShipmentStatusController@updateApi'
	]);

	Route::get(LaravelLocalization::transRoute('shipmentStatus.routes.destroy'), [
		'as' => 'shipmentStatus.destroy',
		'uses' => 'ShipmentStatusController@destroy'
	]);

	Route::get(LaravelLocalization::transRoute('shipmentStatus.routes.api.delete'),  [
		'as' => 'shipmentStatus.api.delete',
		'uses' => 'ShipmentStatusController@destroyApi' 
	] );

	Route::post('checkColorShipmentStatus','ShipmentStatusController@checkColorShipmentStatus');
	Route::post('checkNameShipmentStatus','ShipmentStatusController@checkNameShipmentStatus');
    Route::post('checkNameShipmentStatusEdit','ShipmentStatusController@checkNameForEdit');

   	Route::get('returnDatashipmentStatus','ShipmentStatusController@returnDataShipmentStatus');

	Route::get('returnDataShipmentStatusLang','ShipmentStatusController@returnDataShipmentStatusLang');

	Route::post(LaravelLocalization::transRoute('shipmentStatus.routes.api.saveLang'), [
		'as' => 'shipmentStatus.api.saveLang',
		'uses' => 'ShipmentStatusController@updateApiLang'
	]);

	/**
		* ------------------------------ Rutas Invoice status  -----------------------
	**/

	Route::get(LaravelLocalization::transRoute('invoiceStatus.routes.create'), [
		'as' => 'invoiceStatus.create',
		'uses' => 'InvoiceStatusController@create'
	]);

	Route::post(LaravelLocalization::transRoute('invoiceStatus.routes.store'), [
		'as' => 'invoiceStatus.store',
		'uses' => 'InvoiceStatusController@store'
	]);

	Route::get(LaravelLocalization::transRoute('invoiceStatus.routes.index'), [
		'as' => 'invoiceStatus.index',
		'uses' => 'InvoiceStatusController@index'
	]);

	Route::get(LaravelLocalization::transRoute('invoiceStatus.routes.api.list'),[
		'as'=>'invoiceStatus.api.list', 
		'uses'=>'InvoiceStatusController@listApi'
	 ]);

	Route::get(LaravelLocalization::transRoute('invoiceStatus.routes.edit'), [
		'as' => 'invoiceStatus.edit',
		'uses' => 'InvoiceStatusController@edit'
	]);

	Route::get(LaravelLocalization::transRoute('invoiceStatus.routes.show'), [
		'as' => 'invoiceStatus.show',
		'uses' => 'InvoiceStatusController@show'
	]);

	Route::get(LaravelLocalization::transRoute('invoiceStatus.routes.api.show'), [
		'as' => 'invoiceStatus.api.show',
		'uses' => 'InvoiceStatusController@showApi'
	]);

	Route::get('invoiceStatus/api-show-lang', [
		'as'=>'invoiceStatus.api.show-lang',
		'uses' => 'InvoiceStatusController@showApiLang'
	]);

	Route::post(LaravelLocalization::transRoute('invoiceStatus.routes.update'), [
		'as' => 'invoiceStatus.update',
		'uses' => 'InvoiceStatusController@update'
	]);

	Route::post(LaravelLocalization::transRoute('invoiceStatus.routes.api.update'), [
		'as' => 'invoiceStatus.api.update',
		'uses' => 'InvoiceStatusController@updateApi'
	]);

	Route::post(LaravelLocalization::transRoute('invoiceStatus.routes.api.saveLang'), [
		'as' => 'invoiceStatus.api.saveLang',
		'uses' => 'InvoiceStatusController@updateApiLang'
	]);

	Route::get(LaravelLocalization::transRoute('invoiceStatus.routes.destroy'), [
		'as' => 'invoiceStatus.destroy',
		'uses' => 'InvoiceStatusController@destroy'
	]);

	Route::get(LaravelLocalization::transRoute('invoiceStatus.routes.api.delete'),  [
		'as' => 'invoiceStatus.api.delete',
		'uses' => 'InvoiceStatusController@destroyApi' 
	] );

	Route::post('checkNameInvoiceStatus','InvoiceStatusController@checkNameInvoiceStatus');
    Route::post('checkNameInvoiceStatusEdit','InvoiceStatusController@checkNameForEdit');

   	Route::get('returnDataInvoiceStatus','InvoiceStatusController@returnDataInvoiceStatus');

	Route::get('returnDatainvoiceStatusLang','InvoiceStatusController@returnDatainvoiceStatusLang');



	/**
		* ------------------------------ Rutas classified type -----------------------
	**/

	Route::get(LaravelLocalization::transRoute('classifiedTypes.routes.create'), [
		'as' => 'classifiedTypes.create',
		'uses' => 'ClassifiedTypeController@create'
	]);

	Route::post(LaravelLocalization::transRoute('classifiedTypes.routes.store'), [
		'as' => 'classifiedTypes.store',
		'uses' => 'ClassifiedTypeController@store'
	]);

	Route::get(LaravelLocalization::transRoute('classifiedTypes.routes.index'), [
		'as' => 'classifiedTypes.index',
		'uses' => 'ClassifiedTypeController@index'
	]);

	Route::get(LaravelLocalization::transRoute('classifiedTypes.routes.api.list'),[
		'as'=>'classifiedTypes.api.list', 
		'uses'=>'ClassifiedTypeController@listApi'
	]);

	Route::get(LaravelLocalization::transRoute('classifiedTypes.routes.show'), [
		'as' => 'classifiedTypes.show',
		'uses' => 'ClassifiedTypeController@show'
	]);

	Route::get(LaravelLocalization::transRoute('classifiedTypes.routes.api.show'), [
		'as' => 'classifiedTypes.api.show',
		'uses' => 'ClassifiedTypeController@showApi'
	]);

	Route::get('classifiedTypes/api-show-lang', [
		'as'=>'classifiedTypes.api.show-lang',
		'uses' => 'ClassifiedTypeController@showApiLang'
	]);

	Route::get(LaravelLocalization::transRoute('classifiedTypes.routes.edit'), [
		'as' => 'classifiedTypes.edit',
		'uses' => 'ClassifiedTypeController@edit'
	]);

	Route::post(LaravelLocalization::transRoute('classifiedTypes.routes.update'), [
		'as' => 'classifiedTypes.update',
		'uses' => 'ClassifiedTypeController@update'
	]);

	Route::post(LaravelLocalization::transRoute('classifiedTypes.routes.api.update'), [
		'as' => 'classifiedTypes.api.update',
		'uses' => 'ClassifiedTypeController@updateApi'
	]);

	Route::post(LaravelLocalization::transRoute('classifiedTypes.routes.api.saveLang'), [
		'as' => 'classifiedTypes.api.saveLang',
		'uses' => 'ClassifiedTypeController@updateApiLang'
	]);

	Route::get(LaravelLocalization::transRoute('classifiedTypes.routes.destroy'), [
		'as' => 'classifiedTypes.destroy',
		'uses' => 'ClassifiedTypeController@destroy'
	]);

	Route::get(LaravelLocalization::transRoute('classifiedTypes.routes.api.delete'),  [
		'as' => 'classifiedTypes.api.delete',
		'uses' => 'ClassifiedTypeController@destroyApi' 
	] );


	Route::post('checkNameClassifiedType','ClassifiedTypeController@checkName');
    Route::post('checkNameClassifiedTypesEdit','ClassifiedTypeController@checkNameForEdit');


	Route::get('api/classifiedTypes', array('as'=>'api.classifiedTypes', 'uses'=>'ClassifiedTypeController@getDatatable'));

	Route::get(LaravelLocalization::transRoute('classifiedTypes.current-lang'), [
		'as' => 'classifiedTypes.current-lang',
		'uses' => 'ClassifiedTypeController@returnAllForCurrentLang'
	]);

	/**
		* ------------------------------ Rutas classified conditions -----------------------
	**/

	Route::get(LaravelLocalization::transRoute('classifiedConditions.routes.create'), [
		'as' => 'classifiedConditions.create',
		'uses' => 'ClassifiedConditionController@create'
	]);

	Route::post(LaravelLocalization::transRoute('classifiedConditions.routes.store'), [
		'as' => 'classifiedConditions.store',
		'uses' => 'ClassifiedConditionController@store'
	]);

	Route::get(LaravelLocalization::transRoute('classifiedConditions.routes.api.index'), [
		'as' => 'classifiedConditions.index',
		'uses' => 'ClassifiedConditionController@index'
	]);

	Route::get(LaravelLocalization::transRoute('classifiedConditions.routes.api.list'),[
		'as'=>'classifiedConditions.api.list', 
		'uses'=>'ClassifiedConditionController@listApi'
	]);

	Route::get(LaravelLocalization::transRoute('classifiedConditions.routes.show'), [
		'as' => 'classifiedConditions.show',
		'uses' => 'ClassifiedConditionController@show'
	]);

	Route::get(LaravelLocalization::transRoute('classifiedConditions.routes.api.show'), [
		'as' => 'classifiedConditions.api.show',
		'uses' => 'ClassifiedConditionController@showApi'
	]);

	Route::get('classifiedConditions/api-show-lang', [
		'as'=>'classifiedConditions.api.show-lang',
		'uses' => 'ClassifiedConditionController@showApiLang'
	]);

	Route::get(LaravelLocalization::transRoute('classifiedConditions.routes.edit'), [
		'as' => 'classifiedConditions.edit',
		'uses' => 'ClassifiedConditionController@edit'
	]);

	Route::post(LaravelLocalization::transRoute('classifiedConditions.routes.update'), [
		'as' => 'classifiedConditions.update',
		'uses' => 'ClassifiedConditionController@update'
	]);

	Route::post(LaravelLocalization::transRoute('classifiedConditions.routes.api.update'), [
		'as' => 'classifiedConditions.api.update',
		'uses' => 'ClassifiedConditionController@updateApi'
	]);

	Route::post(LaravelLocalization::transRoute('classifiedConditions.routes.api.saveLang'), [
		'as' => 'classifiedConditions.api.saveLang',
		'uses' => 'ClassifiedConditionController@updateApiLang'
	]);

	Route::get(LaravelLocalization::transRoute('classifiedConditions.routes.destroy'), [
		'as' => 'classifiedConditions.destroy',
		'uses' => 'ClassifiedConditionController@destroy'
	]);

	Route::get(LaravelLocalization::transRoute('classifiedConditions.routes.api.delete'),  [
		'as' => 'classifiedConditions.api.delete',
		'uses' => 'ClassifiedConditionController@destroyApi' 
	] );

	Route::post('verificateNameClassifiedCondition','ClassifiedConditionController@checkNameClassifiedCondition');
	Route::post('checkNameClassifiedConditionEdit','ClassifiedConditionController@checkNameForEdit');


	Route::get('api/classifiedConditions', array('as'=>'api.classifiedConditions', 'uses'=>'ClassifiedConditionController@getDatatable'));

	Route::get(LaravelLocalization::transRoute('classifiedConditions.current-lang'), [
		'as' => 'classifiedConditions.current-lang',
		'uses' => 'ClassifiedConditionController@returnAllForCurrentLang'
	]);

	/**
		* ------------------------------ Rutas ProductConditions -----------------------
	**/


	Route::get(LaravelLocalization::transRoute('productCondition.current-lang'), [
		'as' => 'productCondition.current-lang',
		'uses' => 'ProductConditionController@returnAllForCurrentLang'
	]);


	/**
		* ------------------------------ Rutas classifieds -----------------------
	**/

	Route::get(LaravelLocalization::transRoute('classifieds.routes.create'), [
		'as' => 'classifieds.create',
		'uses' => 'ClassifiedController@create'
	]);

	Route::post(LaravelLocalization::transRoute('classifieds.routes.store'), [
		'as' => 'classifieds.store',
		'uses' => 'ClassifiedController@store'
	]);

	Route::get(LaravelLocalization::transRoute('classifieds.routes.index'), [
		'as' => 'classifieds.index',
		'uses' => 'ClassifiedController@index'
	]);


	Route::get(LaravelLocalization::transRoute('classifieds.routes.show'), [
		'as' => 'classifieds.show',
		'uses' => 'ClassifiedController@show'
	]);

	Route::get(LaravelLocalization::transRoute('classifieds.routes.edit'), [
		'as' => 'classifieds.edit',
		'uses' => 'ClassifiedController@edit'
	]);

	Route::post(LaravelLocalization::transRoute('classifieds.routes.api.update'), [
		'as' => 'classifieds.routes.api.update',
		'uses' => 'ClassifiedController@updateApi'
	]);

	Route::get(LaravelLocalization::transRoute('classifieds.routes.destroy'), [
		'as' => 'classifieds.destroy',
		'uses' => 'ClassifiedController@destroy'
	]);


	Route::get(LaravelLocalization::transRoute('classifieds.routes.search'), [
		'as' => 'classifieds.search',
		'uses' => 'ClassifiedController@viewSearchClassifieds'
	]);

	Route::post(LaravelLocalization::transRoute('classifieds.routes.filterClassified'), [
		'as' => 'classifieds.filterClassified',
		'uses' => 'ClassifiedController@searchClassified'
	]);

	

	Route::get('classifieds/api-show-lang',[ 'as' => 'classifieds.api.show-lang',
		'uses' => 'ClassifiedController@showApiLang'
	]);

	Route::post(LaravelLocalization::transRoute('classifieds.routes.api.saveLang'), [
		'as' => 'classifieds.routes.api.saveLang',
		'uses' => 'ClassifiedController@updateLangApi'
	]);

	Route::get(LaravelLocalization::transRoute('classifieds.routes.api.delete'),  
		['as' => 'classifieds.api.delete','uses' => 'ClassifiedController@destroyApi' 
	]);

	Route::post('checkNameClassified','ClassifiedController@checkNameClassified');
	Route::post('checkNameClassifiedEdit','ClassifiedController@checkNameForEdit');

	Route::get('classifieds/api-show',  ['as' => 'classifieds.api.show','uses' => 'ClassifiedController@showApi' ] );

	Route::get(LaravelLocalization::transRoute('classifieds.routes.api.list'), ['as'=>'classifieds.routes.api.list', 'uses'=>'ClassifiedController@listApi']);

	/**
		* ------------------------------ Rutas Photos Clasificados-----------------------
	**/

	Route::get(LaravelLocalization::transRoute('photoClassified.routes.create'), [
		'as' => 'photoClassified.create',
		'uses' => 'PhotosClassifiedsController@create'
	]);

	Route::post(LaravelLocalization::transRoute('photoClassified.routes.store'), [
		'as' => 'photoClassified.store',
		'uses' => 'PhotosClassifiedsController@store'
	]);

	/**
		* ------------------------------ Rutas Photos Productos-----------------------
	**/

	Route::get(LaravelLocalization::transRoute('photoProduct.routes.create'), [
		'as' => 'photoProduct.create',
		'uses' => 'PhotosProductsController@create'
	]);

	Route::post(LaravelLocalization::transRoute('photoProduct.routes.store'), [
		'as' => 'photoProduct.store',
		'uses' => 'PhotosProductsController@store'
	]);


	/**
		* ------------------------------ Rutas Categories -----------------------
	**/

	Route::get(LaravelLocalization::transRoute('categories.routes.create'), [
		'as' => 'categories.create',
		'uses' => 'CategoriesController@create'
	]);

	Route::post(LaravelLocalization::transRoute('categories.routes.store'), [
		'as' => 'categories.store',
		'uses' => 'CategoriesController@store'
	]);

	Route::get(LaravelLocalization::transRoute('categories.routes.index'), [
		'as' => 'categories.index',
		'uses' => 'CategoriesController@index'
	]);


	Route::get(LaravelLocalization::transRoute('categories.routes.show'), [
		'as' => 'categories.show',
		'uses' => 'CategoriesController@show'
	]);

	Route::get(LaravelLocalization::transRoute('categories.routes.edit'), [
		'as' => 'categories.edit',
		'uses' => 'CategoriesController@edit'
	]);

	Route::post(LaravelLocalization::transRoute('categories.routes.update'), [
		'as' => 'categories.update',
		'uses' => 'CategoriesController@update'
	]);

	Route::get(LaravelLocalization::transRoute('categories.routes.destroy'), [
		'as' => 'categories.destroy',
		'uses' => 'CategoriesController@destroy'
	]);

	Route::get(LaravelLocalization::transRoute('categories.routes.api.list'), ['as'=>'categories.api.list', 'uses'=>'CategoriesController@listApi']);

	Route::get('categories/api-show',  ['as' => 'categories.api.show','uses' => 'CategoriesController@showApi' ] );

	Route::post(LaravelLocalization::transRoute('categories.routes.api.update'), [
		'as' => 'categories.api.update',
		'uses' => 'CategoriesController@updateApi'
	]);

	Route::get(LaravelLocalization::transRoute('categories.routes.api.delete'),  
		['as' => 'categories.api.delete','uses' => 'CategoriesController@destroyApi' 
	]);

	Route::get('categories/api-show-lang',[ 'as' => 'categories.api.show-lang',
		'uses' => 'CategoriesController@showApiLang'
	]);

	Route::post(LaravelLocalization::transRoute('categories.routes.api.saveLang'), [
		'as' => 'categories.routes.api.saveLang',
		'uses' => 'CategoriesController@updateApiLang'
	]);

	//Route::get('returnDataCategoriesLang','CategoriesController@returnDataCategoriesLang');	

	Route::get('returnDataCategoriesLang', [
		'as' => 'categories.dataLang',
		'uses' => 'CategoriesController@returnDataCategoriesLang'
	]);

	/**
		* ------------------------------ Rutas atributos -----------------------
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
	Route::get(LaravelLocalization::transRoute('cart.routes.create'), [
		'as' => 'cart.create',
		'uses' => 'CartController@create'
	]);

	Route::get(LaravelLocalization::transRoute('cart.routes.change-quantity'), [
		'as' => 'cart.change-quantity',
		'uses' => 'CartController@changeQuantity'
	]);

	/**
		* ------------------------------ Rutas Lista de Deseos-----------------------
	**/
	Route::get(LaravelLocalization::transRoute('wishlist.routes.create'), [
		'as' => 'wishlist.create',
		'uses' => 'WishlistController@create'
	]);
	Route::get(LaravelLocalization::transRoute('wishlist.routes.api.index'), [
		'as' => 'wishlist.index',
		'uses' => 'WishlistController@index'
	]);
	Route::get(LaravelLocalization::transRoute('wishlist.routes.api.delete-ajax'), [
		'as' => 'wishlist.delete-ajax',
		'uses' => 'WishlistController@deleteAjax'
	]);

	/**
		* ------------------------------ Rutas Carrito de Compras-----------------------
	**/
	Route::get(LaravelLocalization::transRoute('cart.routes.show'), [
		'as' => 'cart.show',
		'uses' => 'CartController@show'
	]);
	Route::get(LaravelLocalization::transRoute('cart.routes.create'), [
		'as' => 'cart.create',
		'uses' => 'CartController@create'
	]);
	Route::get(LaravelLocalization::transRoute('cart.routes.api.index'), [
		'as' => 'cart.index',
		'uses' => 'CartController@index'
	]);
	Route::get(LaravelLocalization::transRoute('cart.routes.api.delete-ajax'), [
		'as' => 'cart.delete-ajax',
		'uses' => 'CartController@deleteAjax'
	]);

	/**
		* ------------------------------ Rutas Pagos -----------------------
	**/
	Route::get(LaravelLocalization::transRoute('payment.show'), [
		'as' => 'payment.show',
		'uses' => 'PaymentController@show'
	]);

	/**
		* ------------------------------ Rutas Detalles de credenciales de Pago -----------------------
	**/

	Route::get(LaravelLocalization::transRoute('PaymentCredentialDetails.routes.create'), [
		'as' => 'PaymentCredentialDetails.create',
		'uses' => 'PaymentCredentialDetailsController@create'
	]);

	Route::post(LaravelLocalization::transRoute('PaymentCredentialDetails.routes.store'), [
		'as' => 'PaymentCredentialDetails.store',
		'uses' => 'PaymentCredentialDetailsController@store'
	]);

	Route::get(LaravelLocalization::transRoute('PaymentCredentialDetails.routes.api.index'), [
		'as' => 'PaymentCredentialDetails.index',
		'uses' => 'PaymentCredentialDetailsController@index'
	]);


	Route::get(LaravelLocalization::transRoute('PaymentCredentialDetails.routes.show'), [
		'as' => 'PaymentCredentialDetails.show',
		'uses' => 'PaymentCredentialDetailsController@show'
	]);

	Route::get(LaravelLocalization::transRoute('PaymentCredentialDetails.routes.edit'), [
		'as' => 'PaymentCredentialDetails.edit',
		'uses' => 'PaymentCredentialDetailsController@edit'
	]);

	Route::post(LaravelLocalization::transRoute('PaymentCredentialDetails.routes.update'), [
		'as' => 'PaymentCredentialDetails.update',
		'uses' => 'PaymentCredentialDetailsController@update'
	]);

	Route::get(LaravelLocalization::transRoute('PaymentCredentialDetails.routes.api.delete-ajax'), [
		'as' => 'PaymentCredentialDetails.delete-ajax',
		'uses' => 'PaymentCredentialDetailsController@destroy'
	]);

	Route::get('api/paymentCredentialDetails', array('as'=>'api.paymentCredentialDetails', 'uses'=>'PaymentCredentialDetailsController@getAllInCurrentLangData'));

	Route::get(LaravelLocalization::transRoute('PaymentCredentialDetails.routes.api.getData'), [
		'as' => 'PaymentCredentialDetails.getData',
		'uses' => 'PaymentCredentialDetailsController@getData'
	]);

	/**
		* ------------------------------ Country Routes -----------------------
	**/

	Route::get(LaravelLocalization::transRoute('countries.routes.api.listForCurrentLang'), [
		'as' => 'countries.api.listForCurrentLang',
		'uses' => 'CountryController@getAllValues'
	]);

	Route::get(LaravelLocalization::transRoute('countries.routes.api.statesForCountry'), [
		'as' => 'countries.api.listStatesForCountry',
		'uses' => 'CountryController@getAllStatesValue'
	]);

	Route::get(LaravelLocalization::transRoute('states.routes.api.citiesForState'), [
		'as' => 'states.api.listCitiesForState',
		'uses' => 'StateController@getAllCitiesValue'
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
