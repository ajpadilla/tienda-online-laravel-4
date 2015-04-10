<?php 

use s4h\store\Peoples\People;
use s4h\store\Users\User;
use s4h\store\Address\Address;
use s4h\store\Currencies\Currency;

/**
* 
*/
class PeopleTableSeeder extends DatabaseSeeder{
	
		public function run()
		{
			$faker = $this->getFaker();

			$users = User::all();
			$addresses = Address::all()->toArray();
			$currencies = Currency::all()->toArray();		
			$formats = ['Y-m-d', 'd-m-Y'];

			foreach ($users as $user) {
				 $address = $faker->randomElement($addresses);
				 $currency = $faker->randomElement($currencies);
				 $format = $faker->randomElement($formats);
				 People::create([
            		"name"   => $faker->firstName,
            		"lastname" => $faker->lastName,
            		"mothersname" => $faker->name($gender = 'female'),
            		"sex" => $faker->numberBetween(0,1),
            		"date_of_birth" => $faker->date($format = 'Y-m-d', $max = 'now'),
            		"cellphone" => $faker->phoneNumber, 
            		"hour_format" => 'H:m',
            		"date_format" => $format,
            		"user_id" => $user->id,
            		"address_id" => $address['id'],
            		"currency_id" => $currency['id']
          		]);
			}
		}
}