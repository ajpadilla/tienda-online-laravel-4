<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributeValuesLangTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('attribute_values_lang', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 255);
			$table->integer('attribute_value_id')->index();
			$table->integer('language_id')->index();
			$table->unique(array('attribute_value_id', 'language_id'), 'attribute_values_lang_unique');
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
		Schema::dropIfExists('attribute_values_lang');
	}
}
