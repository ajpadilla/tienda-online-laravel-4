<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributesValuesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('attribute_by_values', function(Blueprint $table)
		{
			$table->integer('attribute_by_product_id')->index();
			$table->integer('attribute_value_id')->index();
			$table->unique(array('attribute_by_product_id', 'attribute_value_id'), 'attribute_by_values_unique');
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
		Schema::dropIfExists('attribute_by_values');
	}

}
