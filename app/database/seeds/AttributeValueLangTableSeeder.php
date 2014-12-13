<?php 
 /**
 * 
 */
 class AttributeValueLangTableSeeder extends DatabaseSeeder
 {
 	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$date = new DateTime;

		$attribute_values_lang [] = array(
			'name' => 'Nuevo', 
			'attribute_value_id' =>1,
			'language_id' => 1,  
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')             
		);  

		$attribute_values_lang [] = array(
			'name' => 'New',
			'attribute_value_id' =>1,
			'language_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')    
		);  

		$attribute_values_lang [] = array(
			'name' => 'Rojo', 
			'attribute_value_id' =>3,
			'language_id' => 1,  
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')             
		);  

		$attribute_values_lang [] = array(
			'name' => 'Red',
			'attribute_value_id' =>3,
			'language_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')    
		);  

		$attribute_values_lang [] = array(
			'name' => 'ASUS', 
			'attribute_value_id' =>4,
			'language_id' => 1,  
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')             
		);  

		$attribute_values_lang [] = array(
			'name' => 'ASUS',
			'attribute_value_id' =>4,
			'language_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')    
		); 

		// Uncomment the below to run the seeder
		DB::table('attribute_values_lang')->insert($attribute_values_lang);
	}
 }