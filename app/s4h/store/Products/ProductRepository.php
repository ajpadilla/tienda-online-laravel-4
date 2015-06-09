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


	function __construct() {
		$this->columns = [
			trans('products.list.photo'),
			trans('products.list.name'),
			trans('products.list.price'),
			trans('products.list.quantity'),
			trans('products.list.active'),
			trans('products.list.accept'),
			trans('products.list.category'),
			trans('products.labels.condition'),
			trans('products.list.ratings'),
			trans('products.list.actions')
		];
		$this->setModel(new Product);
		$this->setListAllRoute('products.routes.api.list');
	}

	protected $cartRepository;

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

	public function create($data = array())
	{
		
		$product = $this->model->create($data);

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

	public function update($data = array())
	{
		$product = $this->get($data['product_id']);
		$product->update($data);

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
		$product = $this->get($productId);
		$productLanguage = $product->InCurrentLang;
		$categories = $productLanguage->product->getCategorieIds();
		return[
			'productLang' => $productLanguage,
			'categories' => $categories,
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

	/*
	*********************** DATATABLE SETTINGS ******************************
	*/		

	public function setDefaultActionColumn() {
		$this->addColumnToCollection('Actions', function($model)
		{
			$language = $this->getCurrentLang();

			$this->cleanActionColumn();
			$this->addActionColumn("<form action='".route('products.show',$model->id)."' method='get'>
						<button href='#'  class='btn btn-success btn-outline dim col-sm-8 show' style='margin-left: 20px;' type='submit' data-toggle='tooltip' data-placement='top' title='".trans('products.actions.Show')."'  data-original-title='".trans('products.actions.Show')."' ><i class='fa fa-check fa-2x'></i></button><br/>
					  </form>");
			$this->addActionColumn("<button href='#fancybox-edit-product' id='edit_product_".$model->id."' class='edit-product btn btn-warning btn-outline dim col-sm-8' style='margin-left: 20px; ' type='button' data-toggle='tooltip' data-placement='top' title='".trans('products.actions.Edit')."'  data-original-title='".trans('products.actions.Edit')."' ><i class='fa fa-pencil fa-2x'></i>
					 </button><br/>");
			$this->addActionColumn("<button href='#' class='delete-product btn btn-danger btn-outline dim col-sm-8' id='delet_product_".$model->id."' style='margin-left: 20px' type='button' data-toggle='tooltip' data-placement='top' title='".trans('products.actions.Delete')."'  data-original-title='".trans('products.actions.Delete')."' ><i class='fa fa-times fa-2x'></i>
					 </button><br/>");
			if($model->active)
				$this->addActionColumn("<button href='#' class='btn btn-primary btn-outline dim col-sm-8 deactivated' style='margin-left: 20px' type='button' data-toggle='tooltip' data-placement='top' title='".trans('products.actions.Activate')."'  data-original-title='".trans('products.actions.Deactivated')."'> <i class='fa fa-check fa-2x'></i></button><br />");
			else
				$this->addActionColumn("<button href='#' class='btn btn-danger btn-outline dim col-sm-8 activate' style='margin-left: 20px' type='button' data-toggle='tooltip' data-placement='top' title='".trans('products.actions.Deactivated')."'  data-original-title='".trans('products.actions.Activate')."'> <i class='fa fa-check fa-2x'></i></button><br />");
			
			$this->addActionColumn("<form action='".route('photoProduct.create',array($model->id, $language->id))."' method='get'>
							<button href='#' class='btn btn-info btn-outline dim col-sm-8 photo' style='margin-left: 20px' type='submit' data-toggle='tooltip' data-placement='top' title='".trans('products.actions.Photo')."'  data-original-title='".trans('products.actions.Photo')."'> <i class='fa fa-camera fa-2x'></i></button><br />
					  </form>");
			$this->addActionColumn("<button href='#fancybox-edit-language-product' id='language_product_".$model->id."'  class='btn btn-success btn-outline dim col-sm-8 language' style='margin-left: 20px' type='button' data-toggle='tooltip' data-placement='top' title='".trans('products.actions.Language')."'  data-original-title='".trans('products.actions.Language')."'> <i class='fa fa-pencil fa-2x'></i></button><br />");
			return implode(" ", $this->getActionColumn());
		});
	}

	public function setBodyTableSettings()
	{
		$this->collection->searchColumns('name','price', 'quantity', 'active', 'accept_barter', 'category', 'ratings');
		$this->collection->orderColumns('name','price', 'quantity', 'active', 'accept_barter');

		$this->collection->addColumn('photo', function($model)
		{
			$links = '';
			$photo = $model->getFirstPhotoAttribute();

			if ($photo != false) {
				$links .= "	<a href='#'>
					<img class='mini-photo' alt='" . $photo->filename . "' src='" . asset($photo->complete_path) . "'>
				</a>";
			}
			return $links;
		});

		$this->collection->addColumn('name', function($model)
		{
			return $model->InCurrentLang->name;
		});

		$this->collection->addColumn('price', function($model)
		{
			return $model->price;
		});

		$this->collection->addColumn('quantity', function($model)
		{
			return $model->quantity;
		});

		$this->collection->addColumn('active', function($model)
		{
			return $model->ActivoShow;
		});

		$this->collection->addColumn('accept_barter', function($model)
		{
			return $model->AcceptBarterShow;
		});

		$this->collection->addColumn('category', function($model)
		{
			if($model->hasCategories())
			{
				$categoryNames = $model->getCategoryNames();
				$links = '<select class="form-control m-b">';
				foreach ($categoryNames as $category) {
					$links .= '<option>'.$category.'</option>';
				}
				$links .='</select>';
				return $links;
			}
			return '';			
		});

		$this->collection->addColumn('condition', function($model)
		{
			return $model->getConditionName();
		});

		$this->collection->addColumn('ratings', function($model)
		{
			if($model->hasRatings())
			{
				return $model->Rating;
			}
			return '';
		});
	}


}
