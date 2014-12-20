<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWeightsLang extends Migration {

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
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('weights_lang');
	}

}
