<?php 
 
use s4h\store\Products\Product;
use s4h\store\Attributes\Attribute;
use s4h\store\AttributesByProducts\AttributeByProduct;
/**
* 
*/
class AttributeByProductTableSeeder extends DatabaseSeeder
{
	/**
   * Run the database seeds.
   *
   * @return void
  */
	public function run()
	{
		 $faker = $this->getFaker();

		 $products = Product::all();

		 $attributes = Attribute::all();

		 foreach ($products as $product) {
		 	foreach ($attributes as $attribute) {
		 		AttributeByProduct::create([
		 			"attribute_id" => $attribute->id,
		 			"product_id" => $product->id
		 		]);
		 	}
		 }
	}
}