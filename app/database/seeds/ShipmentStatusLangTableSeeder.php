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
		
		$invoice_status_lang [] = array(
			'name' => 'Cancelado',
			'description' => $faker->text,
			'shipment_status_id' => 1,
			'language_id' => 1,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')                 
		);  

		$invoice_status_lang [] = array(
			'name' => 'Canceled',
			'description' => $faker->text,
			'shipment_status_id' => 1,
			'language_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')                 
		); 

		$invoice_status_lang [] = array(
			'name' => 'Enviado',
			'description' => $faker->text,
			'shipment_status_id' => 2,
			'language_id' => 1,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')           
		);  

		$invoice_status_lang [] = array(
			'name' => 'Dispatched',
			'description' => $faker->text,
			'shipment_status_id' => 2,
			'language_id' => 2,
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')           
		); 

		// Uncomment the below to run the seeder
		DB::table('shipment_status_lang')->insert($invoice_status_lang);
	}

}
