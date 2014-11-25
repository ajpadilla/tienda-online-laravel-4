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
		for ($i = 0; $i < 2; $i++)
		{
			Category::create([
				'category_id' => $i + 1 ,
			]);
		}
	}

}
