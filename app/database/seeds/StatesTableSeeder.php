<?php

class StatesTableSeeder extends DatabaseSeeder {

    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        //DB::table('estados')->truncate();

        $date = new DateTime;

        $states[] = array(
            'name' => 'Táchira',
            'country_id' => 1,
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        );  
        $states[] = array(
            'name' => 'Mérida',
            'country_id' => 1,
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        ); 

        $states[] = array(
            'name' => 'California',
            'country_id' => 2,
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        );  
        $states[] = array(
            'name' => 'Washington',
            'country_id' => 2,
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        );   

        // Uncomment the below to run the seeder
        DB::table('states')->insert($states);
    }
    
    
}