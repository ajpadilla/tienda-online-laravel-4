<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductConditionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_conditions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 45);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('product_conditions', function(Blueprint $table)
		{
			Schema::drop('product_conditions');
		});
	}

}
