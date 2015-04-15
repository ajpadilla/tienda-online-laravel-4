<?php 

use s4h\store\PaymentsTypes\PaymentsTypes;
/**
* 
*/
class PaymentsTypesTableSeeder extends DatabaseSeeder{
	
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		for ($i = 0; $i < 8; $i++)
		{
			PaymentsTypes::create([]);
		}
	}

}