<?php namespace s4h\store\Products;


use s4h\store\Products\Product;

class ProductRepository {

	public function save(Product $product){
		return $product->save();
	}

}
