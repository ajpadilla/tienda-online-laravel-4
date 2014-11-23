<?php

class LanguageTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$date = new DateTime;
		$languages [] = array(
			'name' => 'Español',
			'native_name'=> 'Castellano',
			'iso_code'    => 'es',
			'language_code' =>'es_ES' ,
			'date_format' => 'd-m-Y',
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')                 
		);  

		$date = new DateTime;
		$languages [] = array(
			'name' => 'English',
			'native_name'=> 'English',
			'iso_code'    => 'en',
			'language_code' =>'en_EN' ,
			'date_format' => 'Y-m-d',
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')           
		);  

		// Uncomment the below to run the seeder
		DB::table('languages')->insert($languages);
	}

}
