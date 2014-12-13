<?php 

 use s4h\store\AttributeTypes\AttributeType;

/**
* 
*/
class AttributeTypeTableSeeder extends DatabaseSeeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		for ($i=0; $i < 5 ; $i++) { 
			AttributeType::create([]);
		}
	}
}