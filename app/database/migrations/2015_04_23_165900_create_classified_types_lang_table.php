<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassifiedTypesLangTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('classified_types_lang', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 128);
			$table->integer('classified_types_id')->index();
			$table->integer('language_id')->index();
			$table->unique(array('classified_types_id', 'language_id'), 'classified_types_lang_unique');
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
		Schema::dropIfExists('classified_types_lang');
	}
}
