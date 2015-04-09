<?php

use s4h\store\Products\ProductRepository;
use s4h\store\Classifieds\ClassifiedRepository;

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

	protected $classifiedRepository;

	function __construct(ProductRepository $productRepository, ClassifiedRepository $classifiedRepository)
	{
		$this->productRepository = $productRepository;
		$this->classifiedRepository = $classifiedRepository;
	}

	public function home()
	{
		$newProducts = $this->productRepository->getNewProducts();
		$topProducts = $this->productRepository->getTopProducts();
		$newClassifieds = $this->classifiedRepository->getNewClassifieds();
		//$topClassifieds = $this->classifiedRepository->getTopClassifieds();
		return View::make('pages.home', compact('newProducts', 'topProducts','newClassifieds'));
	}

}
