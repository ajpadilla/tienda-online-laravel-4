<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributeTypesLangTable extends Migration {
	
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('attribute_types_lang', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 255);
			$table->integer('attribute_type_id')->index();
			$table->integer('language_id')->index();
			$table->unique(array('attribute_type_id', 'language_id'), 'attribute_types_lang_unique');
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
		Schema::dropIfExists('attribute_types_lang');
	}
}