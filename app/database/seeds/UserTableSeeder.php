<?php 

use s4h\store\Users\User;

/**
* 
*/
class UserTableSeeder extends DatabaseSeeder{
	
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$faker = $this->getFaker();

		for ($i=0; $i < 5; $i++) 
		{ 
			User::create([
				'username' => $faker->userName,
				'email' =>  $faker->email,
				'password' => $faker->password,
				'confirmation_code' =>'',
				'confirmed' => $faker->numberBetween(0, 1),
			]);
		}
			
	}

}