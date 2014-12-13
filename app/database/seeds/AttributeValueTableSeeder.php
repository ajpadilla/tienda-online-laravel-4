<?php 

use s4h\store\AttributesValues\AttributeValue;

/**
* 
*/
class AttributeValueTableSeeder extends DatabaseSeeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		for ($i=0; $i <3 ; $i++) { 
			AttributeValue::create([]);
		}
	}
}