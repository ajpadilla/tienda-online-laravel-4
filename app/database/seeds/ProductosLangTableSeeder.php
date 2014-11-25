<?php 

use	s4h\store\Languages\Language;
use s4h\store\Products\Product;
use s4h\store\ProductsLang\ProductLang;
/**
* 
*/
class ProductosLangTableSeeder extends DatabaseSeeder{
	
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = $this->getFaker();
		
		$products = Product::all();
		$languages = Language::all();

		foreach ($products as $product) 
		{
			foreach ($languages as $language)
			{
				ProductLang::create([
					'name' => ucwords($faker->word),
					'description' => $faker->text,
					'product_id' => $product->id,
					'language_id' =>$language->id,
				]);
			}
		}
	}

}