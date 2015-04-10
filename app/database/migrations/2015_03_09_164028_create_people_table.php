<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeopleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('people', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 255);
			$table->string('lastname', 255);
			$table->string('mothersname', 255);
			$table->tinyInteger('sex');
			$table->date('date_of_birth');
			$table->string('cellphone',50);
			$table->integer('user_id')->unsigned();
			$table->integer('address_id')->unsigned();
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
		Schema::dropIfExists('people');
	}

}
