<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeightsLangTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('weights_lang', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 64);
			$table->string('abbreviation', 5);
			$table->integer('weight_id');
			$table->integer('language_id');
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
		Schema::dropIfExists('weights_lang');
	}


}
