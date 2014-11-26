<?php

class ShipmentStatusTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$date = new DateTime;
		
		$shipment_status [] = array(
			'color' => '#ff887c',
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')                 
		);  

		$shipment_status [] = array(
			'color' => '#ffb878',
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')           
		);  

		$shipment_status [] = array(
			'color' => '#e1e1e1',
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')                 
		);  

		$shipment_status [] = array(
			'color' => '#a4bdfc',
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')           
		);  

		$shipment_status [] = array(
			'color' => '#7bd148',
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')           
		);
		
		// Uncomment the below to run the seeder
		DB::table('shipment_status')->insert($shipment_status);
	}
}

