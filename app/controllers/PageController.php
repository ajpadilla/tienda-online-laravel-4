<?php

use s4h\store\Products\ProductRepository;
use s4h\store\ClassifiedsLang\ClassifiedsLangRepository;

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

	protected $classifiedsLangRepository;

	function __construct(ProductRepository $productRepository, ClassifiedsLangRepository $classifiedsLangRepository)
	{
		$this->productRepository = $productRepository;
		$this->classifiedsLangRepository = $classifiedsLangRepository;
	}

	public function home()
	{
		$newProducts = $this->productRepository->getNewProducts();
		$newClassifieds = $this->classifiedsLangRepository->getNewClassifieds();
		return View::make('pages.home', compact('newProducts','newClassifieds'));
	}

}
