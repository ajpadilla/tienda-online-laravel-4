<?php 

class CardBrandsTableSeeder extends DatabaseSeeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$date = new DateTime;

		$card_brands [] = array(
			'name' => 'American Express', 
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')             
		);  

		$card_brands [] = array(
			'name' => 'MasterCard',
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')    
		);  

		$card_brands [] = array(
			'name' => 'Visa', 
			'created_at' => $date->format('Y-m-d h:m:s'),
			'updated_at' => $date->format('Y-m-d h:m:s')             
		);  

		// Uncomment the below to run the seeder
		DB::table('card_brands')->insert($card_brands);
	}
}
