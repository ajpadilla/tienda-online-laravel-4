<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsLangTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products_lang', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 128);
			$table->text('description');
			$table->integer('product_id')->index();
			$table->integer('language_id')->index();
			$table->unique(array('product_id', 'language_id'), 'products_lang_unique');
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
		Schema::dropIfExists('products_lang');
	}

}
