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

		// Creando permisos y adjuntando a sus roles respectivos
		$addToWishList = new Permission();
		$addToWishList->name = 'add-to-wishlist';
		$addToWishList->display_name = 'Add to wishlist';
		$addToWishList->save();

		$clientAdmin->attachPermission($addToWishList);
		$clientReader->attachPermission($addToWishList);

		$clientAdminUser = User::find(5);
		$clientReaderUser = User::find(6);

		$clientAdminUser->attachRole($clientAdmin);
		$clientReaderUser->attachRole($clientReaderUser);
	}
}