<?php namespace s4h\store\Products;

use s4h\store\Carts\CartRepository;
use s4h\store\Users\User;
use s4h\store\Products\Product;
use s4h\store\Ratings\Rating;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use s4h\store\Languages\Language;
use s4h\store\ProductsLang\ProductLang;
use s4h\store\Base\BaseRepository;
use DB;
use Auth;

class ProductRepository extends BaseRepository{

	protected $cartRepository;

	public function getModel()
    {
      return new Product;
    }

    public $filters = ['filterWord','price','priceRange','pointsRange','firstValue','secondValue','categories','conditionsProducts',
    'cityId','operator','orderBy','countryId','stateId'];
	
	public function filterByPrice($query, $data = array()){
		$query->where('price',$data['operator'],$data['price']);
	}

    public function filterByPriceRange($query, $data = array()){
		$query->whereBetween('price',[(int)$data['firstValue'], (int)$data['secondValue']]);
	}

	public function filterByPointsRange($query, $data = array()){
		$query->whereBetween('point_price',[$data['firstValue'], $data['secondValue']]);
	}

	public function filterByConditionsProducts($query, $data = array()){
		if($data['conditionsProducts'] > 0)
			$query->where('condition_id','=',$data['conditionsProducts']);
	}
	public function filterByFilterWord($query, $data = array())
	{
		$language = $this->getCurrentLang();
		$query->whereHas('languages', function($q) use ($data, $language){
    		$q->where('language_id', '=', $language->id)
    		->where('products_lang.name', 'LIKE', '%' . $data['filterWord'] . '%');
    		/*->orWhere('products_lang.description', 'LIKE', '%' . $data['filterWord'] . '%')
    		->where('language_id', '=', $language->id);*/
		});
	}

	public function filterByCategories($query, $data = array())
	{
		$query->whereHas('categories', function($q) use ($data){
    		$q->whereIn('product_classification.category_id', $data['categories']);
		});
	}


	public function filterByCountryId($query, $data = array()){
		if($data['countryId'] > 0)
			$query->join('users as userC','products.user_id','=','userC.id')
			->join('people as peopleC','userC.id','=','peopleC.user_id')
			->join('address as addressC','peopleC.address_id','=','addressC.id')
			->join('cities as citiesC','addressC.city_id','=','citiesC.id')
			->join('states', 'citiesC.states_id', '=', 'states.id')
			->join('countries', 'states.country_id', '=', 'countries.id')
			->where('countries.id','=',$data['countryId'])
			->select('products.*');
	}


	public function filterByStateId($query, $data = array()){
		if($data['countryId'] > 0)
			$query->join('users as u','products.user_id','=','u.id')
			->join('people as pS','u.id','=','pS.user_id')
			->join('address as dir','pS.address_id','=','dir.id')
			->join('cities as citiesS','dir.city_id','=','citiesS.id')
			->join('states as statesS', 'citiesS.states_id', '=', 'statesS.id')
			->where('statesS.id','=',$data['stateId'])
			->select('products.*');
	}

	public function filterByCityId($query, $data = array()){
		if( $data['cityId'] > 0)
			$query->join('users','products.user_id','=','users.id')
			->join('people','users.id','=','people.user_id')
			->join('address','people.address_id','=','address.id')
			->join('cities as citiesCi','address.city_id','=','citiesCi.id')
			->where('citiesCi.id','=',$data['cityId'])
			->select('products.*');
	}

	public function orderByName($query, $order)
	{
		$language = $this->getCurrentLang();
		$ids = $query->lists('id');
		$language = $this->getCurrentLang();
		$query->join('products_lang as lang','lang.product_id','=','products.id')
		->where('lang.language_id','=',$language->id)
		->whereIn('products.id',$ids)
		->orderBy('lang.name', $order)
		->select('products.*');
	}

	public function orderByPrice($query, $order){
		$query->orderBy('price',$order);
	}

	public function orderByRating($query, $order){
		$query->select(DB::raw('products.*, IFNULL(AVG(points), 0) as rating'))
		->join('ratings', 'ratings.product_id','=','products.id')
		->groupBy('product_id')
		->orderBy('rating', $order);
	}

	public function orderByCondition($query, $order){
		$language = $this->getCurrentLang();
		$ids = $query->lists('id');
		$query->join('products_lang as lang','lang.product_id','=','products.id')
		->join('product_conditions as condition', 'condition.id','=','products.condition_id')
		->join('product_condition_lang as lang_condition','lang_condition.product_condition_id','=','condition.id')
		->where('lang.language_id','=',$language->id)
		->whereIn('products.id',$ids)
		->orderBy('lang_condition.name', $order)
		->select('products.*');
	}

	public function getAllInCurrentLangData()
	{
		$language = $this->getCurrentLang();
		return ProductLang::whereLanguageId($language->id)->get();
	}

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
		$product = $this->getById($id);
		if ($product)
			$product->delete();
	}

	public function getNewProducts($quantity = 4)
	{
		return Product::orderBy('created_at', 'DESC')->take($quantity)->get();
	}

	public function getTopProducts($quantity = 4)
	{
		/*
		SELECT p.id, sum(r.points) / count(p.id) AS avg FROM products p 
		JOIN ratings r ON (p.id=r.product_id)
		group by p.id
		order by AVG DESC, r.updated_at DESC
		*/
		return Product::join('ratings', 'products.id', '=', 'ratings.product_id')
			->select(['products.*', DB::raw('SUM(ratings.points)/COUNT(products.id) AS AVG')])
			->groupBy('products.id')
			->orderBy('AVG', 'DESC')
			->orderBy('ratings.updated_at', 'DESC')
			->take($quantity)
			->get();
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
		$product = $this->getById($data['product_id']);
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
		$product = $this->getById($data['product_id']);

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

	public function getById($productId)
	{
		return Product::findOrFail($productId);
	}


	public function getArray($productId)
	{
  		return $this->getById($productId)->toArray();
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

	public function getArrayInCurrentLangData($productId)
	{
		$product = $this->getById($productId);
		$productLanguage = $product->getInCurrentLangAttribute();
		$categories = $productLanguage->product->getCategorieIds();
		return[
			'success' => true, 
			'product' => $productLanguage->toArray(),
			'categories' => $categories,
			'url'=> route('products.update',$productId)
		];
	}

	public function getDataForLanguage($productId, $languageId)
	{
		$productLang = ProductLang::whereProductId($productId)->whereLanguageId($languageId)->first();
		if(count($productLang) > 0){
			return [
				'success' => true, 
				'productLang' => $productLang->toArray()
			];
		}else{
			return ['success' => false];
		}
	}

	public function saveRating($productId, $points, $description)
	{
		$product = Product::find($productId);

		if(!$product) 
			return FALSE;

		if(($rating = Rating::whereProductId($productId)->whereUserId(Auth::user()->id)->first())) {
			$rating->points = $points;	
			$rating->description = $description;		
		} else {
			$rating = new Rating;
			$rating->points = $points;
			$rating->description = $description;
			$rating->user()->associate(Auth::user());
			$rating->product()->associate($product);
		}
		return $rating->save();
	}

}
