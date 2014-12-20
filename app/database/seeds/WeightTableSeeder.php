<?php 

use s4h\store\Weights\Weight;
/**
* 
*/
class WeightTableSeeder extends DatabaseSeeder{
	
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		for ($i = 0; $i < 3; $i++)
		{
			Weight::create([]);
		}
	}

}