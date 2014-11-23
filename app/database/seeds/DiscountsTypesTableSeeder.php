<?php 

use s4h\store\DiscountsTypes\DiscountType;
/**
* 
*/
class DiscountsTypesTableSeeder extends DatabaseSeeder{
	
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		for ($i = 0; $i < 5; $i++)
		{
			DiscountType::create([]);
		}
	}

}