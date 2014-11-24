<?php 

use s4h\store\ClassifiedConditions\ClassifiedCondition;
/**
* 
*/
class ClassifiedConditionsTableSeeder extends DatabaseSeeder{
	
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		for ($i = 0; $i < 5; $i++)
		{
			ClassifiedCondition::create([]);
		}
	}

}