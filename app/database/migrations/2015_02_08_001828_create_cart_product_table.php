<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCartProductTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cart_product', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('cart_id');
			$table->integer('product_id');
			$table->smallInteger('quantity')->default(1);
			$table->unique(array('cart_id', 'product_id'), 'cart_product_unique');
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
		Schema::dropIfExists('cart_product');
	}

}
