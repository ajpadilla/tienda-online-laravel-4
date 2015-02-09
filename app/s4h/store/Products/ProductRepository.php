<?php namespace s4h\store\Products;

use s4h\store\Carts\CartRepository;
use s4h\store\Users\User;
use s4h\store\Products\Product;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use s4h\store\Languages\Language;
use s4h\store\ProductsLang\ProductLang;

class ProductRepository {

	protected $cartRepository;

	public function save(Product $product)
	{
		return $product->save();
	}

	public function getAll()
	{
		return Product::all();
	}

	public function deleteProduct($id)
	{
		$product = $this->getForId($id);
		if ($product)
			$product->delete();
	}

	public function getNewProducts($quantity = 4)
	{
		return Product::orderBy('created_at', 'DESC')->take($quantity)->get();
	}

	public function createNewProduct($data = array())
	{
		$product = new Product;
		$product->on_sale = $data['on_sale'];
		$product->quantity = $data['quantity'];
		$product->price = $data['price'];
		$product->point_price = $data['point_price'];
		$product->width = $data['width'];
		$product->height = $data['height'];
		$product->depth = $data['depth'];
		$product->weight = $data['weight'];
		$product->active = $data['active'];
		$product->color = $data['color'];
		$product->measure_id = $data['measure_id'];
		$product->weight_id = $data['weight_id'];
		$product->accept_barter = $data['accept_barter'];
		$product->condition_id = $data['condition_id'];


		/*$user = Auth::user();
		$product->associate($user);*/

		$product->save();

		$product->languages()->attach($data['language_id'],
			array(
				'name'=> $data['name'],
				'description' => $data['description']
			)
		);

		if (!is_null($data['categories']))
			$product->categories()->sync($data['categories']);

		return $product;
	}

	public function updateProduct($data = array())
	{
		$product = $this->getForId($data['product_id']);
		$product->on_sale = $data['on_sale'];
		$product->quantity = $data['quantity'];
		$product->price = $data['price'];
		$product->point_price = $data['point_price'];
		$product->width = $data['width'];
		$product->height = $data['height'];
		$product->depth = $data['depth'];
		$product->weight = $data['weight'];
		$product->active = $data['active'];
		$product->color = $data['color'];
		$product->measure_id = $data['measure_id'];
		$product->weight_id = $data['weight_id'];
		$product->accept_barter = $data['accept_barter'];
		$product->condition_id = $data['condition_id'];
		$product->save();

		if (isset($data['categories'])){
			$product->categories()->sync($data['categories']);
		}else{
			$product->categories()->detach();
		}

		if (count($product->languages()->whereIn('language_id',array($data['language_id']))->get()) > 0) {
			$product->languages()->updateExistingPivot($data['language_id'], array('name'=> $data['name'],
				'description' => $data['description'])
			);
		}else{
			$product->languages()->attach($data['language_id'], array('name'=> $data['name'],
				'description' => $data['description'])
			);
		}

		return $product;
	}

	public function updateDataForProduct($data = array())
	{
		$product = $this->getForId($data['product_id']);

		if (count($product->languages()->whereIn('language_id',array($data['language_id']))->get()) > 0) {
			$product->languages()->updateExistingPivot($data['language_id'], array('name'=> $data['name'],
				'description' => $data['description'])
			);
		}else{
			$product->languages()->attach($data['language_id'], array('name'=> $data['name'],
				'description' => $data['description'])
			);
		}
	}

	public function getById($product_id)
	{
		return Product::findOrFail($product_id);
	}


	public function getArray($productId)
	{
  		return $this->getById($productId)->toArray();
	}

	public function getForId($productId)
	{
		return Product::findOrFail($productId);
	}

	public function filterProducts($filterWord, $language_id) {
		$query = ProductLang::select();
		if (!empty($filterWord)) {
			$query->where('language_id', '=', $language_id)->where('name', 'LIKE', '%' . $filterWord . '%')->orWhere('description', 'LIKE', '%' . $filterWord . '%');
		}
		return $query->get();
	}

	/**
		* ------------------------------ Métodos para controlar la lista de deseos -----------------------
	**/

	public function getArrayForTopWishlist($productId)
	{
		$product = $this->getById($productId);
		return [
			'name' => $product->name,
			'url' => route('products.show', $productId),
			'url-delete' => route('wishlist.delete-ajax', $productId)
		];
	}

	public function deleteFromUserWishlist($productId, User $user)
	{
		if ($this->existsInUserWishlist($productId, $user))
			return $user->wishlist()->detach($productId) > 0;
		return FALSE;
	}

	public function addToUserWishlist($productId, User $user)
	{
		if ($this->existsInUserWishlist($productId, $user))
			return FALSE;
		return Product::findOrFail($productId)->wishlist()->attach($user->id) == NULL;
	}

	public function existsInUserWishlist($productId, User $user)
	{
		return Product::where('id', '=', $productId)->whereHas('wishlist', function($q) use ($user)
		{
    		$q->where('user_id', '=', $user->id);

		})->count();
	}
	/**
		* ------------------------------ Métodos para controlar el carro de compras -----------------------
	**/

	public function getArrayForTopCart(User $user, $productId)
	{
		$product = $this->getById($productId);
		$this->cartRepository = new CartRepository();
		return [
			'name' => $product->name,
			'quantity' => $this->cartRepository->getProductQuantityForUser($user, $productId),
			'url' => route('products.show', $productId),
			'url-delete' => route('cart.delete-ajax', $productId)
		];
	}

	public function deleteFromUserCart($productId, User $user)
	{
		if ($this->existsInUserCart($productId, $user)) {
			$cart = CartRepository::getActiveCartForUser($user);
			return $cart->products()->detach($productId) > 0;
		}
		return FALSE;
	}

	public function addToUserCart($productId, $quantity, User $user)
	{
		if ($this->existsInUserCart($productId, $user))
			return FALSE;
		$cart = CartRepository::getActiveCartForUser($user);
		Product::findOrFail($productId);
		return $cart->products()->attach([$productId => ['quantity' => $quantity]]) == NULL;
	}

	public function existsInUserCart($productId, User $user)
	{
		return Product::where('id', '=', $productId)->whereHas('carts', function($q) use ($user)
		{
    		$q
			    ->where('user_id', '=', $user->id)
			    ->where('active', '=', TRUE);

		})->count();
	}
}
