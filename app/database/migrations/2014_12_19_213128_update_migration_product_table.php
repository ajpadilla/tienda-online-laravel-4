<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateMigrationProductTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('products', function($table)
		{
			$table->integer('point_price')->after('width');
			$table->dropColumn('available_for_order');
			$table->dropColumn('show_price');
			$table->dropColumn('product_for_barter');
			$table->dropColumn('measure_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
