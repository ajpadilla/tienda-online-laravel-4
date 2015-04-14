<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaynmentCredentialDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('address', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('email', 255)->nullable(true)->default(true);
			$table->string('credit_cart_number', 45)->nullable(true)->default(true);
			$table->string('credit_cart_security_number', 45)->nullable(true)->default(true);
			$table->date('credit_cart_expire_date')->nullable(true)->default(true);
			$table->integer('payments_types_id')->unsigned();
			$table->integer('users_id')->unsigned();
			$table->integer('card_brands_id')->unsigned();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('address');
	}

}
