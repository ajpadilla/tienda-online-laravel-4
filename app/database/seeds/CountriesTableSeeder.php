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
            'name' => 'Venezuela', 
            'active' => 1,
            'iso_code' => 'VEN',
            'currency_id' => 1,
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        );  

        $countries[] = array(
            'name' => 'Unite states',
            'active' => 1,
            'iso_code' => 'USA',
            'currency_id' => 2,
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        );

        DB::table('countries')->insert($countries);
	}

}