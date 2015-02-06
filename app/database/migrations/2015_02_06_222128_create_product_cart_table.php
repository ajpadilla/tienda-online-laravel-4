<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductCartTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_cart', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('product_id')->index();
			$table->integer('cart_id')->index();
			$table->smallInteger('quantity');
			$table->unique(array('product_id', 'cart_id'), 'product_cart_unique');
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
		Schema::dropIfExists('product_cart');
	}

}
