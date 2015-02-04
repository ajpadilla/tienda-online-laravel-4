<?php

use s4h\store\Users\User;

class PermissionTableSeeder extends DatabaseSeeder{

	public function run()
	{
		// Creando permisos y adjuntando a sus roles respectivos
		$addToWishList = new Permission();
		$addToWishList->name = 'add-to-wishlist';
		$addToWishList->display_name = 'Add to wishlist';
		$addToWishList->save();

		$clientAdmin = Role::whereName('client-admin')->first();
		$clientAdmin = Role::find($clientAdmin->id);
		$clientReader = Role::whereName('client-reader')->first();
		$clientReader = Role::find($clientReader->id);

		$clientAdmin->attachPermission($addToWishList);
		$clientReader->attachPermission($addToWishList);

		$clientAdminUser = User::find(5);
		$clientReaderUser = User::find(6);

		$clientAdminUser->attachRole($clientAdmin);
		$clientReaderUser->attachRole($clientReaderUser);
	}
}