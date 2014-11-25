<?php 

/**
* 
*/
class CategoriesLangTableSeeder extends DatabaseSeeder{
	
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$date = new DateTime;

		$categories_lang [] = array(
			'name' => 'Ventas', 
			'categories_id' =>1,
			'language_id' => 1,  
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')             
		);  

		$categories_lang [] = array(
			'name' => 'Sales',
			'categories_id' =>1,
			'language_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')    
		);  

		$categories_lang [] = array(
			'name' => 'Compras', 
			'categories_id' =>2,
			'language_id' => 1,  
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')             
		);  

		$categories_lang [] = array(
			'name' => 'Shopping',
			'categories_id' =>2,
			'language_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')    
		);  


		$categories_lang [] = array(
			'name' => 'Deportes', 
			'categories_id' =>3,
			'language_id' => 1,  
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')             
		);  

		$categories_lang [] = array(
			'name' => 'Sports',
			'categories_id' =>3,
			'language_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')    
		);  

		$categories_lang [] = array(
			'name' => 'Ropa', 
			'categories_id' =>4,
			'language_id' => 1,  
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')             
		);  

		$categories_lang [] = array(
			'name' => 'Clothes',
			'categories_id' =>4,
			'language_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')    
		);  


		$categories_lang [] = array(
			'name' => 'Juguetes', 
			'categories_id' =>5,
			'language_id' => 1,  
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')             
		);  

		$categories_lang [] = array(
			'name' => 'Toys',
			'categories_id' =>5,
			'language_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')    
		);  

		$categories_lang [] = array(
			'name' => 'Tecnología', 
			'categories_id' =>6,
			'language_id' => 1,  
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')             
		);  

		$categories_lang [] = array(
			'name' => 'Technology',
			'categories_id' =>6,
			'language_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')    
		);  


		$categories_lang [] = array(
			'name' => 'Celulares', 
			'categories_id' =>7,
			'language_id' => 1,  
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')             
		);  

		$categories_lang [] = array(
			'name' => 'Phones',
			'categories_id' =>7,
			'language_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')    
		);  

		$categories_lang [] = array(
			'name' => 'Atomoviles', 
			'categories_id' =>8,
			'language_id' => 1,  
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')             
		);  

		$categories_lang [] = array(
			'name' => 'Cars',
			'categories_id' =>8,
			'language_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')    
		);  

		// Uncomment the below to run the seeder
		DB::table('categories_lang')->insert($categories_lang);
	}

}