<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributesByProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('attribute_by_products', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('attribute_id')->index();
			$table->integer('product_id')->index();
			$table->unique(array('attribute_id', 'product_id'), 'attribute_by_products_unique');
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
		Schema::dropIfExists('attribute_by_products');
	}

}
