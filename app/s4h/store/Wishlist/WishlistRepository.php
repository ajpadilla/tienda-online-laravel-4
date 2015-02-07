<?php namespace s4h\store\Wishlist;

use s4h\store\Products\Product;
use s4h\store\Users\User;

/**
* 
*/
class WishlistRepository {

	public function addToUserWishList($productId, User $user){
		$product = Product::findOrFail($productId);
		$product->userWishlist()->attach($user->id);
	}

}