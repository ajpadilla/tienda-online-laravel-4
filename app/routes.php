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
	Route::get(LaravelLocalization::transRoute('products.routes.create'), ['as' => 'products.create', 'uses' => 'ProductController@create'] );
	Route::post(LaravelLocalization::transRoute('products.routes.store'), ['as' => 'products.store', 'uses' => 'ProductController@store' ] );
	Route::get(LaravelLocalization::transRoute('products.routes.show'), ['as' => 'products.show', 'uses' => 'ProductController@show' ] );
	Route::get(LaravelLocalization::transRoute('products.routes.api.index'),  ['as' => 'products.index','uses' => 'ProductController@index' ] );
	Route::get(LaravelLocalization::transRoute('products.routes.edit'),  ['as' => 'products.edit','uses' => 'ProductController@edit' ] );
	Route::get(LaravelLocalization::transRoute('products.routes.api.delete-ajax'),  ['as' => 'products.delete-ajax','uses' => 'ProductController@deleteAjax' ] );
	Route::post(LaravelLocalization::transRoute('products.routes.update'),  ['as' => 'products.update','uses' => 'ProductController@update' ] );

	Route::post('product/delete/{id}' ,  ['as' => 'products.destroy','uses' => 'ProductController@destroy' ] );

	//Datatable Products
	Route::get('api/products', array('as'=>'api.products', 'uses'=>'ProductController@getAllProductsInCurrentLangData'));

	Route::get(LaravelLocalization::transRoute('products.routes.search'), [
		'as' => 'products.search',
		'uses' => 'ProductController@search'
	]);

	Route::get(LaravelLocalization::transRoute('products.routes.filterWord'), [
		'as' => 'products.filterWord',
		'uses' => 'ProductController@getCurrentFilterWorld'
	]);

	Route::get('/ajax/paginator','ProductController@searchPaginator');

	Route::get('returnDataProduct','ProductController@returnDataProduct');

	Route::get('returnDataProductLang','ProductController@returnDataProductLang');

	Route::post(LaravelLocalization::transRoute('products.routes.api.saveLang'), [
		'as' => 'products.saveLang',
		'uses' => 'ProductController@saveDataForLanguage'
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


	Route::get(LaravelLocalization::transRoute('discounts.routes.api.index'), [
		'as' => 'discounts.index',
		'uses' => 'DiscountController@index'
	]);


	Route::get(LaravelLocalization::transRoute('discounts.routes.show'), [
		'as' => 'discounts.show',
		'uses' => 'DiscountController@show'
	]);

	Route::get(LaravelLocalization::transRoute('discounts.routes.edit'), [
		'as' => 'discounts.edit',
		'uses' => 'DiscountController@edit'
	]);

	Route::post(LaravelLocalization::transRoute('discounts.routes.update'), [
		'as' => 'discounts.update',
		'uses' => 'DiscountController@update'
	]);

	Route::get(LaravelLocalization::transRoute('discounts.routes.destroy'), [
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
	Route::get(LaravelLocalization::transRoute('discountType.routes.create'), [
		'as' => 'discountType.create',
		'uses' => 'DiscountTypeController@create'
	]);

	Route::post(LaravelLocalization::transRoute('discountType.routes.store'), [
		'as' => 'discountType.store',
		'uses' => 'DiscountTypeController@store'
	]);

	Route::get(LaravelLocalization::transRoute('discountType.routes.api.index'), [
		'as' => 'discountType.index',
		'uses' => 'DiscountTypeController@index'
	]);


	Route::get(LaravelLocalization::transRoute('discountType.routes.show'), [
		'as' => 'discountType.show',
		'uses' => 'DiscountTypeController@show'
	]);

	Route::get(LaravelLocalization::transRoute('discountType.routes.edit'), [
		'as' => 'discountType.edit',
		'uses' => 'DiscountTypeController@edit'
	]);

	Route::post(LaravelLocalization::transRoute('discountType.routes.update'), [
		'as' => 'discountType.update',
		'uses' => 'DiscountTypeController@update'
	]);

	Route::get(LaravelLocalization::transRoute('discountType.routes.destroy'), [
		'as' => 'discountType.destroy',
		'uses' => 'DiscountTypeController@destroy'
	]);

	Route::post('checkName','DiscountTypeController@checkName');
	Route::post('checkNameForEditDiscountType','DiscountTypeController@checkNameForEdit');

	Route::get('api/discountType', array('as'=>'api.discountType', 'uses'=>'DiscountTypeController@getDatatable'));


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

	Route::get(LaravelLocalization::transRoute('shipmentStatus.routes.api.index'), [
		'as' => 'shipmentStatus.index',
		'uses' => 'ShipmentStatusController@index'
	]);

	Route::get(LaravelLocalization::transRoute('shipmentStatus.routes.edit'), [
		'as' => 'shipmentStatus.edit',
		'uses' => 'ShipmentStatusController@edit'
	]);

	Route::get(LaravelLocalization::transRoute('shipmentStatus.routes.show'), [
		'as' => 'shipmentStatus.show',
		'uses' => 'ShipmentStatusController@show'
	]);

	Route::post(LaravelLocalization::transRoute('shipmentStatus.routes.update'), [
		'as' => 'shipmentStatus.update',
		'uses' => 'ShipmentStatusController@update'
	]);

	Route::get(LaravelLocalization::transRoute('shipmentStatus.routes.destroy'), [
		'as' => 'shipmentStatus.destroy',
		'uses' => 'ShipmentStatusController@destroy'
	]);


	Route::get('api/shipmentStatus', array('as'=>'api.shipmentStatus', 'uses'=>'ShipmentStatusController@getDatatable'));

	Route::post('checkColorShipmentStatus','ShipmentStatusController@checkColorShipmentStatus');
	Route::post('checkNameShipmentStatus','ShipmentStatusController@checkNameShipmentStatus');
    Route::post('checkNameShipmentStatusEdit','ShipmentStatusController@checkNameForEdit');

   	Route::get('returnDatashipmentStatus','ShipmentStatusController@returnDataShipmentStatus');

	Route::get(LaravelLocalization::transRoute('shipmentStatus.routes.api.delete-ajax'),  ['as' => 'shipmentStatus.delete-ajax','uses' => 'ShipmentStatusController@deleteAjax' ] );


	Route::get('returnDataShipmentStatusLang','ShipmentStatusController@returnDataShipmentStatusLang');

	Route::post(LaravelLocalization::transRoute('shipmentStatus.routes.api.saveLang'), [
		'as' => 'shipmentStatus.saveLang',
		'uses' => 'ShipmentStatusController@saveDataForLanguage'
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

	Route::get(LaravelLocalization::transRoute('invoiceStatus.routes.api.index'), [
		'as' => 'invoiceStatus.index',
		'uses' => 'InvoiceStatusController@index'
	]);

	Route::get(LaravelLocalization::transRoute('invoiceStatus.routes.edit'), [
		'as' => 'invoiceStatus.edit',
		'uses' => 'InvoiceStatusController@edit'
	]);

	Route::get(LaravelLocalization::transRoute('invoiceStatus.routes.show'), [
		'as' => 'invoiceStatus.show',
		'uses' => 'InvoiceStatusController@show'
	]);

	Route::post(LaravelLocalization::transRoute('invoiceStatus.routes.update'), [
		'as' => 'invoiceStatus.update',
		'uses' => 'InvoiceStatusController@update'
	]);

	Route::get(LaravelLocalization::transRoute('invoiceStatus.routes.destroy'), [
		'as' => 'invoiceStatus.destroy',
		'uses' => 'InvoiceStatusController@destroy'
	]);


	Route::get('api/invoiceStatus', array('as'=>'api.invoiceStatus', 'uses'=>'InvoiceStatusController@getDatatable'));
	Route::post('checkNameInvoiceStatus','InvoiceStatusController@checkNameInvoiceStatus');
    Route::post('checkNameInvoiceStatusEdit','InvoiceStatusController@checkNameForEdit');



   	Route::get('returnDataInvoiceStatus','InvoiceStatusController@returnDataInvoiceStatus');

	Route::get(LaravelLocalization::transRoute('invoiceStatus.routes.api.delete-ajax'),  ['as' => 'invoiceStatus.delete-ajax','uses' => 'InvoiceStatusController@deleteAjax' ] );


	Route::get('returnDatainvoiceStatusLang','InvoiceStatusController@returnDatainvoiceStatusLang');

	Route::post(LaravelLocalization::transRoute('invoiceStatus.routes.api.saveLang'), [
		'as' => 'invoiceStatus.saveLang',
		'uses' => 'InvoiceStatusController@saveDataForLanguage'
	]);


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

	Route::get(LaravelLocalization::transRoute('classifiedTypes.routes.api.index'), [
		'as' => 'classifiedTypes.index',
		'uses' => 'ClassifiedTypeController@index'
	]);


	Route::get(LaravelLocalization::transRoute('classifiedTypes.routes.show'), [
		'as' => 'classifiedTypes.show',
		'uses' => 'ClassifiedTypeController@show'
	]);

	Route::get(LaravelLocalization::transRoute('classifiedTypes.routes.edit'), [
		'as' => 'classifiedTypes.edit',
		'uses' => 'ClassifiedTypeController@edit'
	]);

	Route::post(LaravelLocalization::transRoute('classifiedTypes.routes.update'), [
		'as' => 'classifiedTypes.update',
		'uses' => 'ClassifiedTypeController@update'
	]);

	Route::get(LaravelLocalization::transRoute('classifiedTypes.routes.destroy'), [
		'as' => 'classifiedTypes.destroy',
		'uses' => 'ClassifiedTypeController@destroy'
	]);

	Route::post('checkNameClassifiedType','ClassifiedTypeController@checkName');
    Route::post('checkNameClassifiedTypesEdit','ClassifiedTypeController@checkNameForEdit');


	Route::get('api/classifiedTypes', array('as'=>'api.classifiedTypes', 'uses'=>'ClassifiedTypeController@getDatatable'));

	Route::get(LaravelLocalization::transRoute('classifiedTypes.current-lang'), [
		'as' => 'classifiedTypes.current-lang',
		'uses' => 'ClassifiedTypeController@returnDataForLang'
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


	Route::get(LaravelLocalization::transRoute('classifiedConditions.routes.show'), [
		'as' => 'classifiedConditions.show',
		'uses' => 'ClassifiedConditionController@show'
	]);

	Route::get(LaravelLocalization::transRoute('classifiedConditions.routes.edit'), [
		'as' => 'classifiedConditions.edit',
		'uses' => 'ClassifiedConditionController@edit'
	]);

	Route::post(LaravelLocalization::transRoute('classifiedConditions.routes.update'), [
		'as' => 'classifiedConditions.update',
		'uses' => 'ClassifiedConditionController@update'
	]);

	Route::get(LaravelLocalization::transRoute('classifiedConditions.routes.destroy'), [
		'as' => 'classifiedConditions.destroy',
		'uses' => 'ClassifiedConditionController@destroy'
	]);

	Route::post('verificateNameClassifiedCondition','ClassifiedConditionController@checkNameClassifiedCondition');
	Route::post('checkNameClassifiedConditionEdit','ClassifiedConditionController@checkNameForEdit');


	Route::get('api/classifiedConditions', array('as'=>'api.classifiedConditions', 'uses'=>'ClassifiedConditionController@getDatatable'));

	Route::get(LaravelLocalization::transRoute('classifiedConditions.current-lang'), [
		'as' => 'classifiedConditions.current-lang',
		'uses' => 'ClassifiedConditionController@returnDataForLang'
	]);

	/**
		* ------------------------------ Rutas ProductConditions -----------------------
	**/


	Route::get(LaravelLocalization::transRoute('productCondition.current-lang'), [
		'as' => 'productCondition.current-lang',
		'uses' => 'ProductConditionController@returnDataForLang'
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

	Route::get(LaravelLocalization::transRoute('classifieds.routes.api.index'), [
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

	Route::post(LaravelLocalization::transRoute('classifieds.routes.update'), [
		'as' => 'classifieds.update',
		'uses' => 'ClassifiedController@update'
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

	Route::get(LaravelLocalization::transRoute('classifieds.countries'), [
		'as' => 'classifieds.countries',
		'uses' => 'ClassifiedController@countries'
	]);

	Route::get(LaravelLocalization::transRoute('classifieds.statesForCountry'), [
		'as' => 'classifieds.statesForCountry',
		'uses' => 'ClassifiedController@statesForCountry'
	]);

	Route::get(LaravelLocalization::transRoute('classifieds.citiesForState'), [
		'as' => 'classifieds.citiesForState',
		'uses' => 'ClassifiedController@citiesForState'
	]);

	Route::get('returnDataClassifiedLang','ClassifiedController@returnDataClassifiedLang');

	Route::post(LaravelLocalization::transRoute('classifieds.routes.api.saveLang'), [
		'as' => 'classifieds.saveLang',
		'uses' => 'ClassifiedController@saveCurrentLangAttribute'
	]);

	Route::get(LaravelLocalization::transRoute('classifieds.routes.api.delete-ajax'),  ['as' => 'classifieds.delete-ajax','uses' => 'ClassifiedController@deleteAjax' ] );

	Route::post('checkNameClassified','ClassifiedController@checkNameClassified');
	Route::post('checkNameClassifiedEdit','ClassifiedController@checkNameForEdit');

	Route::get('returnDataClassified','ClassifiedController@returnDataClassified');

	Route::get('api/classifieds', array('as'=>'api.classifieds', 'uses'=>'ClassifiedController@getDatatable'));


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

	Route::get(LaravelLocalization::transRoute('categories.routes.api.index'), [
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

	Route::get('api/categories', array('as'=>'api.categories', 'uses'=>'CategoriesController@getDatatable'));

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

	Route::get(LaravelLocalization::transRoute('PaymentCredentialDetails.routes.destroy'), [
		'as' => 'PaymentCredentialDetails.destroy',
		'uses' => 'PaymentCredentialDetailsController@destroy'
	]);

	Route::get('api/paymentCredentialDetails', array('as'=>'api.paymentCredentialDetails', 'uses'=>'PaymentCredentialDetailsController@getAllInCurrentLangData'));

	Route::get(LaravelLocalization::transRoute('PaymentCredentialDetails.routes.api.getData'), [
		'as' => 'PaymentCredentialDetails.getData',
		'uses' => 'PaymentCredentialDetailsController@getData'
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
