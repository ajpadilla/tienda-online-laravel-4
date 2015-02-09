<?php namespace s4h\store\Wishlist;

use s4h\store\Users\User;

/**
* 
*/
class WishlistRepository {

	public function getWishlistForUser(User $user)
	{
		return $user->wishlist;
	}
}