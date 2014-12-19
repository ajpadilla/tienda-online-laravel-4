<?php

use s4h\store\ProductsLang\ProductLangRepository;

class PageController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	private $productLangRepository;

	public function home()
	{
		$this->productLangRepository = new ProductLangRepository();
		$newProducts = $this->productLangRepository->getNewProducts();
		return View::make('pages.home', compact('newProducts'));
	}

}
