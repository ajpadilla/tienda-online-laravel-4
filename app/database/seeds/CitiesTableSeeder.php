<?php 

class CitiesTableSeeder extends Seeder {

    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        //DB::table('municipios')->truncate();

        $date = new DateTime;

        $cities[] = array(
            'name' => 'San Cristóbal',
            'postal_code' => 1,
            'states_id' => 1,
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        );  
        $cities[] = array(
            'name' => 'Guasimos',
            'postal_code' => 2,
            'states_id' => 1,
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        );   

        $cities[] = array(
            'name' => 'Cardenas',
            'postal_code' => 3,
            'states_id' => 1,
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        ); 
        
        $cities[] = array(
            'name' => 'Ayacucho',
            'postal_code' => 4,
            'states_id' => 1,
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        ); 

        $cities[] = array(
            'name' => 'Alberto Adriani',
            'postal_code' => 5,
            'states_id' => 2,
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        ); 
        
        $cities[] = array(
            'name' => 'Andrés Bello',
            'postal_code' => 6,
            'states_id' => 2,
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        ); 


        $cities[] = array(
            'name' => 'Los Ángeles',
            'postal_code' => 1,
            'states_id' => 3,
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        );  

        $cities[] = array(
            'name' => 'La Verne',
            'postal_code' => 2,
            'states_id' => 3,
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        );  

        $cities[] = array(
            'name' => 'Long Beach',
            'postal_code' => 3,
            'states_id' => 3,
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        ); 
        
        $cities[] = array(
            'name' => 'Malibu',
            'postal_code' => 4,
            'states_id' => 3,
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        );    

        $cities[] = array(
            'name' => 'Olympia',
            'postal_code' => 5,
            'states_id' => 4,
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        ); 
        
        $cities[] = array(
            'name' => 'Seattle',
            'postal_code' => 6,
            'states_id' => 4,
            'created_at' => $date->format('Y-m-d h:m:s'),
            'updated_at' => $date->format('Y-m-d h:m:s')            
        );     


        // Uncomment the below to run the seeder
        DB::table('cities')->insert($cities);
    }
}