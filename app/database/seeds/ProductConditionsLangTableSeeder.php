<?php 

class ProductConditionsLangTableSeeder extends DatabaseSeeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
		public function run()
	{
		$date = new DateTime;

		$product_condition_lang [] = array(
			'name' => 'Nuevo', 
			'product_condition_id' =>1,
			'language_id' => 1,  
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')             
		);  

		$product_condition_lang [] = array(
			'name' => 'New',
			'product_condition_id' =>1,
			'language_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')    
		);  

		$product_condition_lang [] = array(
			'name' => 'Usado', 
			'product_condition_id' =>2,
			'language_id' => 1,  
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')             
		);  

		$product_condition_lang [] = array(
			'name' => 'Used',
			'product_condition_id' =>2,
			'language_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')    
		);  

		$product_condition_lang [] = array(
			'name' => 'Regresado al fabricante', 
			'product_condition_id' =>3,
			'language_id' => 1,  
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')             
		);  

		$product_condition_lang [] = array(
			'name' => 'Returned to the manufacturer',
			'product_condition_id' =>3,
			'language_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')    
		);  

		$product_condition_lang [] = array(
			'name' => 'Para repuesto', 
			'product_condition_id' =>4,
			'language_id' => 1,  
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')             
		);  

		$product_condition_lang [] = array(
			'name' => 'To spare',
			'product_condition_id' =>4,
			'language_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')    
		);  

		// Uncomment the below to run the seeder
		DB::table('product_condition_lang')->insert($product_condition_lang);
	}
}

