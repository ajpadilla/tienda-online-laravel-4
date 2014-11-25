<?php 

class MeasureLangTableSeeder extends DatabaseSeeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
		public function run()
	{
		$date = new DateTime;

		$measures_lang [] = array(
			'name' => 'Centrimetros', 
			'abbreviation' => 'cm',
			'measures_id' =>1,
			'language_id' => 1,  
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')             
		);  

		$measures_lang [] = array(
			'name' => 'Centimeters',
			'abbreviation' => 'cm',
			'measures_id' =>1,
			'language_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')    
		);  

		$measures_lang [] = array(
			'name' => 'Pulgadas', 
			'abbreviation' => 'in',
			'measures_id' =>2,
			'language_id' => 1,  
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')             
		);  

		$measures_lang [] = array(
			'name' => 'Inches',
			'abbreviation' => 'in',
			'measures_id' =>2,
			'language_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')    
		);  

		$measures_lang [] = array(
			'name' => 'Milimetros', 
			'abbreviation' => 'mm',
			'measures_id' =>3,
			'language_id' => 1,  
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')             
		);  

		$measures_lang [] = array(
			'name' => 'Milliliters',
			'abbreviation' => 'mm',
			'measures_id' =>3,
			'language_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')    
		);  
		
		// Uncomment the below to run the seeder
		DB::table('measures_lang')->insert($measures_lang);
	}
}

