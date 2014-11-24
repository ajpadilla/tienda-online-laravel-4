<?php 

use s4h\store\ProductConditions\ProductCondition;
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
			ProductCondition::create([]);
		}
	}

}