<?php

use s4h\store\Carts\CartRepository;
use s4h\store\Categories\CategoryRepository;
use s4h\store\Products\ProductRepository;
use s4h\store\Wishlist\WishlistRepository;

class BaseController extends Controller {
	protected $categoryRepository;
	protected $productRepository;
	protected $cartRepository;
	protected $wishlistRepository;

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

		$currentSticker = '';
		$currentMenu = 'current';
		$currentUser = Auth::user();
		$currentRoute = Route::currentRouteName();
		$this->categoryRepository = new CategoryRepository();
		$this->productRepository = new ProductRepository();
		$this->cartRepository = new CartRepository();
		$this->wishlistRepository = new WishlistRepository();
		$wishlist = ($currentUser ? $this->wishlistRepository->getWishlistForUser($currentUser) : NULL);
		$cart = ($currentUser ? $this->cartRepository->getActiveCartForUser($currentUser) : NULL);
		$categoriesMenu     = $this->categoryRepository->getNested($this->categoryRepository->getCategoriesWithoutParents());
		View::share(compact('currentUser', 'currentStiker', 'categoriesMenu', 'wishlist', 'cart', 'currentRoute'));
	}

}
