<?php  

use s4h\store\Address\Address;
use s4h\store\Cities\City;

class AddressTableSeeder extends DatabaseSeeder{
	
	public function run(){
		$faker = $this->getFaker();

		$cities = City::all()->toArray();

		 for($i=0; $i<=20; $i++) {
			$city = $faker->randomElement($cities);
			Address::create([
				"description" => $faker->address,
				"phone_1" => $faker->phoneNumber,
				"phone_2" => $faker->phoneNumber,
				"city_id" => $city['id']
			]);
		}
	}

}