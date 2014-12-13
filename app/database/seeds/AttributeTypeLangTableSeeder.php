<?php 
 
 /**
 * 
 */
 class  AttributeTypeLangTableSeeder extends DatabaseSeeder
 {
 	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$date = new DateTime;

		$attribute_types_lang [] = array(
			'name' => 'Tipo1', 
			'attribute_type_id' =>1,
			'language_id' => 1,  
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')             
		);  

		$attribute_types_lang [] = array(
			'name' => 'Type1',
			'attribute_type_id' =>1,
			'language_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')    
		);  

		$attribute_types_lang [] = array(
			'name' => 'Tipo2', 
			'attribute_type_id' =>2,
			'language_id' => 1,  
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')             
		);  

		$attribute_types_lang [] = array(
			'name' => 'Type2',
			'attribute_type_id' =>2,
			'language_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')    
		);  

		$attribute_types_lang [] = array(
			'name' => 'tipo3', 
			'attribute_type_id' =>3,
			'language_id' => 1,  
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')             
		);  

		$attribute_types_lang [] = array(
			'name' => 'Type3',
			'attribute_type_id' =>3,
			'language_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')    
		);  

		$attribute_types_lang [] = array(
			'name' => 'Tipo4', 
			'attribute_type_id' =>4,
			'language_id' => 1,  
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')             
		);  

		$attribute_types_lang [] = array(
			'name' => 'Type4',
			'attribute_type_id' =>4,
			'language_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')    
		); 

		$attribute_types_lang [] = array(
			'name' => 'Tipo5', 
			'attribute_type_id' =>5,
			'language_id' => 1,  
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')             
		);  

		$attribute_types_lang [] = array(
			'name' => 'Type5',
			'attribute_type_id' =>5,
			'language_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')    
		);  
		// Uncomment the below to run the seeder
		DB::table('attribute_types_lang')->insert($attribute_types_lang);
	}
 }