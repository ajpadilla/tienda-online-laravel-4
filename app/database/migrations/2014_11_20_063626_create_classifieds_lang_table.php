<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassifiedsLangTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('classifieds_lang', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 128);
			$table->string('description', 128);
			$table->text('address');
			$table->integer('classified_id')->index();
			$table->integer('language_id')->index();
			$table->unique(array('classified_id', 'language_id'), 'classifieds_Lang_unique');
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
		Schema::dropIfExists('classifieds_lang');
	}


}
