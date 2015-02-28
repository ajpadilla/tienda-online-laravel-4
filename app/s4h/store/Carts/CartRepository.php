<?php namespace s4h\store\Carts;

use s4h\store\Currencies\Currency;
use s4h\store\Users\User;

class CartRepository {
	public static function getActiveCartForUser(User $user)
	{
		return Cart::whereUserId($user->id)->whereActive(TRUE)->orderBy('created_at', 'DESC')->first();
	}

	public static function getCart($id) {
		return Cart::findOrFail($id);
	}

	public static function createNewCartForUser(User $user)
	{
		$cart = new Cart();
		$cart->active = TRUE;
		//$cart->currency()->associate($currency);
		$cart->user()->associate($user);
		$cart->save();
		return $cart;
	}

	public function getProductQuantityForUser(User $user, $productId){
		return $this->getActiveCartForUser($user)->products()->whereProductId($productId)->first()->pivot->quantity;
	}

	public function changeQuantity(User $user, $productId, $quantity = 0)
	{
		$cart = $this->getActiveCartForUser($user);
		$product = $cart->products()->whereProductId($productId)->first();
		$product->pivot->quantity = $quantity;
		return $product->pivot->save();
	}
}
