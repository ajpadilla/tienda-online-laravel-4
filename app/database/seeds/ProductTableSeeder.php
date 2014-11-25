<?php 

use s4h\store\Products\Product;
use s4h\store\Conditions\Condition;
use s4h\store\Users\User;
use s4h\store\Measures\Measure;
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

		$productsConditions = Condition::all()->toArray();

		$users = User::all()->toArray();

		$measures = Measure::all()->toArray();

		for ($i=0; $i < 20; $i++) 
		{ 
			$productCondition = $faker->randomElement($productsConditions);
			$user = $faker->randomElement($users);
			$measur = $faker->randomElement($measures);
 
			Product::create([
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
				'measure_id' => $measur['id'],
				'user_id' => $user['id'],
			]);
		}

	}

}