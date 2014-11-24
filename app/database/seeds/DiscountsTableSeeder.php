<?php 

use s4h\store\Discounts\Discount;
use s4h\store\DiscountsTypes\DiscountType;

/**
* 
*/
class DiscountsTableSeeder extends DatabaseSeeder{
	
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = $this->getFaker();

		$discountsTypes = DiscountType::all();

		foreach ($discountsTypes as $discountType) {
			Discount::create([
				'value' => $faker->randomFloat(17, 2, 100),
				'percent' =>  $faker->randomFloat(3, 2, 100),
				'quantity' => $faker->numberBetween(0, 100),
				'quantity_per_user' => $faker->numberBetween(0, 100),
				'code' => $faker->numerify('Code###'),
				'active' => $faker->numberBetween(0, 1),
				'from' => $faker->dateTimeThisYear($max = 'now'),
				'to' =>$faker->dateTimeThisYear($max = 'now'),
				'discount_type_id' => $discountType->id,
			]);
		}
	}

}