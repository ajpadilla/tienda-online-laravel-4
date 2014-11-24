<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesLangTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('categories_lang', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 128);
			$table->integer('category_id')->index();
			$table->integer('language_id')->index();
			$table->unique(array('category_id', 'language_id'), 'categories_lang_unique');
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
		Schema::dropIfExists('categories_lang');
	}
}
