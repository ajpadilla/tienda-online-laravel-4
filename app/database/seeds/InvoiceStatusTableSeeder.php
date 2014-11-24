<?php

class InvoiceStatusTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$date = new DateTime;
		
		$invoice_status [] = array(
			'color' => '#ff887c',
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')                 
		);  

		$invoice_status [] = array(
			'color' => '#7bd148',
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')           
		);  

		// Uncomment the below to run the seeder
		DB::table('invoice_status')->insert($invoice_status);
	}

}
