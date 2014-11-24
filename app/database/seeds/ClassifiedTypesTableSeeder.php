<?php 

use s4h\store\ClassifiedTypes\ClassifiedType;
/**
* 
*/
class ClassifiedTypesTableSeeder extends DatabaseSeeder{
	
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		for ($i = 0; $i < 2; $i++)
		{
			ClassifiedType::create([]);
		}
	}

}