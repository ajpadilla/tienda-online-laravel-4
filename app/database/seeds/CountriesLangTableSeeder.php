<?php 

use s4h\store\Weights\Weight;
/**
* 
*/
class CountriesLangTableSeeder extends DatabaseSeeder{
	
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$date = new DateTime;

        $countries_lang [] = array(
            'name' => 'Venezuela', 
            'country_id' =>1,
            'language_id' => 1,  
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')             
        );  

        $countries_lang [] = array(
            'name' => 'Venezuela',
            'country_id' =>1,
            'language_id' => 2,
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')    
        ); 

        $countries_lang [] = array(
            'name' => 'Estados unidos', 
            'country_id' =>2,
            'language_id' => 1,  
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')             
        );  

        $countries_lang [] = array(
            'name' => 'Unite states',
            'country_id' =>2,
            'language_id' => 2,
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')    
        );

        DB::table('countries_lang')->insert($countries_lang);
	}

}