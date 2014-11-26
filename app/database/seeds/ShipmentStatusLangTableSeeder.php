<?php


class ShipmentStatusLangTableSeeder extends DatabaseSeeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = $this->getFaker();

		$date = new DateTime;
		
		$shipment_status_lang [] = array(
			'name' => 'En galpón',
			'description' => $faker->text,
			'shipment_status_id' => 1,
			'language_id' => 1,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')                 
		);  

		$shipment_status_lang [] = array(
			'name' => 'In warehouse',
			'description' => $faker->text,
			'shipment_status_id' => 1,
			'language_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')                 
		); 

		$shipment_status_lang [] = array(
			'name' => 'Empacado',
			'description' => $faker->text,
			'shipment_status_id' => 2,
			'language_id' => 1,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')           
		);  

		$shipment_status_lang [] = array(
			'name' => 'Packed',
			'description' => $faker->text,
			'shipment_status_id' => 2,
			'language_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')           
		); 


		$shipment_status_lang [] = array(
			'name' => 'Embarcado',
			'description' => $faker->text,
			'shipment_status_id' => 3,
			'language_id' => 1,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')                 
		);  

		$shipment_status_lang [] = array(
			'name' => 'Embarked',
			'description' => $faker->text,
			'shipment_status_id' => 3,
			'language_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')                 
		); 

		$shipment_status_lang [] = array(
			'name' => 'En camino',
			'description' => $faker->text,
			'shipment_status_id' => 4,
			'language_id' => 1,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')           
		);  

		$shipment_status_lang [] = array(
			'name' => 'In road',
			'description' => $faker->text,
			'shipment_status_id' => 4,
			'language_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')           
		); 

		$shipment_status_lang [] = array(
			'name' => 'Entregado en destino',
			'description' => $faker->text,
			'shipment_status_id' => 5,
			'language_id' => 1,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')           
		);  

		$shipment_status_lang [] = array(
			'name' => 'At destination',
			'description' => $faker->text,
			'shipment_status_id' => 5,
			'language_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')           
		); 

		// Uncomment the below to run the seeder
		DB::table('shipment_status_lang')->insert($shipment_status_lang);
	}

}
