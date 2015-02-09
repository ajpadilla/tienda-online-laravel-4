<?php

use s4h\store\Carts\CartRepository;
use s4h\store\Categories\CategoryRepository;
use s4h\store\Products\ProductRepository;

class BaseController extends Controller {

	private $categoryRepository;
	private $productRepository;
	private $cartRepository;

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}

		$currentMenu = 'current';
		$currentUser = Auth::user();
		$currentRoute = Route::currentRouteName();
		/*		$products       =       new     ProductRepository();
				$randomProducts =       $products->getRandom(5);
				$topProducts    =       $products->getTop(5);
				$newProducts    =       $products->getNew(5);

				View::share(compact('currentUser', 'currentMenu', 'currentRoute', 'randomProducts', 'topProducts', 'newProducts'));*/
		$this->categoryRepository = new CategoryRepository();
		$this->productRepository = new ProductRepository();
		$this->cartRepository = new CartRepository();
		$wishlist = ($currentUser ? $this->productRepository->getWishlistForUser($currentUser) : NULL);
		$cart = ($currentUser ? $this->cartRepository->getActiveCartForUser($currentUser) : NULL);
		$categoriesMenu     = $this->categoryRepository->getNested($this->categoryRepository->getCategoriesWithoutParents());
		View::share(compact('categoriesMenu', 'wishlist', 'cart'));
	}

}
