<?php 

use s4h\store\Peoples\People;
use s4h\store\Users\User;
use s4h\store\Address\Address;

/**
* 
*/
class PeopleTableSeeder extends DatabaseSeeder{
	
		public function run()
		{
			$faker = $this->getFaker();

			$users = User::all();

			$addressAll = Address::all()->toArray();

			foreach ($users as $user) {
				$address = $faker->randomElement($addressAll);
				 People::create([
            		"name"   => $faker->firstName,
            		"lastname" => $faker->lastName,
            		"mothersname" => $faker->name($gender = 'female')  ,
            		"sex" => $faker->numberBetween(0,1),
            		"date_of_birth" => $faker->date($format = 'Y-m-d', $max = 'now'),
            		"cellphone" => $faker->phoneNumber, 
            		"user_id" => $user->id,
            		"role_id" => $user->id,
            		"address_id" => $address['id']
          		]);
			}
		}
}