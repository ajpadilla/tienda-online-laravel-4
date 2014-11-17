<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShipmentStatusLangTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shipment_status_lang', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 255);
			$table->text('description')->nullable();
			$table->integer('shipment_status_id')->index();
			$table->integer('language_id')->index();
			$table->unique(array('shipment_status_id', 'language_id'), 'shipment_status_lang_unique');
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
		Schema::drop('shipment_status_lang');
	}

}
