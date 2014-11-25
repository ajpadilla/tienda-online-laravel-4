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
		$product = $this->getProductId($id);
		$product->delete();
		ProductLang::where('product_id','=',$id)->delete();
	}

	public function createNewProduct($data = array())
	{
		$product = new Product;
		$product->on_sale = $data['on_sale'];
		$product->quantity = $data['quantity'];
		$product->price = $data['price'];
		$product->measure_id = $data['measure_id'];
		$product->width = $data['width'];
		$product->height = $data['height'];
		$product->depth = $data['depth'];
		$product->weight = $data['weight'];
		$product->active = $data['active'];
		$product->available_for_order = $data['available_for_order'];
		$product->show_price = $data['show_price'];
		$product->accept_barter = $data['accept_barter'];
		$product->product_for_barter = $data['product_for_barter'];
		$product->condition_id = $data['condition_id'];


		/*$user = Auth::user();
		$product->associate($user);*/

		$product->save();

		$product->languages()->attach($data['language_id'], array('name'=> $data['name'],
			'description' => $data['description'])
		);

		if (!is_null($data['categories']))
			$product->categories()->sync($data['categories']);

	}

	public function updateProduct($data = array())
	{
		$product = $this->getProductId($data['product_id']);
		$product->on_sale = $data['on_sale'];
		$product->quantity = $data['quantity'];
		$product->measure_id = $data['measure_id'];
		$product->price = $data['price'];
		$product->width = $data['width'];
		$product->height = $data['height'];
		$product->depth = $data['depth'];
		$product->weight = $data['weight'];
		$product->active = $data['active'];
		$product->available_for_order = $data['available_for_order'];
		$product->show_price = $data['show_price'];
		$product->accept_barter = $data['accept_barter'];
		$product->product_for_barter = $data['product_for_barter'];
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
	}

	public function getProductId($product_id)
	{
		return Product::find($product_id);
	}


}
