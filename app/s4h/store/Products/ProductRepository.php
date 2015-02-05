<?php namespace s4h\store\Products;


use s4h\store\Products\Product;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use s4h\store\Languages\Language;
use s4h\store\ProductsLang\ProductLang;

class ProductRepository {

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
		$product->delete();
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

	public function getById($product_id)
	{
  		$isoCode = LaravelLocalization::setLocale();
  		$language = Language::select()->where('iso_code','=',$isoCode)->first();
		$product = Product::findOrFail($product_id);
		return ProductLang::with('product')->whereProductId($product->id)->whereLanguageId($language->id)->first();
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
}
