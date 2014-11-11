<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscountsLangTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('discounts_lang', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 255);
			$table->text('description')->nullable();
			$table->integer('discount_id')->index();
			$table->integer('language_id')->index();
			$table->unique(array('discount_id', 'language_id'), 'discounts_lang_unique');
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
		Schema::drop('discounts_lang');
	}

}
