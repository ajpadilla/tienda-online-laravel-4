<?php

use s4h\store\Users\Role;

class RoleTableSeeder extends DatabaseSeeder{

	public function run()
	{
		$admin = new Role();
		$admin->name = 'administrator';
		$admin->save();

		$generalReader = new Role();
		$generalReader->name = 'general-reader';
		$generalReader->save();

		$storeProvider = new Role();
		$storeProvider->name = 'store-provider';
		$storeProvider->save();

		$storeReader = new Role();
		$storeReader->name = 'store-reader';
		$storeReader->save();

		$clientAdmin = new Role();
		$clientAdmin->name = 'client-admin';
		$clientAdmin->save();

		$clientReader = new Role();
		$clientReader->name = 'client-reader';
		$clientReader->save();
	}
}