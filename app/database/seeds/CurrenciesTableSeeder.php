<?php 

/**
* 
*/
class CurrenciesTableSeeder extends DatabaseSeeder{
	
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$date = new DateTime;

        $currencies[] = array(
            'name' => 'Bolivares',
            'iso_code' => 'VEN',
            'sign'=> 'Bs',
            'active' => 1,
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        );  

        $currencies[] = array(
            'name' => 'Dolares',
            'iso_code' => 'UNS',
            'sign'=> '$',
            'active' => 1,
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')             
        );

        DB::table('currencies')->insert($currencies);
	}

}