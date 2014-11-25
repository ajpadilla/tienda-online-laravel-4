<?php

use s4h\store\Ratings\Rating;

class RatingsTableSeeder extends Seeder {

		/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		for ($i = 0; $i < 3; $i++)
		{
			Rating::create([]);
		}
	}

}
