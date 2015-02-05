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

		$codes = array();
		for ($i=0; $i < 6; $i++)
			$codes[] = $faker->password;

		$users = array();

		$users[] =	[
				'username' => 'admin',
				'email' =>  'admin@tienda-online.com',
				'password' => Hash::make('1234'),
				'confirmation_code' => $codes[0],
				'confirmed' => 1,
				];

		$users[] =	[
				'username' => 'lectura-general',
				'email' =>  'lectura-general@tienda-online.com',
				'password' => Hash::make('1234'),
				'confirmation_code' => $codes[1],
				'confirmed' => 1,
				];

		$users[] =	[
				'username' => 'proveedor-tienda',
				'email' =>  'proveedor-tienda@tienda-online.com',
				'password' => Hash::make('1234'),
				'confirmation_code' => $codes[2],
				'confirmed' => 1,
				];

		$users[] =	[
				'username' => 'lectura-tienda',
				'email' =>  'lectura-tienda@tienda-online.com',
				'password' => Hash::make('1234'),
				'confirmation_code' => $codes[3],
				'confirmed' => 1,
				];

		$users[] =	[
				'username' => 'cliente-admin',
				'email' =>  'cliente-admin@tienda-online.com',
				'password' => Hash::make('1234'),
				'confirmation_code' => $codes[4],
				'confirmed' => 1,
				];

		$users[] =	[
				'username' => 'cliente-lectura',
				'email' =>  'cliente-lectura@tienda-online.com',
				'password' => Hash::make('1234'),
				'confirmation_code' => $codes[5],
				'confirmed' => 1,
				];

		foreach ($users as $user)
			User::create($user);

	}

}