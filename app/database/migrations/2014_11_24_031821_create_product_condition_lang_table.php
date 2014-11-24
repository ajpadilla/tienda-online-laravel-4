<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductConditionLangTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_condition_lang', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 45);
			$table->integer('product_condition_id')->index();
			$table->integer('language_id')->index();
			$table->unique(array('product_condition_id', 'language_id'), 'product_condition_lang_unique');
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
		Schema::dropIfExists('product_condition_lang');
	}

}
