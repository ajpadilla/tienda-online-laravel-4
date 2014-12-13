<?php 

use s4h\store\Attributes\Attribute;
use	s4h\store\Languages\Language;
use s4h\store\AttributesLang\AttributeLang;
/**
* 
*/
class AttributeLangTableSeeder extends DatabaseSeeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$date = new DateTime;

		$attributes_lang [] = array(
			'name' => 'Estado', 
			'attribute_id' =>1,
			'language_id' => 1,  
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')             
		);  

		$attributes_lang [] = array(
			'name' => 'State',
			'attribute_id' =>1,
			'language_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')    
		);  

		$attributes_lang [] = array(
			'name' => 'Color', 
			'attribute_id' =>3,
			'language_id' => 1,  
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')             
		);  

		$attributes_lang [] = array(
			'name' => 'Color',
			'attribute_id' =>3,
			'language_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')    
		);  

		$attributes_lang [] = array(
			'name' => 'Marca', 
			'attribute_id' =>4,
			'language_id' => 1,  
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')             
		);  

		$attributes_lang [] = array(
			'name' => 'Make',
			'attribute_id' =>4,
			'language_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')    
		); 

		// Uncomment the below to run the seeder
		DB::table('attributes_lang')->insert($attributes_lang);
	}
}