<?php 

use s4h\store\Conditions\Condition;
/**
* 
*/
class ProductConditionTableSeeder extends DatabaseSeeder{
	
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		for ($i = 0; $i < 4; $i++)
		{
			Condition::create([]);
		}
	}

}