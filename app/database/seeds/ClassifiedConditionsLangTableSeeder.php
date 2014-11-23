<?php 

/**
* 
*/
class ClassifiedConditionsLangTableSeeder extends DatabaseSeeder{
	
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$date = new DateTime;

		$classified_conditions_lang [] = array(
			'name' => 'Amueblado', 
			'classified_types_id' =>1,
			'language_id' => 1,  
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')             
		);  

		$classified_conditions_lang [] = array(
			'name' => 'Furnished',
			'classified_types_id' =>1,
			'language_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')    
		);  

		$classified_conditions_lang [] = array(
			'name' => 'No amueblado', 
			'classified_types_id' =>2,
			'language_id' => 1,  
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')             
		);  

		$classified_conditions_lang [] = array(
			'name' => 'Not Furnished',
			'classified_types_id' =>2,
			'language_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')    
		);  

		$classified_conditions_lang [] = array(
			'name' => 'No mascotas', 
			'classified_types_id' =>3,
			'language_id' => 1,  
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')             
		);  

		$classified_conditions_lang [] = array(
			'name' => 'No pets',
			'classified_types_id' =>3,
			'language_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')    
		);  

		$classified_conditions_lang [] = array(
			'name' => 'Servicio de Internet', 
			'classified_types_id' =>4,
			'language_id' => 1,  
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')             
		);  

		$classified_conditions_lang [] = array(
			'name' => 'Internet Service',
			'classified_types_id' =>4,
			'language_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')    
		); 

		$classified_conditions_lang [] = array(
			'name' => 'Servicio de Teléfono', 
			'classified_types_id' =>5,
			'language_id' => 1,  
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')             
		);  

		$classified_conditions_lang [] = array(
			'name' => 'Phone Service',
			'classified_types_id' =>5,
			'language_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')    
		);  
		// Uncomment the below to run the seeder
		DB::table('classified_conditions_lang')->insert($classified_conditions_lang);
	}

}