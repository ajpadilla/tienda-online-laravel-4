<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsClassificationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_classification', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('category_id');
			$table->integer('product_id');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('product_classification', function(Blueprint $table)
		{
			Schema::dropIfExists('product_classification');
		});
	}

}
