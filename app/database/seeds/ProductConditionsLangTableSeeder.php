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
			'name' => 'En espera', 
			'product_condition_id' =>1,
			'language_id' => 1,  
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')             
		);  

		$product_condition_lang [] = array(
			'name' => 'On hold',
			'product_condition_id' =>1,
			'language_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')    
		);  

		$product_condition_lang [] = array(
			'name' => 'Enviado', 
			'product_condition_id' =>2,
			'language_id' => 1,  
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')             
		);  

		$product_condition_lang [] = array(
			'name' => 'dispatched',
			'product_condition_id' =>2,
			'language_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')    
		);  

		$product_condition_lang [] = array(
			'name' => 'En almacén', 
			'product_condition_id' =>3,
			'language_id' => 1,  
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')             
		);  

		$product_condition_lang [] = array(
			'name' => 'In stock',
			'product_condition_id' =>3,
			'language_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')    
		);  

		$product_condition_lang [] = array(
			'name' => 'Agotado', 
			'product_condition_id' =>4,
			'language_id' => 1,  
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')             
		);  

		$product_condition_lang [] = array(
			'name' => 'Spent',
			'product_condition_id' =>4,
			'language_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')    
		);  

		// Uncomment the below to run the seeder
		DB::table('product_condition_lang')->insert($product_condition_lang);
	}
}

