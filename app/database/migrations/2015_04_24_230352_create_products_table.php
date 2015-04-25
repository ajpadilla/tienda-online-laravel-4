<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function(Blueprint $table)
		{
			$table->increments('id');
			$table->tinyInteger('on_sale');
			$table->integer('quantity');
			$table->decimal('price', 20,6)->nullable();
			$table->float('width');
			$table->integer('point_price');
			$table->float('height');
			$table->float('depth');
			$table->float('weight');
			$table->tinyInteger('active');
			$table->tinyInteger('accept_barter');
			$table->string('color', 7);
			$table->integer('condition_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->integer('measure_id')->unsigned();
			$table->integer('weight_id')->unsigned();
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
		Schema::dropIfExists('products');
	}

}
