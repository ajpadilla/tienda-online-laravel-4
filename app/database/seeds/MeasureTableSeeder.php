<?php

use s4h\store\Measures\Measure;

class MeasureTableSeeder extends Seeder {

		/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		for ($i = 0; $i < 3; $i++)
		{
			Measure::create([]);
		}
	}

}