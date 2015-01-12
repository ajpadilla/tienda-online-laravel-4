<?php 

use s4h\store\Weights\Weight;
/**
* 
*/
class CountriesTableSeeder extends DatabaseSeeder{
	
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$date = new DateTime;

        $countries[] = array(
            'active' => 1,
            'iso_code' => 'VEN',
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        );  

        $countries[] = array(
            'active' => 1,
            'iso_code' => 'USA',
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        );

        DB::table('countries')->insert($countries);
	}

}