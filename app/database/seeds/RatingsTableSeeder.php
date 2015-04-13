<?php

use s4h\store\Ratings\Rating;
use s4h\store\Users\User;
use s4h\store\Products\Product;

class RatingsTableSeeder extends DatabaseSeeder {

		/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
		public function run()
		{
			$faker = $this->getFaker();

			$users   = User::all()->toArray();

			$products = Product::all();

			foreach ($products as $product)
			{

				$used = [];
				for ($i = 0; $i < rand(1, 5); $i++)
				{

					$user = $faker->randomElement($users);

					if (!in_array($user["id"], $used))
					{
						$id = $user["id"];
						Rating::create([
							"points" => $faker->numberBetween(1, 5),
							"description" => $faker->text,
							"user_id"   => $id,
							"product_id" => $product->id,
							]);
						$used[] = $user["id"];
					}
				}
			}
		}

}
