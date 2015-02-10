<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationClassifiedClasificationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('classified_classification', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('category_id');
			$table->integer('classified_id');
			$table->unique(array('category_id', 'classified_id'), 'classified_classification_unique');
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
		Schema::dropIfExists('classified_classification');
	}

}
