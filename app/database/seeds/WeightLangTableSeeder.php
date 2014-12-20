<?php

class WeightLangTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$date = new DateTime;
		
		$weights_lang [] = array(
			'name' => 'Kilogramo',
			'abbreviation' => 'kg',
			'weight_id' => 1,
			'language_id' => 1,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')                 
		);  

		$weights_lang [] = array(
			'name' => 'Kilogram ',
			'abbreviation' => 'kg',
			'weight_id' => 1,
			'language_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')                 
		); 

		$weights_lang [] = array(
			'name' => 'Tonelada',
			'abbreviation' => 't',
			'weight_id' => 2,
			'language_id' => 1,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')           
		);  

		$weights_lang [] = array(
			'name' => 'Ton',
			'abbreviation' => 't',
			'weight_id' => 2,
			'language_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')           
		); 


		$weights_lang [] = array(
			'name' => 'Gramo',
			'abbreviation' => 'g',
			'weight_id' => 3,
			'language_id' => 1,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')                 
		);  

		$weights_lang [] = array(
			'name' => 'Gram',
			'abbreviation' => 'g',
			'weight_id' => 3,
			'language_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')                 
		); 


		// Uncomment the below to run the seeder
		DB::table('weights_lang')->insert($weights_lang);
	}
}