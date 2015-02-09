<?php namespace s4h\store\Carts;

use s4h\store\Users\User;

class CartRepository {
	public function getActiveCartForUser(User $user)
	{
		return Cart::whereUserId($user->id)->whereActive(TRUE)->orderBy('created_at', 'DESC')->first();
	}

	public function getProductQuantityForUser(User $user, $productId){
		return $this->getActiveCartForUser($user)->products()->whereProductId($productId)->first()->pivot->quantity;
	}
}
