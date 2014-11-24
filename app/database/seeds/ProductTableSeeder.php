<?php 

use s4h\store\Products\Product;
use s4h\store\ProductConditions\ProductCondition;
use s4h\store\Users\User;

/**
* 
*/
class ProductTableSeeder extends DatabaseSeeder{
	
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = $this->getFaker();

		$productsConditions = ProductCondition::all()->toArray();

		$users = User::all()->toArray();

		for ($i=0; $i < 20; $i++) 
		{ 
			$productCondition = $faker->randomElement($productsConditions);
			$user = $faker->randomElement($users);

			Product::create([
				'name' => ucwords($faker->word),
				'description' =>  $faker->text,
				'on_sale' => $faker->numberBetween(0,1),
				'quantity' => $faker->numberBetween(0, 100),
				'price' => $faker->randomFloat(20, 6, 100),
				'width' => $faker->randomFloat(2, 6, 100),
				'height' => $faker->randomFloat(2, 6, 100),
				'depth' => $faker->randomFloat(2, 6, 100),
				'weight' => $faker->randomFloat(2, 6, 100),
				'active' => $faker->numberBetween(0,1),
				'available_for_order' => $faker->numberBetween(0,1),
				'show_price' => $faker->numberBetween(0,1),
				'accept_barter' => $faker->numberBetween(0,1),
				'product_for_barter' => $faker->numberBetween(0,1),
				'condition_id' => $productCondition['id'],
				'user_id' => $user['id'],
			]);
		}

	}

}