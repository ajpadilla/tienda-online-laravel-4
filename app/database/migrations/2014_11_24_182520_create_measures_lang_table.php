<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeasuresLangTable extends Migration {

		/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('measures_lang', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 255);
			$table->string('abbreviation', 4);
			$table->integer('measures_id')->index();
			$table->integer('language_id')->index();
			$table->unique(array('measures_id', 'language_id'), 'measures_lang_unique');
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
		Schema::dropIfExists('measures_lang');
	}
}