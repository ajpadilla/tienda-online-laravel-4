<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContriesLangTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('countries_lang', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 64);
			$table->integer('country_id')->index();
			$table->integer('language_id')->index();
			$table->unique(array('country_id', 'language_id'), 'countries_lang_unique');
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
		Schema::dropIfExists('countries_lang');
	}

}
