<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscountsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('discounts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->decimal('value', 17,2)->nullable();
			$table->decimal('percent', 5,2)->nullable();
			$table->smallInteger('quantity');
			$table->smallInteger('quantity_per_user');
			$table->string('code', 255)->nullable();
			$table->tinyInteger('active');
			$table->date('from');
			$table->date('to');
			$table->integer('discount_type_id')->index();
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
		Schema::dropIfExists('discounts');
	}

}
