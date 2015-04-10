<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddDateFormatToPeopleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('people', function(Blueprint $table)
		{
			$table->string('date_format', 9)->default('Y-m-d')->after('cellphone');
			$table->string('hour_format', 9)->default('H:m:i')->after('cellphone');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('people', function(Blueprint $table)
		{
			$table->removeColumn('date_format');
			$table->removeColumn('hour_format');
		});
	}

}
