<?php namespace s4h\store\Products;

	
use s4h\store\Products\Product;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use s4h\store\Languages\Language;

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
		$product = Product::find($id);

		$product->delete();

	}

}
