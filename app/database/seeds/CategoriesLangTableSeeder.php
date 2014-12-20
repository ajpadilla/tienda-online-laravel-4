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
		//Deportes
		$categories_lang [] = array(
			'name' => 'Deportes', 
			'categories_id' => 1,
			'language_id' => 1,  
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')             
		);  

		$categories_lang [] = array(
			'name' => 'Sports',
			'categories_id' => 1,
			'language_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')    
		);  

		$categories_lang [] = array(
			'name' => 'Fútbol', 
			'categories_id' => 2,
			'language_id' => 1,  
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')             
		);  

		$categories_lang [] = array(
			'name' => 'Football',
			'categories_id' => 2,
			'language_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')    
		);  


		$categories_lang [] = array(
			'name' => 'Beisbol', 
			'categories_id' =>3,
			'language_id' => 1,  
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')             
		);  

		$categories_lang [] = array(
			'name' => 'Baseball',
			'categories_id' =>3,
			'language_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')    
		);  

		$categories_lang [] = array(
			'name' => 'Basketbol', 
			'categories_id' =>4,
			'language_id' => 1,  
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')             
		);  

		$categories_lang [] = array(
			'name' => 'Basketball',
			'categories_id' => 4,
			'language_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')    
		);  

		// Ropa
		$categories_lang [] = array(
			'name' => 'Ropa ', 
			'categories_id' => 5,
			'language_id' => 1,  
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')             
		);  

		$categories_lang [] = array(
			'name' => 'Clothing',
			'categories_id' => 5,
			'language_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')    
		);  

		$categories_lang [] = array(
			'name' => 'Masculina', 
			'categories_id' => 6,
			'language_id' => 1,  
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')             
		);  

		$categories_lang [] = array(
			'name' => 'Men',
			'categories_id' => 6,
			'language_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')    
		);  


		$categories_lang [] = array(
			'name' => 'Femenina', 
			'categories_id' => 7,
			'language_id' => 1,  
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')             
		);  

		$categories_lang [] = array(
			'name' => 'Women',
			'categories_id' => 7,
			'language_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')    
		);  

		//Tecnología
		$categories_lang [] = array(
			'name' => 'Tecnología', 
			'categories_id' => 8,
			'language_id' => 1,  
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')             
		);  

		$categories_lang [] = array(
			'name' => 'Technology',
			'categories_id' => 8,
			'language_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')    
		);  


		$categories_lang [] = array(
			'name' => 'Smarphones y Teléfonos Celulares', 
			'categories_id' => 9,
			'language_id' => 1,  
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')             
		);  

		$categories_lang [] = array(
			'name' => 'Smartphones and Cell Phones',
			'categories_id' => 9,
			'language_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')    
		);  


		$categories_lang [] = array(
			'name' => 'Computación', 
			'categories_id' => 10,
			'language_id' => 1,  
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')             
		);  

		$categories_lang [] = array(
			'name' => 'Computing',
			'categories_id' => 10,
			'language_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')    
		);  

		$categories_lang [] = array(
			'name' => 'Tabletas', 
			'categories_id' => 11,
			'language_id' => 1,  
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')             
		);  

		$categories_lang [] = array(
			'name' => 'Tablets',
			'categories_id' => 11,
			'language_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')    
		);  

		// Uncomment the below to run the seeder
		DB::table('categories_lang')->insert($categories_lang);
	}

}