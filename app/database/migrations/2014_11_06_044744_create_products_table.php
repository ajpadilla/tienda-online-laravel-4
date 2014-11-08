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
		Schema::table('products', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 64);
			$table->text('description');
			$table->tinyInteger('on_sale');
			$table->integer('quantity');
			$table->decimal('price', 20,6)->nullable();
			$table->float('width');
			$table->float('height');
			$table->float('depth');
			$table->float('weight');
			$table->tinyInteger('active');
			$table->tinyInteger('available_for_order');
			$table->tinyInteger('show_price');
			$table->tinyInteger('accept_barter');
			$table->tinyInteger('product_for_barter');
			$table->integer('condition_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->timestamps();
			$table->softDeletes();
			$table->create();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('products', function(Blueprint $table)
		{
			//
		});
	}

}
