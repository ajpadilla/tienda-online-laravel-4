<?php 

use s4h\store\Products\Product;
use s4h\store\Conditions\Condition;
use s4h\store\Users\User;
use s4h\store\Measures\Measure;
use s4h\store\Weights\Weight;
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

		$weights = Weight::all()->toArray();

		for ($i=0; $i < 100; $i++) 
		{ 
			$productCondition = $faker->randomElement($productsConditions);
			$user = $faker->randomElement($users);
			$measur = $faker->randomElement($measures);
 			$weight = $faker->randomElement($weights);

			Product::create([
				'on_sale' => $faker->numberBetween(0,1),
				'quantity' => $faker->numberBetween(0, 100),
				'price' => $faker->randomFloat(20, 6, 100),
				'width' => $faker->randomFloat(2, 6, 100),
				'point_price' => $faker->randomFloat(20, 6, 100),
				'height' => $faker->randomFloat(2, 6, 100),
				'depth' => $faker->randomFloat(2, 6, 100),
				'weight' => $faker->randomFloat(2, 6, 100),
				'active' => $faker->numberBetween(0,1),
				'accept_barter' => $faker->numberBetween(0,1),
				'condition_id' => $productCondition['id'],
				'user_id' => $user['id'],
				'measure_id' => $measur['id'],
				'weight_id' => $weight['id']
			]);
		}

	}

}