<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributesLangTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('attributes_lang', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 255);
			$table->integer('attribute_id')->index();
			$table->integer('language_id')->index();
			$table->unique(array('attribute_id', 'language_id'), 'attributes_lang_unique');
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
		Schema::dropIfExists('attributes_lang');
	}

}
