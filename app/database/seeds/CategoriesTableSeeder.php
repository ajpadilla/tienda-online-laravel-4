<?php

use s4h\store\Categories\Category;

class CategoriesTableSeeder extends Seeder {

		/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		for ($i = 0; $i < 8; $i++)
		{
			Category::create([
				'category_id' => rand(1, 8),
			]);
		}
	}

}
